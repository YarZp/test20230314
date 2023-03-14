```
docker-compose up -d
sudo chmod 777 -R storage
docker exec -it project_app bash

composer install
php artisan migrate
php artisan db:seed
php artisan passport install

laravel
http://localhost:8080
adminer
http://localhost:7779
```
