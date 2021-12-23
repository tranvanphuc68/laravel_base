<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


## Cài đặt và sử dụng CMS

#### Cài đặt docker

```
cd ~/path/to/project

docker-compose up -d --build
```

#### Cài đặt Laravel
```
docker exec -it php_laravel_base /bin/sh

composer install

cp .env.example .env

php artisan config:cache

php artisan cms:setup --auth-seed
```

#### Chạy thử
```
Truy cập: http://127.0.0.1:8000/

admin:
email: admin@caerux.cms
password: 00000000

user:
email: user@caerux.cms
password: 00000000
```

#### Tạo module

```
php artisan cms:create {module}
```

- Options:
    - model
    - controller
    - middleware
    - request
    - service
    - repository

- Quy ước:
  - Tên module, controller chỉ chức năng.
  - Tên service, repository tương ứng với model.
  - Tên middleware, request chỉ hành động.

- Ví dụ:

```
php artisan cms:create management --service=user --repository=user

cms
|
|___Core
|   |
|   |___Repositories
|   |   |
|   |   |___Contracts
|   |   |   |
|   |   |   |___CoreUserRepositoryContract.php
|   |   |
|   |   |___CoreUserRepository.php
|   |
|   |___Services
|   |   |
|   |   |___Contracts
|   |   |   |
|   |   |   |___CoreUserServiceContract.php
|   |   |
|   |   |___CoreUserService.php
|   |
|   |___CoreServiceProvider.php
|
|___Management
    |
    |___Repositories
    |   |
    |   |___Contracts
    |   |   |
    |   |   |___ManagementUserRepositoryContract.php
    |   |
    |   |___MangementUserRepository.php
    |
    |___Services
    |   |
    |   |___Contracts
    |   |   |
    |   |   |___ManagementUserServiceContract.php
    |   |
    |   |___ManagementUserService.php
    |
    |__ManagementServiceProvider.php
```

- Lưu ý:
  - Tự đăng ký các services và repositories vào trong ServiceProvider.
  - Tự đăng ký các ServiceProvider vào trong CmsServiceProvider.php.

#### Thư viện
1. [Spatie](https://spatie.be/docs/laravel-permission/v5/introduction)

## Happy coding !!!
