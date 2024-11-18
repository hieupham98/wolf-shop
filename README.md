# Application Installation and Setup Guide

This guide walks you through the installation and configuration of the application using Docker and Docker Compose.

https://www.docker.com/

## Prerequisites

Before proceeding, ensure that the following tools are installed on your system:

- **Docker**  
- **Docker Compose**

## Step 1: Build Docker Images

To build the necessary Docker images, run the following commands:

1. Navigate to the `docker` directory:

    ```bash
    cd docker
    ```

2. Build the Docker images using Docker Compose:

    ```bash
    docker-compose build
    ```

## Step 2: Configure Environment Variables for Docker Compose

The application requires an `.env` file for configuration. You can either create this file manually or copy from the example file.

1. Copy the contents of `.env.example` to `.env`:

    ```bash
    cp .env.example .env
    ```

2. Edit the `.env` file located in `./docker/.env` with the following configuration:

    ```dotenv
    COMPOSE_PROJECT_NAME=wolf-shop
    DOMAIN=wolf-shop.localhost
    TRAEFIK_DOMAIN=traefik.wolf-shop.localhost
    PORT=8080
    APP_FOLDER=../
    DB_DATABASE=learnbetter
    DB_USERNAME=learnbetter
    DB_PASSWORD=secret
    ```

   - **COMPOSE_PROJECT_NAME**: The project name for the Docker Compose setup.
   - **DOMAIN**: The domain for your application.
   - **TRAEFIK_DOMAIN**: The domain for the Traefik reverse proxy.
   - **PORT**: The port on which the application will run.
   - **APP_FOLDER**: Path to the root directory of the application.
   - **DB_DATABASE, DB_USERNAME, DB_PASSWORD**: MySQL database credentials.

## Step 3: Start Docker Containers

Now that the environment file is set up, you can start the application services.

1. Run the following command to start the containers in detached mode:

    ```bash
    docker-compose up -d
    ```

## Step 4: Set Up Laravel Environment

Once the Docker containers are up and running, move to the root folder of your Laravel application and set up the `.env` file.

1. Navigate to the root of the Laravel application:

    ```bash
    cd ../
    ```

2. Copy the `.env.example` to `.env` or create a new `.env` file manually:

    ```bash
    cp .env.example .env
    ```

3. Edit the `.env` file with the following configuration for the database and Cloudinary settings:

    ```dotenv
    # Database Configuration
    DB_CONNECTION=mysql
    DB_HOST=mariadb
    DB_PORT=3306
    DB_DATABASE=learnbetter
    DB_USERNAME=learnbetter
    DB_PASSWORD=secret

    # Cloudinary Configuration
    CLOUDINARY_URL=cloudinary://API_KEY:API_SECRET@CLOUD_NAME
    ```

   - **DB_CONNECTION**: The database connection type (MySQL).
   - **DB_HOST**: The host for the MySQL database container (`mariadb` in this case).
   - **DB_PORT**: The port for MySQL (`3306`).
   - **DB_DATABASE, DB_USERNAME, DB_PASSWORD**: MySQL database credentials.
   - **CLOUDINARY_URL**: Your Cloudinary credentials.

## Step 5: Install Laravel Dependencies

Next, install the Laravel dependencies using Composer inside the PHP container.

1. Run the following command to install the required packages:

    ```bash
    docker exec -it wolf-shop-php-1 composer install
    ```

## Step 6: Generate Application Key

Generate a new application key for Laravel:

```bash
docker exec -it wolf-shop-php-1 php artisan key:generate
```
## Step 7: Migrate the Database
Run the database migrations to set up the required tables in the database:

```bash
docker exec -it wolf-shop-php-1 php artisan migrate
```
## Step 8: Import Items from API
You need to create a console command to import items into the inventory from the external API.

Run the following command to import data from the API:
```bash
docker exec -it wolf-shop-php-1 php artisan items:import-from-api
```

This will import items from https://api.restful-api.dev/objects. If an item already exists by name in the database, its quality will be updated.

## Step 9: Testing the Application
Once the application is set up, you can test it using the following routes.

### Ping Route
To test if the application is running, access the ping route:

```bash
http://wolf-shop.localhost:8080/api/ping
```
You should receive the following response:

```json
{
    "status": "pong"
}
```

## Decrease Sellin for All Items
To decrease the sellin for all items in the inventory, use the following route:

```bash
http://wolf-shop.localhost:8080/api/decrease-sellin
```
Upload Image to Cloudinary
To upload an image and associate it with a specific item, use the following API route:

```bash
Sao chép mã
http://wolf-shop.localhost:8080/api/upload-images
```
Payload example:

```json
{
    "image": <file>,
    "item_id": <required/int>
}
```
### View All Items
To review all items in the inventory, visit:

```bash
http://wolf-shop.localhost:8080/api/items
```
Basic Authentication
The API is protected with Basic Authentication. Use the following credentials to authenticate:

```json
Username: developer
Password: secret
```
