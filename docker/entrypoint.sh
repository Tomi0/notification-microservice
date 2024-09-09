
if [ "$NEW_UID" != "" ]; then
    usermod -u "$NEW_UID" NotificationUser
fi

if [ "$APP_ENV" == "prod" ]; then
    /bin/bash -c "composer dump-env prod"
fi

/bin/bash -c "php bin/console cache:clear"

service nginx start
php-fpm