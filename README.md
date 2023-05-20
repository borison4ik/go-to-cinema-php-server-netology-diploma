# Идем в Кино

## Установка

```
composer install
```

## База данных

Для создания новой базы определите настройки подключения и запустите миграции с сидами

```
php artisan migrate --seed
```

## ENV файл

добавить хот сесии

```
SESSION_DOMAIN=localhost
```

## Запустить сервер

Адрес веб сервера _http://localhost:8000_

```
php artisan serve
```

## Регистрация и Авторизация

Регистрация администратора по ссылке [http://localhost:3000/admin/register](http://localhost:3000/admin/register)
Администратором назначается первый зарегистрировавшийся юзер

Авторизация по ссылке [http://localhost:3000/admin/login](http://localhost:3000/admin/login)

## Панель Администратора

[http://localhost:3000/admin](http://localhost:3000/admin)
