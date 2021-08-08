<?php
namespace Api\Auth\Routes\SignUpByEmail;

use Api\Tool\Hydrator\RequestInputHydrator;
use Api\Tool\Validator\Validator;
use Api\Auth\Service\PasswordHasher;
use Api\Auth\Service\Tokenizer\Tokenizer;
use Model\User\DTO\Email;
use Model\User\Repository\UserRepositoryInterface;
use Model\User\User;
use Core\FlusherInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class SignUpByEmailRequestHandler implements RequestHandlerInterface
{

    private RequestInputHydrator $requestInputHydrator;
    private Validator $validator;
    private UserRepositoryInterface $userRepository;
    private Tokenizer $tokenizer;
    private PasswordHasher $passwordHasher;
    private FlusherInterface $flusher;

    public function __construct(
        RequestInputHydrator $requestInputHydrator,
        Validator $validator,
        UserRepositoryInterface $userRepository,
        PasswordHasher $passwordHasher,
        Tokenizer $tokenizer,
        FlusherInterface $flusher
    )
    {
        $this->requestInputHydrator = $requestInputHydrator;
        $this->userRepository = $userRepository;
        $this->validator = $validator;
        $this->passwordHasher = $passwordHasher;
        $this->tokenizer = $tokenizer;
        $this->flusher = $flusher;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

       try {
            $userData = $this->requestInputHydrator->hydrate($request->getParsedBody(), new RequestInput());

            $this->validator->validate($userData);

            /** @var RequestInput $userData */
            $user = $this->saveUser($userData);
       }
       catch (\Exception $e) {
           return new JsonResponse(
               [
                   'response' => $e->getMessage(),
               ],
               201
           );
       }
       print_r($userData);

        return new JsonResponse(
            [
                'token' => $userData,
            ],
            201
        );
    }

    private function saveUser(RequestInput $requestInput): User
    {
        $email = new Email($requestInput->email);

        if ($this->userRepository->hasByEmail($email)) {
            throw new \DomainException("User already exists!");
        }

        $createdAt = new \DateTimeImmutable();

        $user = User::createUserByEmail(
            $email,
            $createdAt,
            $this->passwordHasher->hash($requestInput->password),
            $this->tokenizer->generate($createdAt)
        );

        $this->userRepository->add($user);

        $this->flusher->flush();

        return $user;

    }

}