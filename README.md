
# Frontend Blade Project

## Project Requirements
* php: ^8.2
* laravel: ^11.9

## How to run locally
git clone https://github.com/hsn-dev/FE-blade-project.git <br>
cd FE-blade-project <br>
composer install <br>
update .env file for database connection <br>
php artisan migrate <br>
php artisan serve <br>

## Developer Notes
**Controllers**

* ProfileController <br>
    In this controller i have listing view and detail view
* AjaxController <br>
    In this controller i make request for external api and build data for ajax.

**Views**

I have created main layout view called app.blade.php and all the other views inherit from it. Other than this we have views for listing and show profile.

**Features**

* Pagination added
* Search based on first_name and last_name
* Filter based on gender
* Detail profile view