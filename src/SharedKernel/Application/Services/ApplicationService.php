<?php

namespace SharedKernel\Application\Services;

interface ApplicationService
{
    public function handle(ApplicationServiceRequest $request): mixed;
}
