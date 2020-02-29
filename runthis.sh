PGPASSWORD="$1" ../../../postgresql/bin/psql -U postgres -c "CREATE DATABASE demo22;"
PGPASSWORD="$1" ../../../postgresql/bin/psql -U postgres -c "DROP DATABASE demo22;"
