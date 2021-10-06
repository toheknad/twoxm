<?php

namespace Api\Memorization\Routes\Repeat;

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

class WordsReadyHandler implements RequestHandlerInterface
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

            $response = $this->wordRepository->getWordsReadyToRepeat($authIdentity->getId());

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
                'response' => $response
            ],
            201
        );
    }
}