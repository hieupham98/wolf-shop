For installing this application: 

Please install required tool below: 
- Docker
- Docker-compose

Firstly, we have to build some images of the application by command: 

```
    cd docker
    docker compose build 
```

We need add .env file for docker compose buy adding .env or copy from .env.example

```
    cp .env .env.example
```

```
./docker/.env
    COMPOSE_PROJECT_NAME=wolf-shop
    DOMAIN=wolf-shop.localhost
    TRAEFIK_DOMAIN=traefik.wolf-shop.localhost
    PORT=8080
    APP_FOLDER=../
    DB_DATABASE=learnbetter
    DB_USERNAME=learnbetter
    DB_PASSWORD=secret
```

I use traefik for binding services with url in docker compose

Secondly, we have images and run all of them buy command: 
```
docker compose up -d 
```

After that, we move to the root folder and create an .env file, or copy .env.example of Laravel application. Ensuring that we have enought of keys below 
```
    cd ../
    cp .env .env.example
```
or create a new file
```
./.env
#database
DB_CONNECTION=mysql
DB_HOST=mariadb
DB_PORT=3306
DB_DATABASE=learnbetter
DB_USERNAME=learnbetter
DB_PASSWORD=secret

#cloudinary
CLOUDINARY_URL=cloudinary://API_KEY:API_SECRET@CLOUD_NAME
```
Then, install package in composer.json by running commands: 

```
docker exec -it  wolf-shop-php-1 composer install 

```

Generate key of application by running commands: 


```
docker exec -it  wolf-shop-php-1 php artisan key:generate 

```

Migrate database of application by running commands: 

```
docker exec -it  wolf-shop-php-1 php artisan migarate

```

On the requirment: 

```
Create a console command to import Item to our inventory from API https://api.restful-api.dev/objects (https://restful-api.dev/). In case Item already exists by name in the storage, update Quality for it.
```
We can run the  command below for importing data: 
```
docker exec -it  wolf-shop-php-1 php artisan items:import-from-api
```


Now we can test our application by route ping:

```
http://wolf-shop.localhost:8080/api/ping
 
{
    pong
}
```

For updating item and decrease sellin of all of it, we can access to api: 

```
http://wolf-shop.localhost:8080/api/decrease-sellin

```

For uploading image to cloudary and update it to imageUrl of a specific item, we can access to api: 

```
    http://wolf-shop.localhost:8080/api/upload-images

    payload: 
    {
        image: <file>, 
        item_id: <required/int>
    }
```

Review all items: 
```
 http://wolf-shop.localhost:8080/api/items
```