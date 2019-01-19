# LaraCRUD

## Installation

Install the package via Composer

`composer require heyatalent/laracrud`

## Usage

Run the following command to generate CRUD for Controller, Model, Migrations, View, and Routes

`php artisan make:crud Project`

The above command will generate:
* `app/Controllers/ProjectsController.php`
* `app/Project.php` 
* `database/migrations/YYYY_MM_DD_HHMMSS_create_projects_table.php`
* Resourceful views:
    * `resources/view/projects/index.blade.php`
    * `resources/view/projects/create.blade.php`
    * `resources/view/projects/show.blade.php`
    * `resources/view/projects/edit.blade.php`
* At the bottom of the `routes/web.php` file:
    * `Route::resource('projects', 'ProjectsController');`