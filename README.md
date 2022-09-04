 ## Installation
 
 
 > To run this project, you must have PHP 8 installed as a prerequisite.

 Begin by cloning this repository to your machine, and installing all Composer dependencies.
 
 ```bash
 clone git@github.com:rin4ik/school-management-system.git
 cd school-management-system 
 composer install
 npm install
 npm run dev
 php artisan key:generate
 cp .env.example .env
 php artisan migrate --seed
 php artisan serve

 Navigate to http://localhost:8000

 Login with already seeded users
 ``` 
 