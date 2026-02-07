<?php

namespace Authentication\Application\Services\Event;

use SharedKernel\Application\Services\ApplicationServiceRequest;

readonly class EventRetrievedRequest implements ApplicationServiceRequest
{
    public mixed $contents;

    // TODO redefine inputs
    public function __construct($contents)
    {
        $this->contents = $contents;
    }
}