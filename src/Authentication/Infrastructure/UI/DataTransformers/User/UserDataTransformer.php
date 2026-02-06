<?php

namespace Authentication\Infrastructure\UI\DataTransformers\User;

use Authentication\Domain\Models\User\User;
use SharedKernel\Domain\Models\Entity;
use SharedKernel\Infrastructure\UI\DataTransformers\DataTransformer;

class UserDataTransformer implements DataTransformer
{
    /**
     * @param User[] $data
     *
     * @return array{id: string, firstName: string, lastName: string, email: string, phone: string, active: bool, createdAt: string, updatedAt: string}[]
     */
    public function transform(array $data): array
    {
        return array_map(fn (User $user) => $this->transformOne($user), $data);
    }

    /**
     * @param User $data
     *
     * @return array{id: string, firstName: string, lastName: string, email: string, phone: string, active: bool, createdAt: string, updatedAt: string}
     */
    public function transformOne(Entity $data): array
    {
        return [
            'id' => $data->id()->value(),
            'firstName' => $data->firstName(),
            'lastName' => $data->lastName(),
            'email' => $data->email(),
            'phone' => $data->phone(),
            'active' => $data->active(),
            'createdAt' => $data->createdAt()->format('Y-m-d H:i:s'),
            'updatedAt' => $data->updatedAt()->format('Y-m-d H:i:s'),
        ];
    }
}
