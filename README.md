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
* Login to phpmyadmin

  ```bash
  http://127.0.0.1:8888
  ncacommunity:ncacommunity
  ```
* Login to phpmyadmin

  ```bash
  hostname
  ```
  For my system it is skynet ;) add this to docker-compose.yml and do an new "up"
  
  https://blog.jetbrains.com/phpstorm/2018/08/quickstart-with-docker-in-phpstorm/
