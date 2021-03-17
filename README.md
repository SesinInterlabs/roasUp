# Тестовое задание ROASUP #

### Доступные методы ###

1. api/getAllCategory

>Типы запросов:
>>GET
>Передоваемые данные:
>>Не требуются

2. api/addProduct

>Типы запросов:
>>POST
>Передоваемые данные:
>>name (string)
>>category (string)
>>price (float)

3. api/updateProduct/{id}

>Тип запроса:
>>PUT
>Передоваемые данные:
>>name (string)
>>category (string)
>>price (float)

4. api/search

>Тип запроса:
>>POST
>Передоваемые данные:
>>category (string)
>>page (int)
>>perPage (int)

### Установка ###

1. Скапировать репозиторий на сервер

2. В CLI набрать composer i и дождаться установки

Готово.

### Стек ###

PHP 7.4.1  
Symfony 5.2  
MySQL 8.0  