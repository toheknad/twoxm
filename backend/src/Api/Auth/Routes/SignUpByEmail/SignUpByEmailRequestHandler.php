<?php
namespace Api\Auth\Routes\SignUpByEmail;

use Api\Tool\Hydrator\RequestInputHydrator;
use Api\Tool\Validator\Validator;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class SignUpByEmailRequestHandler implements RequestHandlerInterface
{

    private RequestInputHydrator $requestInputHydrator;
    private Validator $validator;

    public function __construct(
        RequestInputHydrator $requestInputHydrator,
        Validator $validator
    )
    {
        $this->requestInputHydrator = $requestInputHydrator;
        $this->validator = $validator;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

       try {
            $userData = $this->requestInputHydrator->hydrate($request->getParsedBody(), new RequestInput());

            $this->validator->validate($userData);

            $this->saveUser();
       }
       catch (\Exception $e) {
           return new JsonResponse(
               [
                   'response' => 'Ops! Something went wrong..',
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

    }

}