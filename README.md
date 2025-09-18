# Laravel API & Web Project

A full-featured Laravel project with API and Web functionality, authentication, book and contact management, Dockerized PHP-FPM & Nginx environment, GitHub webhook deployment, and unit/feature testing.

---

## Table of Contents

1. [Features](#features)
2. [Requirements](#requirements)
3. [Installation](#installation)
4. [Docker Setup](#docker-setup)
5. [Nginx Configuration](#nginx-configuration)
6. [Authentication](#authentication)
7. [API Endpoints](#api-endpoints)
8. [Web Routes](#web-routes)
9. [Models](#models)
10. [Seeders](#seeders)
11. [Artisan Commands](#artisan-commands)
12. [Testing](#testing)
13. [GitHub Webhook Deployment](#github-webhook-deployment)
14. [License](#license)

---

## Features

* User authentication via Laravel Sanctum
* Books resource CRUD (API + Web)
* Contacts resource CRUD (API + Web) with optional file upload
* Tasks resource CRUD (Web)
* Event/Listener system (`ContactRegistered` → `SendWelcomeEmailListener`)
* GitHub webhook deployment script
* Dockerized environment (PHP-FPM + Nginx)
* PHPUnit Unit & Feature testing
* Seeders for testing (`ContactSeeder.php`)
* Cache & config management via Laravel artisan commands

---

## Requirements

* Docker >= 20.x
* Docker Compose >= 1.29.x
* PHP >= 8.2 (inside Docker)
* Composer (optional, handled in Docker)

---

## Installation

1. Clone the repository:

```bash
git clone https://github.com/your-username/your-repo.git
cd your-repo
```

2. Copy `.env` file:

```bash
cp .env.example .env
```

3. Build Docker containers:

```bash
docker-compose build
```

4. Start the containers:

```bash
docker-compose up -d
```

5. Install dependencies inside the PHP container:

```bash
docker exec -it php-fpm composer install
```

6. Run migrations:

```bash
docker exec -it php-fpm php artisan migrate
```

7. (Optional) Run seeders, e.g., `ContactSeeder`:

```bash
docker exec -it php-fpm php artisan db:seed --class=ContactSeeder
```

---

## Docker Setup

**PHP-FPM Dockerfile**:

* Base: `php:8.2-fpm`
* Extensions: `pdo_mysql`, `mbstring`, `bcmath`, `gd`, `exif`, `pcntl`
* Composer included
* Custom entrypoint `entrypoint.sh` sets permissions and clears/regenerates caches

**Nginx Dockerfile**:

* Base: `nginx:alpine`
* Custom configuration mounted via `nginx.conf` and `conf.d`
* Exposes port 80 → host port 8080

**docker-compose.yml**:

* `php-fpm` and `nginx` services
* Shared volumes for app code, public, storage, vendor, config, bootstrap, resources
* Nginx depends on PHP-FPM
* Access API/Web at `http://localhost:8080`

---

## Nginx Configuration

```nginx
server {
    listen 80;
    root /var/www/public;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass php-fpm:9000;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }

    location ~ /\.ht { deny all; }
}
```

---

## Authentication

* Login (`POST /login`) → returns API token
* Register (`POST /register`) → creates user
* Logout single session (`POST /logout`)
* Logout all sessions (`POST /logoutAll`)

**Controller:** `AuthController.php`

---

## API Endpoints

| Method | Endpoint       | Description                          | Auth Required |
| ------ | -------------- | ------------------------------------ | ------------- |
| GET    | /user          | Get authenticated user info          | Yes           |
| POST   | /login         | Login user                           | No            |
| POST   | /register      | Register new user                    | No            |
| POST   | /logout        | Logout current session               | Yes           |
| POST   | /logoutAll     | Logout all sessions                  | Yes           |
| GET    | /books         | List all books                       | Yes           |
| POST   | /books         | Create a new book                    | Yes           |
| GET    | /books/{id}    | Show book details                    | Yes           |
| PUT    | /books/{id}    | Update book                          | Yes           |
| DELETE | /books/{id}    | Delete book                          | Yes           |
| GET    | /contacts      | List all contacts (paginated)        | Yes           |
| POST   | /contacts      | Create a new contact (file optional) | Yes           |
| GET    | /contacts/{id} | Show contact details                 | Yes           |
| PUT    | /contacts/{id} | Update contact                       | Yes           |
| DELETE | /contacts/{id} | Delete contact                       | Yes           |

---

## Web Routes

* Homepage: `/` → `welcome` view
* Tasks: `Route::resource('tasks', TaskController::class)`
* Contacts: `Route::resource('contacts', ContactController::class)`
* Books: `Route::resource('books', BookController::class)`
* Login (web form): `POST /login` → `LoginController@login`
* Language switch: `/lang/{locale}` → switches between `en` and `es`

---

## Models

### Book

```php
protected $fillable = ['title', 'contact_id'];

public function contact() {
    return $this->belongsTo(Contact::class);
}
```

### Contact

```php
protected $fillable = ['name', 'email', 'file'];
```

### Task

```php
protected $fillable = ['title'];
```

*Notes:* Keep business logic in controllers, not in models.

---

## Seeders

* Example: `ContactSeeder.php`
  Seeds sample contacts for testing or initial setup.

```bash
docker exec -it php-fpm php artisan db:seed --class=ContactSeeder
```

---

## Artisan Commands

* Create a controller:

```bash
docker exec -it php-fpm php artisan make:controller BookController --resource
```

* Create a model:

```bash
docker exec -it php-fpm php artisan make:model Book
```

* Create a seeder:

```bash
docker exec -it php-fpm php artisan make:seeder ContactSeeder
```

* Run migrations:

```bash
docker exec -it php-fpm php artisan migrate
```

* Run seeders:

```bash
docker exec -it php-fpm php artisan db:seed --class=ContactSeeder
```

* Execute all tests:

```bash
docker exec -it php-fpm php artisan test
```

* Run specific PHPUnit test:

```bash
docker exec -it php-fpm vendor/bin/phpunit --filter BookTest
```

---

## Testing

* PHPUnit configured with `phpunit.xml`
* Unit and Feature tests for controllers
* Environment setup for tests:

```xml
<env name="APP_ENV" value="testing"/>
<env name="CACHE_DRIVER" value="array"/>
<env name="QUEUE_CONNECTION" value="sync"/>
<env name="MAIL_MAILER" value="array"/>
```

*Example Feature Test: `BookTest.php`*

```php
$book = Book::create([
    'title' => 'Clean Code',
    'author'=> 'Robert C. Martin',
    'contact_id' => 1
]);

$this->assertDatabaseHas('books', [
    'title' => 'Clean Code'
]);
```

---

## GitHub Webhook Deployment

* Webhook PHP listener: `deploy.php`
* Verifies HMAC signature (`X-Hub-Signature`)
* Executes `deploy.sh` asynchronously
* Logs output to `/tmp/deploy.log`

*Security tips:* Restrict by IP or event type

---

## License

MIT License © 2025 Asdin
