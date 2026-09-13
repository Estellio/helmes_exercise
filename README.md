# Sector Selection Form

This is a Laravel application that allows users to enter their name, select the sectors they work in (1 to 5), accept the terms and save their information to a database.

The application uses the current Laravel session to connect a user with their saved form submission. After the form has been submitted, the form fields are cleared and the saved data is automatically loaded back into the form while the same session remains active. This allows the user to edit their information (name and sectors) without creating a new submission.

## Tech Stack

The project is built with:

* PHP 8.3+
* Laravel 13
* Livewire 4
* Docker / Laravel Sail
* Tailwind CSS 4
* Vite
* Flowbite
* MySQL 8.4
* Redis

## Features

The form allows the user to:

* Enter their name.
* Select 1 to 5 sectors.
* Select sectors from a hierarchical list of industries and sub-sectors.
* Accept the terms before submitting.
* Save the form data to the database.
* Automatically retrieve previously submitted data using the current session.
* Edit and update the existing submission during the same session.


## Database Structure

The application uses three tables to store the form data.

### `form_submissions`

Stores the main form submission.

| Column         | Description                                       |
| -------------- | ------------------------------------------------- |
| `id`           | Primary key                                       |
| `session_id`   | Laravel session ID associated with the submission |
| `name`         | User's submitted name                             |
| `accept_terms` | Whether the terms were accepted                   |
| `created_at`   | Creation timestamp                                |
| `updated_at`   | Last update timestamp                             |

The `session_id` is unique, meaning a session can only have one form submission. When the user saves the form again, the existing submission for that session is updated instead of creating another one. The session ends when the browser window is closed and a new session will begin the next time it is opened.

### `sectors`

Stores the available sectors.

| Column                 | Description                            |
| ---------------------- | -------------------------------------- |
| `id`                   | Primary key                            |
| `sector_number`        | Unique identifier for the sector       |
| `name`                 | Sector name                            |
| `parent_sector_number` | Parent sector, if the sector is nested |
| `created_at`           | Creation timestamp                     |
| `updated_at`           | Last update timestamp                  |

The sector table has a self-referencing relationship through `parent_sector_number`. This allows sectors to contain child sectors and creates the nested sector hierarchy displayed by the form.

The initial sector data is inserted using `SectorSeeder`.

### `form_submission_sector`

Pivot table connecting form submissions with their selected sectors.

| Column               | Description                  |
| -------------------- | ---------------------------- |
| `form_submission_id` | References a form submission |
| `sector_number`      | References a selected sector |
| `created_at`         | Creation timestamp           |
| `updated_at`         | Last update timestamp        |

A form submission can contain multiple sectors, and a sector can belong to multiple form submissions, creating a many-to-many relationship.

## How Saving and Editing Works

When the page is first opened, the Livewire component checks the database for a `FormSubmission` matching the current Laravel session ID.

If one exists, the saved name, selected sectors, and terms value are loaded into the form.

When the form is submitted, Laravel validates the input and then uses the current session ID to either create a new submission or update the existing one.

The selected sectors are synchronized with the `form_submission_sector` pivot table.

Because the submission is associated with the session rather than a user account, the saved information remains editable while that session is still available. Starting a new session will be treated as a new form submission.

# Local Setup

## Prerequisites

The project uses Docker and Laravel Sail for local development.

### Windows

- Git
- WSL 2
- Docker Desktop with WSL 2 integration enabled
- Composer installed inside WSL

It is recommended to clone the project inside the WSL filesystem rather
than the Windows filesystem for better Docker performance.

### macOS

- Git
- Docker Desktop
- Composer

WSL is not required on macOS.

Once the prerequisites are installed, the remaining setup commands are
the same on both Windows (from a WSL terminal) and macOS.

## 1. Clone the Repository

Clone the repository and enter the project directory:

```bash
git clone <repository-url>
cd <repository-directory>
```

Alternatively, download the project from GitHub as a ZIP, extract it, and open the project directory from your WSL terminal.

For the best Docker/WSL performance, keep the project inside the WSL filesystem rather than the Windows filesystem.

For example:

```bash
~/projects/<repository-directory>
```

rather than:

```text
/mnt/c/Users/...
```

## 2. Create the Environment File

Copy the example environment configuration:

```bash
cp .env.example .env
```

## 3. Configure MySQL

The included Docker Compose configuration provides a MySQL 8.4 container.

The darabase section currently matches the Docker configuration with default credentials.

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

The important part when using Laravel Sail is:

```bash
DB_HOST=mysql
```

The Laravel container communicates with the MySQL container using its Docker service name (`mysql`) rather than `localhost`.

You can change the database name, username, and password if required, but the values in `.env` must match the values used by the Docker configuration.

## 4. Install PHP Dependencies

If the project was freshly cloned from Git, the `vendor` directory will not exist.

Install the Composer dependencies:

```bash
composer install
```

This installs Laravel and the project's other PHP dependencies, including Laravel Sail.

## 5. Start Docker

Start the application's Docker containers:

```bash
./vendor/bin/sail up -d
```

This starts the Laravel application, MySQL, and Redis containers in the background.

You can check the running containers with:

```bash
./vendor/bin/sail ps
```

## 6. Generate the Application Key

Generate the Laravel application key:

```bash
./vendor/bin/sail artisan key:generate
```

This writes the generated key to `APP_KEY` in the `.env` file.

## 7. Run Migrations and Seed the Database

Create the database tables and insert the sector data:

```bash
./vendor/bin/sail artisan migrate --seed
```

The seeder populates the `sectors` table with the sector hierarchy required by the form.


## 8. Install Frontend Dependencies

Install the Node dependencies through Sail:

```bash
./vendor/bin/sail npm install
```

## 9. Start Vite

For development, start the Vite development server:

```bash
./vendor/bin/sail npm run dev
```

Keep this command running while developing.

Alternatively, create a production frontend build with:

```bash
./vendor/bin/sail npm run build
```

## 10. Open the Application

Once Sail is running, open:

```text
http://localhost
```

in your browser.

If `APP_PORT` has been changed in `.env`, use that port instead.

For example, with:

```env
APP_PORT=8000
```

the application would be available at:

```text
http://localhost:8000
```

# Useful Development Commands

Start the Docker containers:

```bash
./vendor/bin/sail up -d
```

Stop the containers:

```bash
./vendor/bin/sail down
```

View running services:

```bash
./vendor/bin/sail ps
```

Run migrations:

```bash
./vendor/bin/sail artisan migrate
```

Reset and reseed the database:

```bash
./vendor/bin/sail artisan migrate:fresh --seed
```

Run the frontend development server:

```bash
./vendor/bin/sail npm run dev
```

Build frontend assets:

```bash
./vendor/bin/sail npm run build
```

# Project Structure

Some of the main files used by the application are:

```text
app/
└── Models/
    ├── FormSubmission.php
    └── Sector.php

database/
├── migrations/
│   ├── create_sectors_table.php
│   ├── create_form_submission.php
│   └── create_form_submission_sector.php
└── seeders/
    ├── DatabaseSeeder.php
    └── SectorSeeder.php

resources/
├── css/
│   └── app.css
├── js/
│   └── app.js
└── views/
    ├── index.blade.php
    └── components/
        ├── sectors-form.blade.php
        ├── sector-option.blade.php
        └── validation-error.blade.php

routes/
└── web.php

compose.yaml
```

`FormSubmission` represents the saved form data, while `Sector` represents the hierarchical sector data.

The `sectors-form` Livewire component handles loading the sectors, validating the form, creating or updating submissions, synchronizing selected sectors, and repopulating the form with previously saved session data.

## AI Usage

AI tools were used during the development of this project to assist with tasks such as research, troubleshooting, code review, and documentation.

A more detailed description of how and where AI was used can be found here:

**[View AI Usage Documentation](https://docs.google.com/document/d/1RsXqxivklrix4EGrB7Gnawyey0m2HD3cH6M7sU78Kqo/edit?usp=sharing)**

## Notes

The application does not currently use user authentication to identify form submissions. Instead, submissions are associated with Laravel's session ID.

As a result, saved data can be retrieved and edited while the same session remains active. If the session expires, is cleared, or the application is accessed through a different session, the previous submission will no longer automatically populate the form.
