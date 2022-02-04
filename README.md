Запуск:
1. Поочередно выполнить sql запросы из sql_requests/requests.sql
2. Изменить настройки подключения к БД (если нужно) в config/database.php
3. Установить зависимости
4. Находясь в корневой папке, запустить встроенный php сервер командой:
   > php -S localhost:8002 pub\index.php
5. Перейти по адресу:
   > http://localhost:8002/create_order