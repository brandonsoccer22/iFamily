# iFamily
iFamily is a family management system

# Installation
Pre: make sure to have PHP 7.1 or higher and MySQL installed

First Install [Composer](https://getcomposer.org/download/).

Then Install [Laravel](https://laravel.com/docs/5.7/installation) with "composer global require "laravel/installer" and add laravel to your PATH.
See link for more details.

Clone Repository and run "composer install" in the repositories parent directory.

After configuring the database connection in the .env file, run "php artisan migrate"

In the repository, run the command "php artisan serve".  The web application should be served locally. 

For dev, be sure to download the env file in the Team drive and add it to the parent directory
