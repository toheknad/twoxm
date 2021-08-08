<?php

namespace Api\Auth\Routes\Login;

use Api\Auth\Service\JWT\JWTTokenEncoder;
use Api\Auth\Service\PasswordHasher;
use Api\Tool\Hydrator\RequestInputHydrator;
use Api\Tool\Validator\Validator;
use Laminas\Diactoros\Response\JsonResponse;
use Model\User\DTO\Email;
use Model\User\Repository\UserRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LoginHandler implements RequestHandlerInterface
{

    private RequestInputHydrator $requestInputHydrator;
    private Validator $validator;
    private UserRepository $userRepository;
    private PasswordHasher $passwordHasher;
    private JWTTokenEncoder $jwtTokenEncoder;

    public function __construct(
        RequestInputHydrator $requestInputHydrator,
        Validator $validator,
        UserRepository $userRepository,
        PasswordHasher $passwordHasher,
        JWTTokenEncoder $jwtTokenEncoder
    )
    {
        $this->requestInputHydrator = $requestInputHydrator;
        $this->validator = $validator;
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
        $this->jwtTokenEncoder = $jwtTokenEncoder;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            /** @var RequestInput $requestInput */
            $requestInput = $this->requestInputHydrator->hydrate($request->getParsedBody(), new RequestInput());

            $this->validator->validate($requestInput);

            $user = $this->userRepository->getByEmail(new Email($requestInput->email));

            if (!$user->validatePassword($requestInput->password, $this->passwordHasher)) {
                throw new \DomainException('Incorrect password provided.');
            }
        }
        catch (\Exception $e) {
            return new JsonResponse(
                [
                    'response' => $e->getMessage()
                ],
            201
        );
        }
        return new JsonResponse(
            [
                'token' => $this->jwtTokenEncoder->encode($user)
            ],
            201
        );
    }
}