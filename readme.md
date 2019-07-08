Created a symfony/skeleton project beforehand for the test.<br>
Current testing code doesn't work since it was made for the now modified main controller.<br>
To run project, clone git, cd to project dir and run:

### `composer install`

Then modify .env file to local database and run:

### `php bin/console doctrine:database:create`

### `php bin/console doctrine:migrations:migrate`

### `php bin/console doctrine:fixtures:load`

To see project on localhost run:

### `php bin/console server:run`
