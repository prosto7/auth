Тестовое задание на позицию Junior PHP-разработчика

Был реализован WEB-интерфейс для администрирования и просмотра, поиска и сортировки записей данных пользователей.
Реализована возможность регистрации и аутентификации обычных пользователей для просмотра данных.
Администратор(пользователь с расширенными правами) может добавлять, редактировать и удалять записи из базы данных.
Развернутый проект доступен по ссылке: http://srv169432.hoster-test.ru/

Используемые технологии:
Веб сервер Apache 2.4
PHP 7.3
PDO
БД MYSQL 5.6 
jQuery
DataTable - библиотека для формирования таблиц jquery
arcticModal - библиотека для модальных окон jquery
Bootstrap

sibers.sql - файл таблицы БД

Логин и пароль суперадмина:
hello123
hello123

Логин и пароль обычного пользователя:
Player12
Player12

Стандартная конфигурация подключения к БД (class Tools(connect and alternativeConnect))
$host = "127.0.0.1",
$user = 'root', 
$pass = '', 
$dbname = 'sibers'

Структура проекта:
в директории pages хранятся основные файлы проекта 

classes.php  классы ООП, также конфигурация подключения к БД class Tools(схема прикреплена в корне classes.png)
db.php  - файл создания таблицы БД
menu.php - содержит head и навигацию по сайту, присутствует в каждой странице проекта
login.php и registration.php - аутентификации и регистрация пользователей.
admin_forms.php - содержит в себе функционал администрирования записей БД (CRUD)
data.php и table.php  -  вывод данных в таблицу с функцией сортировки на PHP 
data_page.php - вывод данных в таблицу с функциями сортировки, пагинации,поиска и просмотра полной информации с использованием библиотеки 'datatables'
ajaxfile.php - реализация вывода данных на страницу data_page.php
out.php - служит для разлогинивания пользователя



