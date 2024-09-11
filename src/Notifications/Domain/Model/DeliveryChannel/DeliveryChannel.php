<?php

namespace Notifications\Domain\Model\DeliveryChannel;

enum DeliveryChannel: string
{
    case EMAIL = 'email';
}
