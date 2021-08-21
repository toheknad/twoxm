<?php

namespace Api\Memorization\Routes\Information;

use Api\Auth\Service\JWT\JWTTokenEncoder;
use Api\Auth\Service\PasswordHasher;
use Api\Tool\Hydrator\RequestInputHydrator;
use Api\Tool\Validator\Validator;
use Laminas\Diactoros\Response\JsonResponse;
use Model\User\DTO\Email;
use Model\User\Repository\UserRepository;
use Model\User\User;
use Model\Word\Word;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class InformationHandler implements RequestHandlerInterface
{

    private RequestInputHydrator $requestInputHydrator;
    private Validator $validator;
    private UserRepository $userRepository;


    public function __construct(
        RequestInputHydrator $requestInputHydrator,
        Validator $validator,
        UserRepository $userRepository
    )
    {
        $this->requestInputHydrator = $requestInputHydrator;
        $this->validator = $validator;
        $this->userRepository = $userRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            /** @var RequestInput $requestInput */
            $requestInput = $this->requestInputHydrator->hydrate($request->getParsedBody(), new RequestInput());

            $this->validator->validate($requestInput);

            $createdAt = new \DateTimeImmutable();

            $word = new Word($requestInput->word,$requestInput->userId, $requestInput->method, $createdAt);

            $this->userRepository->add($word);

            $this->flusher->flush();

            return $user;

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
                'response' => 'Success'
            ],
            201
        );
    }

    private function saveWord(RequestInput $requestInput)
    {

    }
}