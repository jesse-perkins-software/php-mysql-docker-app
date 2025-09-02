# PHP MySQL Docker Project

A simple PHP finance tracker with MySQL database running in Docker containers and Docker Compose.

## Prerequisites

1. Have Docker Desktop installed

## What's Included in the Project Files

1. MySQL Database with persistant storage
2. phpMyAdmin for database management
3. Docker Compose YAML file for easy startup
4. Sample database data (automatically imported)

## Set Up

1. Copy this repository onto your local machine.
2. Create a .env file (using the template in the .env.example file) and create your own values for each environment variable.
3. Run ```docker-compose up -d``` to start the application.

## Application Access

* Visit http://localhost:8000/controller.php to access the application
* Visit http://localhost:8080 for database access through phpMyAdmin 
