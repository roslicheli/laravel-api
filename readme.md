# laravel-api
laravel api with dingo cors jwt--
transformer and api-route

#configuration
1. cd to cloned folder/directory
2. run command:- composer install
3. copy .env.example .env
4. add entry in .env API_PREFIX=api
5. configure database in .env
6. run command:- php artisan key:generate
7. run command:- php artisan migrate
8. run command:- php artisan db:seed --class=UserSeeder