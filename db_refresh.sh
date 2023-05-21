#!/bin/bash

alias docker-compose='sudo docker-compose'
alias artisan='sudo docker-compose exec app php artisan'

#sudo docker-compose down
#sudo docker-compose up -d

#sleep 10

sudo docker-compose exec app php artisan db:wipe
sudo docker-compose exec app php artisan migrate
sudo docker-compose exec app php artisan db:seed --class SurveySeeder



