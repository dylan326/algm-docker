<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>


How to run this program locally with docker:

1. Requirements: Have composer and laravel installed globally.  Have docker-ce and docker-compose installed
2. Create a local directory and clone this repo to it.
3. Update the env.example with correct database credentials from the docker-compose.yml file
    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=dbname
    DB_USERNAME=dbuser
    DB_PASSWORD=654321
    
4. Save the env.example as just .env so it's the actual enviroment file.
5. Change the permissions on the bootstrap and storage folders to www-data:www-data (for ubuntu the command is "sudo chown -R      www-data:www-data bootstrap/ storage/")
6. Run composer update to make sure the auto load scripts are correct
7. Run docker compose (Ubuntu: "sudo docker-compose up")
8. When the containers are running you need to get bash access to the server and database.  Find continer names by running        "docker ps -a" and then get into the bash with command "sudo docker exec -it [container name here] bash -l"
9. Once in generate a key with "php artisan key:generate" and migrate the database tables with "php artisan migrate" and that's    it.

Note: the command to pull the API endpoint data is "php artisan add:apidata". Conversly to delete the data and start fresh run "php artisan delete:apidata"
