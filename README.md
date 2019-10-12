# NCA Community #

## Setup Virtual Environment ##

* Start Docker

  ```bash
  docker-compose up -d
  ```

* Copy files

  [.htaccess](templates/.htaccess) => `symfony/public`

* Install dependencies

  ```bash
  composer install
  ```

* Build schema

  ```bash
  bin/console doctrine:schema:update --force
  ```

* Install fixtures

  ```bash
  bin/console doctrine:fixtures:load

* Login to application

  ```bash
  http://127.0.0.1

  nevercodealone
  nevercodealone
  ```
* Login to application
  Add your twitter credendtials to .env file

  ```bash
  bin/console app:command-twitter
  ```
