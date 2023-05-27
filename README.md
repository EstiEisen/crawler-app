# crawler-app

installation- crawler app angular+laravel

git clone https://github.com/EstiEisen/crawler-app.git

the backend-laravel

cd crawler-api

composer install

cp .env.example .env

php artisan key:generate

Add the database config in the .env file (DB_DATABASE=root DB_USERNAME=root password="")

php artisan migrate

php artisan serve

the frontEnd-angular

cd crawler-front

npm install

ng serve
