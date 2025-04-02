## Installation Guide With Docker
Generate `.env` file and `auth.json` file and modify by given values.
```shell
cp .env.example .env
cp auth.json.example auth.json
```
Build and run the docker containers
```shell
docker-compose up -d
```
Enter the backend container
```shell
docker compose exec -u cosmos workspace zsh
```
Install composer dependencies
```shell
composer install
```
Generate application key
```shell
php artisan key:generate
```
Run the migrations and seeders
```shell
php artisan migrate
```
Seed the database with the default user (email: test@example.com, password: password)
```shell
php artisan db:seed
```
Create symbolic link for storage
```shell
php artisan storage:link
```
Install Nova dependencies (you have to revert the changes of `User` model after running this command)
```shell 
php artisan nova:install
```
Exit the container
```shell
exit
```

## Usage
You can access the application on `http://localhost` and the Nova dashboard on `http://localhost/admin`. You can login to the Nova dashboard with the default user (email: test@example, password: password).
It's recommended to use Postman or Insomnia to test the API.

## Special Notes

If you are using linux, you may need to change the permissions of the storage folder.
```shell
sudo chmod -R a+rwX .
```
If Ubuntu launch default apache server on port 80, you need to disable it.
```shell
sudo systemctl disable apache2
```
