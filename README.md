# DevOps Docker Compose Project

## Foreword

This is a project which is a **work-in-progress**, where I am further
improving the UI & UX of a full-stack website I made in my advanced web development
course.


## Summary
This is a finance tracker using HTML5, CSS3, JavaScript, and Bootstrap for the
frontend, PHP + MySQL database for the backend, and GitHub Actions for CI.

## Prerequisites
- Docker
- Docker Compose

## Setup
1. Clone this repository
```bash
git clone https://github.com/jesse-perkins-software/php-mysql-docker-app.git
```
2. Rename **.env.example** to **.env,** and change the variable values to your choosing.

3. Change directory to the project
```
cd php-mysql-docker-app
```
## Running the Application
To start:
```
docker-compose up -d
```
or
```Linux
docker compose up -d
```

<br>

To stop:
```
docker-compose down
```
or
```
docker compose down
```

## Access
- http://localhost:3000 for the application
- http://localhost:3001 for the MySQL database



