# DevOps Project

## Foreword

This is a project which is a **work-in-progress**, where I am further
improving the UI & UX of a full-stack website I made in my advanced web development
course. So far I have containerized it in Docker Compose, and incorporated Infrastructure 
as Code with Terraform (yes, even the MySQL database! I know it's not ideal, and I'll 
get around to changing it eventually). 
<br>
#### Future Plans
Eventually, I want this project to imitate a production-grade DevOps environment, which
includes a local Kubernetes cluster, Jenkins, Prometheus, Grafana, and more.

## Summary
This is a finance tracker using HTML5, CSS3, JavaScript, and Bootstrap for the
frontend, PHP + MySQL database for the backend, and GitHub Actions for CI.

## Prerequisites
#### Minimum
- Docker
- Docker Compose

#### Additional
- Terraform

## Setup
1. Clone this repository
```aiignore
git clone https://github.com/jesse-perkins-software/php-mysql-docker-app.git
```
2. Rename **.env.example** to **.env,** and change the variable values to your choosing.

3. Change directory to the project
```
cd php-mysql-docker-app
```
## Running the Application
### Starting the Docker Application
```aiignore
docker-compose up -d
```
or
```aiignore
docker compose up -d
```

<br>

#### Stopping the Application
```aiignore
docker-compose down
```
or
```aiignore
docker compose down
```

#### Access
- http://localhost:3000 for the application
- http://localhost:3001 for the MySQL database

### Terraform Setup + Usage (Azure ONLY for now)
1. Download Terraform
2. Make a Free/Student Account with Microsoft Azure
3. Download and login to the Azure CLI
3. Rename the **terraform.tfvars.example** file to **terraform.tfvars** and modify the subscription ID to link your Azure account.
4. Initialize your Terraform files and apply them to build your infrastructure.
```aiignore
terraform init
terraform apply
```
5. Once you have confirmed that your Azure infrastructure is up and running in the Azure platform, destroy your infrastructure to ensure you aren't charged for your usage.
```aiignore
terraform destroy
```



