# ⚡ EV Charging Management System

This is a backend system for managing Electric Vehicle (EV) charging sessions for companies.  
It allows companies to manage their vehicles and drivers, track charging sessions, and generate consumption reports.

Built with **Laravel**, **PostgreSQL**, and **Docker**, the project provides a production-like environment for scalable backend development.

---

## 🚀 Tech Stack

- PHP 8.3
- Laravel 12
- PostgreSQL
- Docker
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
docker-compose exec app composer test:lint
```

#### You Can Use All Commands at Once
``` bash
docker-compose exec app composer test
```

## Strategies
### Charging Sessions Table Partitioning
**Why Partition?**

The charging_sessions table is expected to grow rapidly, with millions of records per year as the platform scales. To ensure high performance for queries and maintenance, we use PostgreSQL native table partitioning by month.

**Benefits**:

- Performance: Queries for recent sessions (e.g., “last month’s usage”) only scan relevant partitions, not the entire table.
- Maintenance: Old data can be dropped instantly by removing a partition, making retention policies efficient.
- Scalability: Each partition remains a manageable size, avoiding full-table scans and bloated indexes.

### 🧑‍💻 Author
Made with ❤️ by Andre Silva
