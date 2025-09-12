# PHP MySQL Docker Project

A simple finance tracker with PHP + MySQL database running in Docker Compose.

## Prerequisites

1. Have Docker Desktop installed and running.

## What's Included in the Project Files

1. MySQL Database with persistant storage
2. phpMyAdmin for database management
3. Docker Compose YAML file for easy startup
4. Sample database data (automatically imported)

## Set Up

1. Open your IDE of choice (I use VSCode), and copy this repositroy by using ```git clone github.com/jesseperkins796/php-mysql-docker-app``` in the terminal.
2. Edit the ```.env.example``` file to your own secure root password, username, password, and DB name. Once you've done that, rename the file to ```.env```.
3. Ensure you have the VSCode extensions **DotENV** and **PHPIntellisense** installed.
4. Run ```cd php-mysql-docker-app``` to go move into the correct folder.
5. Run ```docker-compose up -d``` to start the application.
6. Run ```docker-compose down``` to stop the application.

## Application Access

* Visit http://localhost:8000/controller.php to access the application
* Visit http://localhost:8080 for database access through phpMyAdmin 
