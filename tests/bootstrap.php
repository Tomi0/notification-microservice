<?php

use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__) . '/vendor/autoload.php';

if (method_exists(Dotenv::class, 'bootEnv')) {
    (new Dotenv())->bootEnv(dirname(__DIR__) . '/.env');
}

if ($_SERVER['APP_DEBUG']) {
    umask(0000);
}

(new \Symfony\Component\Filesystem\Filesystem())->remove(__DIR__ . '/../var/cache/test');

// executes the "php bin/console cache:clear" command
passthru('php bin/console --env=test cache:clear -q');
passthru('php bin/console --env=test doctrine:migrations:migrate -n -q');