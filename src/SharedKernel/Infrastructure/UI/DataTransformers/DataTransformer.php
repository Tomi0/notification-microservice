<?php

namespace SharedKernel\Infrastructure\UI\DataTransformers;

use SharedKernel\Domain\Models\Entity;

interface DataTransformer
{
    /**
     * @param Entity[] $data
     *
     * @return array<mixed>[]
     */
    public function transform(array $data): array;

    /**
     * @return array<mixed>
     */
    public function transformOne(Entity $data): array;
}
