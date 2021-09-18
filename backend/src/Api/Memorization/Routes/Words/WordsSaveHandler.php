<?php

namespace Api\Memorization\Routes\Words;

use Api\Auth\Service\AuthIdentity;
use Api\Auth\Service\JWT\JWTTokenEncoder;
use Api\Auth\Service\PasswordHasher;
use Api\Tool\Hydrator\RequestInputHydrator;
use Api\Tool\Validator\Validator;
use Core\FlusherInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Model\User\DTO\Email;
use Model\User\Repository\UserRepository;
use Model\User\User;
use Model\Word\Repository\WordRepository;
use Model\Word\Word;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class WordsSaveHandler implements RequestHandlerInterface
{

    private RequestInputHydrator $requestInputHydrator;
    private Validator $validator;
    private WordRepository $wordRepository;
    private FlusherInterface $flusher;
    private UserRepository $userRepository;


    public function __construct(
        RequestInputHydrator $requestInputHydrator,
        Validator $validator,
        WordRepository $wordRepository,
        UserRepository $userRepository,
        FlusherInterface $flusher
    )
    {
        $this->requestInputHydrator = $requestInputHydrator;
        $this->validator = $validator;
        $this->wordRepository = $wordRepository;
        $this->userRepository = $userRepository;
        $this->flusher = $flusher;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            /** @var AuthIdentity $authIdentity */
            $authIdentity = $request->getAttribute(AuthIdentity::class);

            /** @var RequestInput $requestInput */
            $requestInput = $this->requestInputHydrator->hydrate($request->getParsedBody(), new RequestInput());

            $this->validator->validate($requestInput);

            $createdAt = new \DateTimeImmutable();
            $result = $this->saveWords($requestInput, $authIdentity, $createdAt);

        }
        catch (\Exception $e) {
            return new JsonResponse(
                [
                    'response' => $e->getMessage()
                ],
            401
        );
        }
        return new JsonResponse(
            [
                'response' => $result
            ],
            201
        );
    }

    private function saveWords(RequestInput $requestInput, AuthIdentity $authIdentity, $createdAt)
    {
        $requestWords = explode(',', $requestInput->words);


        foreach ($requestWords as $requestWord) {
            $user = $this->userRepository->get($authIdentity->getId());
            $timeRepeat = $this->getTimeToRepeat($createdAt, (int)$requestInput->method);
            $word = new Word($requestWord, $user, (int)$requestInput->method, $createdAt, $timeRepeat, 1);
            $this->wordRepository->add($word);
            $this->flusher->flush();
        }
    }

    private function getTimeToRepeat($createdAt, $method): \DateTimeImmutable
    {
        /** @var \DateTimeImmutable $createdAt */
        $createdAt =  $createdAt->format('Y-m-d H:i');
        if ($method == 1) {
            $interval = (new \DateInterval("PT{$this->wordRepository::METHOD_TWO_DAYS[1]}M"));
        } else if ($method == 2) {
            $interval = new \DateInterval("PT{$this->wordRepository::METHOD_SLOW[1]}M");
        }
        return (new \DateTimeImmutable($createdAt))->add($interval);
    }
}