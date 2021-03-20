# Тестовое задание ROASUP #

### Доступные методы ###

1. api/getAllCategory

Типы запросов:  
>GET  

Передоваемые данные:  
>Не требуются  

2. api/addProduct

Типы запросов:  
>POST  

Передоваемые данные:  
>name (string)  
>category (string)  
>price (float)  

3. api/updateProduct/{id}

Тип запроса:  
>PUT  

Передоваемые данные:  
>name (string)  
>category (string)  
>price (float)  

4. api/search

Тип запроса:  
>POST  

Передоваемые данные:  
>category (array)  
>page (int)  
>perPage (int)  

### Установка ###

1. Скопировать репозиторий на сервер
2. В CLI набрать composer i и дождаться установки
3. Подключить в .env.local нужный драйвер БД
4. Выполнить миграцию

Готово.

### Стек ###

PHP 7.4.1  
Symfony 5.2  
MySQL 8.0
