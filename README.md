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

## Create .env File
```
DB_ROOT_PASSWORD="your_secure_root_password"

DB_USER="your_user"
DB_PASSWORD="your_password"
DB_NAME="your_db_name"
DB_HOST="your_db_host_name"
```

## Setup
1. Clone this repository and run the docker-compose.yaml file
```bash
git clone https://github.com/jesse-perkins-software/php-mysql-docker-app.git
cd php-mysql-docker-app
docker compose up -d
```

2. Where to Access
- http://localhost:3000 for the application
- http://localhost:3001 for the MySQL database



