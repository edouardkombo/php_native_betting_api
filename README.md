# PHP Native Betting Api

A simple RESTful API (to start with), in PHP, without Framework and libraries. This has been made really quickly as a personal challenge first, and is meant to be improved.

NO LIBRARY IS BEING USED, ONLY DOTENV FOR PHP GLOBAL VARIABLES !!!

There is a strong use of OOP, including my own design pattern, VDD (Vocabulary Driven Database) to make a more powerful use of OOP.
Want to learn more about VDD, have some readings here: https://edouard-kombo.medium.com/vdd-the-database-design-pattern-for-scalable-and-human-readable-schemas-16ec396d7ca0

Those who know me, know that if I had the choice to use a framework, I would have had gone without hesitation for Api-platform. Have a look at my latest wonderful api achieved with this state of the art framework https://edouard-kombo.medium.com/build-a-calendar-api-from-scratch-in-60-minutes-1961f5ac22df

## Installation

1. cd /var/www && git clone 
2. cd /var/www/php_native_betting_api/api/ && composer install
2. cd /var/www/php_native_betting_api/api/database
3. Create your Mysql database

ubuntu:/var/www/php_native_betting_api/api/database$ mysql -u ? -p

mysql> CREATE DATABASE api;

mysql> exit;

ubuntu:/var/www/php_native_betting_api/api/database$ mysql -u ? -p api < api.sql

4. Insert dummy data

mysql> use api;

mysql> INSERT INTO credential (username,password) VALUES ("sledge00","81dc9bdb52d04dc20036dbd8313ed055");

mysql> INSERT INTO wallet (balance) VALUES (300);

mysql> INSERT INTO currency (name,code) VALUES ("Euro","EUR");

mysql> INSERT INTO finance_type (name) VALUES ("Deposit"),("Withdrawal"),("Bet");

mysql> INSERT INTO player (wallet_id,credential_id,currency_id) VALUES (1,1,1);

mysql> UPDATE wallet SET player_id=1 WHERE id=1;

mysql> UPDATE credential SET player_id=1 WHERE id=1;

## How does it work

Only POST method is supported for now, and only JSON response.
To use it, better to play with POSTMAN.


- `Database` Not all databases are being used right now, but I did create a sample architecture of what I considere to be the go-to template for a mysql schema. This schema has been built using my VDD design pattern, and it also helps us to be micro-services ready, in case of need.

![GET method](https://raw.githubusercontent.com/edouardkombo/php_native_betting_api/master/api/database/api.png)


1. Once you setup your server, point it to "api/index.php".
2. We listen to two routes "login" and "api"
3. To login, POST (username:sledge00, password:1234)
4. To bet. POST (amount:xxxx, finance_type:3), 3 here stands for bets

In case of successful request, a 200 status code with matching body will be sent as JSON.
In case of unsuccessful request, a 400 status code without body will be sent as JSON.

Better explanation is available on my medium account here https://edouard-kombo.medium.com/build-a-simple-betting-api-in-native-php-032e098c9c7d


## Why should you use APIs?

APIs are a great way to separate the back-end from the front-end of your application,  this also makes it possible to develop for different kinds of platforms without change your back-end application and without rewrite your code in differents programming languages. For example: You can have a web application that access an API and develop a mobile application that will access the same API using the same routes. Isn't it awesome?

## Credits

- [Edouard Kombo](https://github.com/edouardkombo)

