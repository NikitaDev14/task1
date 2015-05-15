SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `car_shop`
--
USE `user10`;

DELIMITER $$
--
-- Процедуры
--
DROP PROCEDURE IF EXISTS `rest_addOrder`$$
CREATE PROCEDURE `rest_addOrder`(IN `idUser` INT(6) UNSIGNED, IN `idCar` INT(6) UNSIGNED, IN `PayMethod` ENUM('cash','credit cart','bank transfer') CHARSET utf8)
    MODIFIES SQL DATA
    COMMENT '@idUser @idCar @PayMethod'
BEGIN
	INSERT INTO rest_orders (rest_orders.idUser, rest_orders.idCar, rest_orders.PayMethod)
    VALUES (idUser, idCar, PayMethod);
    
    SELECT LAST_INSERT_ID() AS newId;
END$$

DROP PROCEDURE IF EXISTS `rest_addUser`$$
CREATE PROCEDURE `rest_addUser`(IN `Name` VARCHAR(50) CHARSET utf8, IN `Surname` VARCHAR(50) CHARSET utf8, IN `Email` VARCHAR(255) CHARSET utf8, IN `Passw` VARCHAR(50) CHARSET utf8)
    MODIFIES SQL DATA
BEGIN
	INSERT INTO rest_users (rest_users.Name, rest_users.Surname, rest_users.Email, rest_users.Password)
    VALUES (Name, Surname, Email, PASSWORD(Passw));
    
    SELECT LAST_INSERT_ID() AS newId;
END$$

DROP PROCEDURE IF EXISTS `rest_getCarByFilter`$$
CREATE PROCEDURE `rest_getCarByFilter`(IN `model` VARCHAR(50) CHARSET utf8, IN `year` YEAR(4), IN `engineVolume` INT(5) UNSIGNED, IN `color` VARCHAR(8) CHARSET utf8, IN `topSpeed` INT(3) UNSIGNED, IN `price` INT(6) UNSIGNED)
    READS SQL DATA
BEGIN
	SELECT cars.idCar, marks.Name AS Mark, cars.Model
    FROM rest_cars AS cars
    JOIN rest_marks AS marks
    	ON cars.idMark = marks.idMark
    WHERE cars.Model LIKE IF(model = '', '%', model)
    	AND cars.Year LIKE IF(year = 0, '%', year)
        AND cars.EngineVolume LIKE IF(engineVolume = 0, '%', engineVolume)
        AND cars.Color LIKE IF(color = '', '%', color)
        AND cars.TopSpeed LIKE IF(topSpeed = 0, '%', topSpeed)
        AND cars.Price LIKE IF(price = 0, '%', price);
END$$

DROP PROCEDURE IF EXISTS `rest_getCarDetails`$$
CREATE PROCEDURE `rest_getCarDetails`(IN `idCar` INT(6) UNSIGNED)
    READS SQL DATA
    COMMENT '@idCar'
BEGIN
	SELECT cars.Model, cars.Year, cars.EngineVolume, cars.Color, cars.TopSpeed, cars.Price
    FROM rest_cars AS cars
    WHERE cars.idCar = idCar;
END$$

DROP PROCEDURE IF EXISTS `rest_getCarList`$$
CREATE PROCEDURE `rest_getCarList`()
    READS SQL DATA
BEGIN
	SELECT cars.idCar, marks.Name AS Mark, cars.Model
    FROM rest_cars AS cars
    JOIN rest_marks AS marks
    	ON cars.idMark = marks.idMark;
END$$

DROP PROCEDURE IF EXISTS `rest_getOrdersByUser`$$
CREATE PROCEDURE `rest_getOrdersByUser`(IN `idUser` INT(6) UNSIGNED)
    READS SQL DATA
BEGIN
    SELECT orders.Submitted, marks.Name AS Mark, cars.Model AS Car, orders.PayMethod
    FROM rest_orders AS orders
    JOIN rest_cars AS cars
    	ON orders.idCar = cars.idCar
    JOIN rest_marks AS marks
        ON cars.idMark = marks.idMark
    WHERE orders.idUser = idUser
    ORDER BY (orders.Submitted) DESC;
END$$

DROP PROCEDURE IF EXISTS `rest_getUserByEmail`$$
CREATE PROCEDURE `rest_getUserByEmail`(IN `Email` VARCHAR(255) CHARSET utf8)
    READS SQL DATA
BEGIN
	SELECT users.idUser
    FROM rest_users AS users
    WHERE users.Email = Email;
END$$

DROP PROCEDURE IF EXISTS `rest_getUserByEmailPassw`$$
CREATE PROCEDURE `rest_getUserByEmailPassw`(IN `Email` VARCHAR(255) CHARSET utf8, IN `Passw` VARCHAR(50) CHARSET utf8)
    READS SQL DATA
BEGIN
	SELECT users.idUser
    FROM rest_users AS users
    WHERE users.Email = Email AND 
    	users.Password = PASSWORD(Passw);
END$$

DROP PROCEDURE IF EXISTS `rest_getUserBySession`$$
CREATE PROCEDURE `rest_getUserBySession`(IN `idUser` INT(6) UNSIGNED, IN `SessionId` VARCHAR(50) CHARSET utf8)
    READS SQL DATA
BEGIN
	SELECT users.idUser, users.Name, users.Surname, users.SessionId
    FROM rest_users AS users
    WHERE users.idUser = idUser 
    	AND users.SessionId = SessionId;
END$$

DROP PROCEDURE IF EXISTS `rest_sessionDestroy`$$
CREATE PROCEDURE `rest_sessionDestroy`(IN `idUser` INT(6) UNSIGNED)
    MODIFIES SQL DATA
BEGIN
	UPDATE rest_users
    SET rest_users.SessionId = NULL
    WHERE rest_users.idUser = idUser;
    
    SELECT ROW_COUNT() AS result;
END$$

DROP PROCEDURE IF EXISTS `rest_sessionStart`$$
CREATE PROCEDURE `rest_sessionStart`(IN `idUser` INT(6) UNSIGNED, IN `SessionId` VARCHAR(50) CHARSET utf8)
    MODIFIES SQL DATA
BEGIN
	UPDATE rest_users 
    SET rest_users.SessionId = SessionId
    WHERE rest_users.idUser = idUser;
    
    SELECT ROW_COUNT() as result;
END$$

DELIMITER ;

-- --------------------------------------------------------
