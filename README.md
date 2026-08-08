# DocuRent - Camera & Documentation Equipment Rental

🔗 **Live Demo:** [https://docurent.onrender.com](https://docurent.onrender.com)

> **About This Project**  
> This project was originally developed as a group final project for a Web Programming course during my 4th semester. I later revisited the project to reorganize and improve parts of the codebase, while using it as an additional repository and a personal learning project.

DocuRent is a web-based platform that allows users to rent a wide variety of professional photography and videography equipment, such as cameras, lenses, lighting, drones, and other accessories. It is built with the **Laravel 12** framework and styled modernly using **Tailwind CSS v4**.

## Key Features

- **Product Catalog & Filters:** Browse various product categories and sort them based on your documentation equipment needs.
- **Cart & Checkout System:** Automatically calculate rental durations, check real-time stock availability, and place orders efficiently.
- **Premium Admin Panel:** Manage products, verify payments (Approve/Reject), and monitor incoming orders through a clean and functional dashboard. Features automated stock restoration if an order is rejected.
- **User Authentication:** Secure registration and login system to track users' rental histories.
- **Payment Verification & Order Status:** A dedicated feature for users to upload transfer receipts and monitor their approval or rejection status from the admin.
- **Luxurious Frontend:** A clean, fully mobile-responsive UI/UX design applying modern concepts (*glassmorphism*, micro-animations).

## Tech Stack

- **Backend:** Laravel 12.x (PHP 8.2+)
- **Frontend:** Tailwind CSS v4.x (via Vite), Blade Templating Engine
- **Database:** SQLite (for local development) and **PostgreSQL** (for production/deployment).
- **Infrastructure:** Docker (Nginx + PHP-FPM Alpine)

## Prerequisites

Make sure you have the following tools installed:
- PHP 8.2 or higher
- Composer
- Node.js & npm (for compiling frontend assets)

## Local Installation Guide

1. **Clone this repository:**
   ```bash
   git clone <URL_REPO>
   cd DocuRent
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Install Node dependencies:**
   ```bash
   npm install
   ```

4. **Environment Configuration:**
   ```bash
   cp .env.example .env
   ```
   Set up your database connection in the `.env` file. By default, this application uses SQLite for local development.

5. **Generate App Key:**
   ```bash
   php artisan key:generate
   ```

6. **Database Migration & Seeding (Optional):**
   ```bash
   php artisan migrate --seed
   ```
   *Note: If you are using SQLite, make sure to create an empty `database/database.sqlite` file before running the migration command.*

7. **Compile Frontend Assets:**
   ```bash
   npm run build
   ```

8. **Link Storage:**
   ```bash
   php artisan storage:link
   ```

9. **Run the Application:**
   ```bash
   php artisan serve
   ```
   Access the application at `http://127.0.0.1:8000`.

## Deployment (Production via Docker)

This repository includes a custom `Dockerfile` infrastructure and a startup script designed specifically for easy deployment on PaaS platforms like **Render**, Fly.io, or Railway.

The Docker image comes pre-configured with the `pdo_pgsql` extension for Supabase/PostgreSQL and an automated database seeder (which automatically injects data when the server is spun up for the first time).

1. **Build the Docker image:**
   ```bash
   docker build -t docurent-app .
   ```
2. **Run the container (optional, for local testing):**
   ```bash
   docker run -d -p 8080:80 docurent-app
   ```
   *(The application will run and be exposed on port 8080, served by Nginx and PHP-FPM inside the container).*

## License

This project is open-source and available under the [MIT license](https://opensource.org/licenses/MIT).
