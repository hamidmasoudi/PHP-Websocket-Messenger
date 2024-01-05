# PHP-Websocket-Messenger  
Reference :  
https://developer.mozilla.org/en-US/docs/Web/API/WebSocket  
https://www.php.net/manual/en/function.socket-select.php  
.  
1 - move the messenger folder to the xampp\htdocs  
2 - add extension=php_sockets.dll to xampp\php\php.ini  
3 - run server.php first and then index.php (new tab in other browsers : localhost/messenger/index.php)  
Stop the process : 1 - open windows command prompt (cmd) 2 - netstat -ano | findstr :8080 3 - taskkill /PID /F  
