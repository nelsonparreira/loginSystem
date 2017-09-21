Based on the UDEMY course:
https://www.udemy.com/login-and-registration-system-in-php-and-mysql-step-by-step/learn/v4/overview



## Database
	
	DB name: registration 

	host: localhost
	user: root
	pass: root 

table: users

	- id  int(11) NOT NULL PRIMARY AI
	- firstName varchar 15 NOT NULL
	- lastName varchar 15 NOT NULL
	- email varchar 50 NOT NULL
	- password varchar 255 NOT NULL
	- image  test NOT NULL

	. SQL code:
	```
		CREATE TABLE `registration`.`users` ( 
			`id` INT(11) NOT NULL AUTO_INCREMENT , 
			`firstName` VARCHAR(15) NOT NULL , 
			`lastName` VARCHAR(15) NOT NULL , 
			`email` VARCHAR(50) NOT NULL , 
			`password` VARCHAR(255) NOT NULL , 
			`image` TEXT NOT NULL , 
			`created` TEXT NOT NULL ,
			PRIMARY KEY (`id`)) ENGINE = InnoDB;

	```
