# mu-edu-task

Note : facebook needs online secure server (https) to work

this message appears when i am logining by facebook

(Insecure login blocked: You can't get an access token or log in to this app from an insecure page. Try re-loading the page as https://)

setup notes :

git clone https://github.com/HassanYoussefDev/mu-edu-task.git

cd mu-edu-task

composer install

change  .env.example to .env

add mysql connection info in .env file

php artisan key:generate

php artisan migrate
