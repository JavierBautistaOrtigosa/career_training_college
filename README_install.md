### README - How to run the app

1. Open the XAMPP Control Panel and start:
    - **Apache**
    - **MySQL**
2. Create the database:
    - Open phpMyAdmin
    - Click New
    - Create a new database named:
      `career_training_college`
    - This name must match the value in your .env file.
3. Install PHP dependencies:
    - In the project root folder, run:
      `composer install`
4. Create your `.env` file:
    - Copy the example environment file:
      `copy .env.example .env`
    - Then open `.env` and update the database section using the default XAMPP credentials:

```Code
DB_DATABASE=career_training_college
DB_USERNAME=root
DB_PASSWORD=
```

5. Generate the application key:
    - Laravel requires an application key to run:
      `php artisan key:generate`

6. Database Setup (Two Options).
    - You may choose **either** method below.

- **OPTION A: Import the included SQL file.**
    - This project includes a ready‑to‑use SQL export : `career_training_college.sql`:
    - To import:
        1. Open phpMyAdmin
        2. Select the `career_training_college` database
        3. Click **Import**
        4. Choose the SQL file
        5. Click **Go**
    - This loads all tables and sample data exactly as used during development.

- **OPTION B: Use Laravel Migrations + Seeders**
    - If you prefer to build the database from scratch:
        1. Complete steps 1-5 above.
        2. Run: `php artisan migrate --seed`
            - This will:
                - Create all tables
                - Insert sample members
                - Insert sample events
                - Create the admin user

5. Run the Application:
    1. Start the Laravel development server:
        - `php artisan serve`
        - Then open the application in your browser:
            - `http://127.0.0.1:8000`
