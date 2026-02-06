#!/usr/bin/env bash

echo " [INFO] Starting entrypoint.sh"

if [ "${NEW_UID}" ]; then
    usermod -u "NEW_USER_ID" user
    groupmod -g "NEW_GROUP_ID" user
    chown -R user:user /var/www/html
fi

if [ "${APP_ENV}" = "prod" ]; then
    printenv > /etc/environment
    su user --command "php bin/console cache:clear"
fi

supervisord -c /etc/supervisord.conf -n -l /var/log/supervisord.log -j /var/run/supervisord.pid
