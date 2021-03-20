## To Launch ##
php -S  localhost:8000 ./public/index.php

## To test ## 
./vendor/bin/phpcs; ./vendor/bin/phpunit

## PHINX ##

# to update ddb #
./vendor/bin/phinx migrate

# to create migrations #

./vendor/bin/phinx create [kebab-case-name]

# to create seed #

./vendor/bin/phinx seed:create [CamelCaseName]

# to set seeds #

./vendor/bin/phinx seed:run
