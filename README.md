# Simple-Perpustakaan
Made for tests, simple book lending web application use Laravel framework which consists of 2 multi auth for Admins and Members

## Installation

``` bash
#clone repo
git clone https://github.com/HendraPB/Simple-Perpustakaan.git

# change your directory to project
cd Simple-Perpustakaan

# configure installation
cp .env.example .env

# install laravel dependencies
composer install

# run project in localhost:8000
php artisan serve


## Note: by default this project included SQLite database so there is no need to configure the database, but if you want to use another database you can configure the .env file and run the following command
php artisan migrate:refresh --seed