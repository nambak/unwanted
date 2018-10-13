# unwanted

This in an open source forum that was built and maintained at unwanted.com.

## Installation

### Step 1.

> To run this project, you must have PHP 7 installed as a prerequisite.

Begin by cloning this repository to your machine, and install all Composer dependencies.

```bash
git clone git@github.com:nambak80/unwanted.git
cd unwanted && composer install
php artisan key:generate
mv .env.example .env
``` 

### Step 2.

Next, create a new database and reference its name and username/password within the project's `.env` file. In the example blow, we've named the database, "unwanted"

```
DB_CONNECT=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=unwanted
DB_USERNAME=root
DB_PASSWORD=
```