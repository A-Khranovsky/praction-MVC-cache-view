## Vocation
Praction with caching the html pages to redis storage and get them from.

## Description
Project uses MVC pattern. It creates view, caches it in redis storage once, on first request, outputs
it from storage in all other cases. MVC pattern handles to routes:
* pages.html
* pages.rss
which must be inputted as parameter Controller in file index.php.
  
## How to run
```angular2html
docker-compose up -d
```
```angular2html
docker exec -it 39_php-apache_1 bash
```
```angular2html
service redis-server restart
```
### Example of stored cached pages:
```angular2html
root@ea6687a03be1:/var/www/html# redis-cli
127.0.0.1:6379> keys *
1) "pages.html"
2) "pages.rss"
127.0.0.1:6379> get pages.html
"<!DOCTYPE html>\n<html lang=\"ru\">\n<head>\n\t<title>Pages</title>\n\t<meta charset=\"utf-8\">\n</head>\n<body>\n\t<h1>Title1</h1><p>Content1</p><br /
><h1>Title2</h1><p>Content2</p>\n</body>\n</html>"
127.0.0.1:6379> get pages.rss
"\t<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n\t<rss version=\"2.0\" xmlns:atom=\"http://www.w3.org/2005/Atom\">\n\t\t<chanel>\n\t\t\t<title>Pages</tit
le>\n\t\t\t<link>http://example.com/</link>\n\t\t\t\t<item><title>Title1</title><content>Content1</content></item><item><title>Title2</title><content>Co
ntent2</content></item>\n\t\t</chanel>\n\t</rss>\t"
127.0.0.1:6379>

```