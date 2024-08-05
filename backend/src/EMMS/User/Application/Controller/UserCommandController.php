<?php

declare(strict_types=1);

namespace App\EMMS\User\Application\Controller;

use App\EMMS\User\Domain\ValueObject\UserInputDTO;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\ValueObject\OpenAPI\SuccessObjectType;
use App\Shared\Infrastructure\Symfony\ApiController;
use App\Shared\Infrastructure\Symfony\Trait\FormValidationErrorFactoryTrait;
use OpenApi\Attributes as OAT;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/user')]
final class UserCommandController extends ApiController
{
    use FormValidationErrorFactoryTrait;

    public function __construct(
        CommandBus $commandBus,
        QueryBus $queryBus,
        ValidatorInterface $validator
    ) {
        parent::__construct($commandBus, $queryBus);
        $this->setValidator($validator);
    }

    #[Route(methods: ['POST'])]
    #[
        OAT\Post(
            path: '/api/user',
            operationId: 'api_post_user',
            summary: 'Create user object',
            requestBody: new OAT\RequestBody(
                required: true,
                content: [
                    new SuccessObjectType(UserInputDTO::class),
                ]
            ),
            tags: ['User'],
            parameters: [
                new OAT\Parameter(name: 'Authorization', in: 'header', required: true),
            ],
            responses: [
                new OAT\Response(
                    response: 201,
                    description: 'Returned when successful',
                ),
                new OAT\Response(
                    response: 401,
                    description: 'Returned when unauthorized',
                ),
                new OAT\Response(
                    response: 410,
                    description: 'Token expired',
                ),
            ]
        )
    ]
    public function createUser(Request $request): Response
    {
        // $input = UserInputDTO::hydrate($this->getContent($request));
        // $this->validateRequest($input);

        // $this->dispatch(
        //    new CreateUserCommand($input)
        // );

        return new Response(null, Response::HTTP_CREATED);
    }

    #[Route('/{id}', methods: ['PUT'])]
    #[
        OAT\Put(
            path: '/api/user/{id}',
            operationId: 'api_put_user',
            summary: 'Update user object',
            requestBody: new OAT\RequestBody(
                required: true,
                content: [
                    new SuccessObjectType(UserInputDTO::class),
                ]
            ),
            tags: ['User'],
            parameters: [
                new OAT\Parameter(name: 'Authorization', in: 'header', required: true),
            ],
            responses: [
                new OAT\Response(
                    response: 204,
                    description: 'Returned when successful',
                ),
                new OAT\Response(
                    response: 401,
                    description: 'Returned when unauthorized',
                ),
                new OAT\Response(
                    response: 410,
                    description: 'Token expired',
                ),
            ]
        )
    ]
    public function updateUser(Request $request, string $id): Response
    {
        // $input = UserInputDTO::hydrate($this->getContent($request));
        // $this->validateRequest($input);

        // $this->dispatch(
        //    new UpdateUserCommand($id, $input)
        // );

        return new Response(null, Response::HTTP_NO_CONTENT);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    #[
        OAT\Delete(
            path: '/api/user/{id}',
            operationId: 'api_delete_user',
            summary: 'Delete user object',
            tags: ['User'],
            parameters: [
                new OAT\Parameter(name: 'Authorization', in: 'header', required: true),
            ],
            responses: [
                new OAT\Response(
                    response: 204,
                    description: 'Returned when successful',
                ),
                new OAT\Response(
                    response: 401,
                    description: 'Returned when unauthorized',
                ),
                new OAT\Response(
                    response: 410,
                    description: 'Token expired',
                ),
            ]
        )
    ]
    public function deleteUser(string $id): Response
    {
        // $this->dispatch(
        //    new DeleteUserCommand($id)
        // );

        return new Response(null, Response::HTTP_NO_CONTENT);
    }
}
