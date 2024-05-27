## iPhone Cover World
Developed by app.com.mm

#### Install Composer dependencies
```
composer install
```

#### Setup .env
```
cp .env.example .env
```

```
php artisan key:generate
```

```
nano .env
```

```
APP_ENV=production

DB_CONNECTION=mysql
DB_HOST=your_database_host
DB_PORT=your_database_port
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

#### Set Permissions
```
sudo chown -R www-data:www-data storage
sudo chown -R www-data:www-data bootstrap/cache
sudo chown -R www-data:www-data public/media
```

#### Database
```
php artisan migrate --seed
```

#### Optimize Laravel
```
php artisan optimize
```
