# ⚡ EV Charging Management System

This is a backend system for managing Electric Vehicle (EV) charging sessions for companies.  
It allows companies to manage their vehicles and drivers, track charging sessions, and generate consumption reports.

Built with **Laravel**, **PostgreSQL**, **Google Cloud** and **Docker**, the project provides a production-like environment for scalable backend development.

---

## 🚀 Tech Stack

- PHP 8.3
- Laravel 12
- PostgreSQL
- Google Cloud
- Github Actions
- Docker
- Sanctum (Auth)
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
#### If you want to manually install PHP and Xdebug, you can use this gist:
[Manual Installation](https://gist.github.com/andrepgsilva/051eae5ca040396912407c7dd7fe9295)
#### Copy the .env.example and create your own .env and generate a new encryption key:
``` bash
cp .env.example .env
php artisan key:generate
```

#### Start Containers
``` bash 
docker-compose up -d --build 
```
#### Install PHP Dependencies Inside the Container
``` bash
docker-compose exec app composer install
```
#### Run Database Migrations
``` bash
docker-compose exec app php artisan migrate
```

### 🧪 Code Quality & Testing
#### Run Tests
``` bash
docker-compose exec app composer test:unit
```
#### Static Analysis
``` bash
docker-compose exec app composer test:types
```
#### Fix Code Style
``` bash
docker-compose exec app composer test:lint-fix
```

#### You Can Use All Commands at Once
``` bash
docker-compose exec app composer test
```
## Continuous Integration and Deployment
Built with GitHub Actions and Google Cloud Platform (Cloud Run, Artifact Registry), featuring:
- Multi-environment support (development/staging/production)
- Automated testing with PEST
- Code quality checks:
    - PHPStan for static analysis
    - Pint for code styling

## Strategies
### Charging Sessions Table Partitioning
**Why Partitioning?**

The charging_sessions table is expected to grow rapidly, with millions of records per year as the platform scales. To ensure high performance for queries and maintenance, we use PostgreSQL native table partitioning by month.

**Benefits**:

- Performance: Queries for recent sessions (e.g., “last month’s usage”) only scan relevant partitions, not the entire table.
- Maintenance: Old data can be dropped instantly by removing a partition, making retention policies efficient.
- Scalability: Each partition remains a manageable size, avoiding full-table scans.

### Auth
For this project scope, we are using token based authentication using Laravel Sanctum. It's an easy approach but at the same time robust for many cases, and it perfectly suits our needs for secure API authentication.


### 🧑‍💻 Author
Made with ❤️ by Andre Silva
