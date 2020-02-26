
..\..\..\postgresql\bin\psql.exe -U postgres -c "CREATE DATABASE demo;"
..\..\..\postgresql\bin\psql.exe -U postgres -f create_name.sql demo
..\..\..\postgresql\bin\psql.exe -U postgres -f create_statuses.sql demo
..\..\..\postgresql\bin\psql.exe -U postgres -f insert_name.sql demo
..\..\..\postgresql\bin\psql.exe -U postgres -f insert_statuses.sql demo

