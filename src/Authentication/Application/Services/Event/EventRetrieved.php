<?php

namespace Authentication\Application\Services\Event;

use SharedKernel\Application\Services\ApplicationService;
use SharedKernel\Application\Services\ApplicationServiceRequest;

class EventRetrieved implements ApplicationService
{

    /**
     * @param EventRetrievedRequest $request
     * @return bool
     */
    public function handle(ApplicationServiceRequest $request): bool
    {
        return true;
    }
}