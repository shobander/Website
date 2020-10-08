-- CREATE DATABASE
CREATE DATABASE laravel;

-- CREATE USER AND GRANT PERMISSIONS
CREATE USER "dev"@"localhost" IDENTIFIED BY "dev_password_11";
GRANT all ON laravel.* TO "dev"@"localhost";