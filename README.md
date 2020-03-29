# Aplikasi Web Kasir

## Environment
 - PHP 7 or higher
 - webserver ( nginx, apache & etc. )
 - database mysql

## Testing
 - clone project ini
 - Masuk ke direktori project dengan terminal
 - Lalu jalan kan perintah ``` php -S ip:port ```
  * contoh : ``` php -S localhost:8080 ```
 - Buka ip tadi di browser

## Beberapa bug dan cara memperbaikinya
 - CodeIgniter Error 1055. fix : jalankan query ini di database mysql ``` SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY','')); ```
