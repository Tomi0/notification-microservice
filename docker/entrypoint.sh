#!/usr/bin/env bash

echo " [INFO] Starting entrypoint.sh"

php bin/console cache:clear

php bin/console notification:listen-events
