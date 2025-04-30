# ⚡ EV Charging Management System

This is a backend system for managing Electric Vehicle (EV) charging sessions for companies.  
It allows companies to manage their vehicles and drivers, track charging sessions, and generate consumption reports.

Built with **Laravel**, **PostgreSQL**, and **Docker**, the project provides a production-like environment for scalable backend development.

---

## 🚀 Tech Stack

- PHP 8.x
- Laravel 11
- PostgreSQL
- Docker + Docker Compose
- Pest (testing)
- PHPStan (static analysis)
- Laravel Pint (code style)
- Xdebug (optional for debugging)

---

## ⚙️ Development Setup

### 1. Clone the repository

```bash
git clone https://github.com/andrepgsilva/ev-charging-backend.git
cd ev-charging-backend
```

### General Configuration
#### Copy the .env.example and Create Your Own .env
``` bash
    cp .env.example .env
```
Get the database env variables on docker-compose.yaml and use to configure your env.

#### Start Containers
```bash docker-compose up -d --build ```
#### Install PHP Dependencies Inside the Container
``` bash
docker exec -it app composer install
```
#### Generate Application Key
``` bash
docker exec -it app php artisan key:generate
```

#### Run database migrations
``` bash
docker exec -it app php artisan migrate
```

### WSL Config
The project already has a VS Code configuration to run with Xdebug. If you are using Docker with Windows + WSL you will probably need to do a post forward, so Xdebug can work correctly.

**Run Powershell as administrator:** 
``` Bash
 netsh interface portproxy set v4tov4 listenport=9000 listenaddress=0.0.0.0 connectport=9000 connectaddress=YOUR_HOST_ADDRESS
```
Your host address can be found using the command below:
``` Bash
wsl hostname -I
```
#### PostgreSQL
The host address will be the DB_HOST for Postgres. It need to be added on your .env.
Other configuration like, port, database name and password can be found - or changed - on docker-compose.yaml.

### 🧪 Code Quality & Testing
#### Run tests
``` bash
docker-compose exec app composer test:unit
```
#### Static Analysis
``` bash
docker-compose exec app composer test:types
```
#### Fix Code Style
``` bash
docker-compose exec app composer test:lint
```

#### You Can Use All Commands at Once
``` bash
docker-compose exec app composer test
```

### 🧑‍💻 Author
Made with ❤️ by [Your Name]

