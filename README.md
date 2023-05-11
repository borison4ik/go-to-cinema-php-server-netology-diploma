# Идем в Кино

## Установка

```
composer install
```

## Запустить сервер

Адрес веб сервера _http://localhost:8000_

```
php artisan serve
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
