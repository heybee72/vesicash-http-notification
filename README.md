# Take-home assignment

creating a HTTP notification system.

# Installation

### Step 1

Clone or download this repository to your machine:


### Step 2

`composer install` to install all composer packages

Create your database, rename `.env.sample` to `.env` then, change `DB_DATABASE` value to your database and change `QUEUE_CONNECTION` from sync to database.

`php artisan migrate` to create necessary tables

### Step 3

Start your laravel development server : `php artisan serve` this serves the application to default `localhost:8000`

When publishing a topic make sure you execute `php artisan queue:work` on your terminal to dispatch the necessary queued jobs.

### Step 4

Open Postman run the Api endpoints. Documentation can be accessed below

# Documentation

Link to api Docs (https://documenter.getpostman.com/view/12964898/2s83S89XHF)

