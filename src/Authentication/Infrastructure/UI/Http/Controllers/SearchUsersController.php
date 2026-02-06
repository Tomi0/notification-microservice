<?php

namespace Authentication\Infrastructure\UI\Http\Controllers;

use Authentication\Application\Services\User\SearchUsers;
use Authentication\Infrastructure\UI\DataTransformers\User\UserDataTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class SearchUsersController extends AbstractController
{
    private SearchUsers $searchUsers;

    public function __construct(SearchUsers $loginUser)
    {
        $this->searchUsers = $loginUser;
    }

    public function __invoke(): JsonResponse
    {
        $users = $this->searchUsers->handle();

        return new JsonResponse(
            (new UserDataTransformer())->transform($users)
        );
    }
}
