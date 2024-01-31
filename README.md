# Teemcorp Coding Exam

## Requirements:
- MySql v8
- PHP v7.4^
- NodeJs v20.*
- Composer v2.*

## Installation

## BACKEND
Navigate to the project folder via terminal.
```sh
cd project_folder
```

Create your MySql database.

Install composer packages.
```sh
composer install
```
Copy or move env.sample to .env.
```sh
cp .env.example .env
```

Configure .env depending on your machine. Especially the database credentials.
Variables to add:
- FINANCIAL_MODEL_API_KEY
- FINANCIAL_MODEL_API_ATTRIBUTE
- FINANCIAL_MODEL_URL

Run database migrations:
```sh
php artisan migrate
```

Install node packages.
```sh
npm install
```

## TO TEST
Need 3 terminals for the following:
- Backend:
```sh
php artisan serve
```

- Frontend:
```sh
npm npm run watch
```

Now access the link via browser to check:
```sh
http://127.0.0.1:8000/
```
OR
```sh
http://localhost:8000/
```
