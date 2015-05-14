DELIMITER $$
--
-- Процедуры
--
DROP PROCEDURE IF EXISTS `rest_addOrder`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `rest_addOrder`(IN `idCar` INT(6) UNSIGNED, IN `UserName` VARCHAR(50) CHARSET utf8, IN `UserSurname` VARCHAR(50) CHARSET utf8, IN `PayMethod` SET('credit cart','cash'))
    MODIFIES SQL DATA
    COMMENT '@idCar @UserName @UserSurname @PayMethod'
BEGIN
	INSERT INTO rest_orders (rest_orders.idCar, rest_orders.UserName, rest_orders.UserSurname, rest_orders.PayMethod)
    VALUES (idCar, UserName, UserSurname, PayMethod);
    
    SELECT ROW_COUNT() AS result;
END$$

DROP PROCEDURE IF EXISTS `rest_addUser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `rest_addUser`(IN `Email` VARCHAR(255) CHARSET utf8, IN `Name` VARCHAR(50) CHARSET utf8, IN `Surname` VARCHAR(50) CHARSET utf8, IN `Passw` VARCHAR(50) CHARSET utf8)
    MODIFIES SQL DATA
BEGIN
	INSERT INTO rest_users (rest_users.Email, rest_users.Name, rest_users.Surname, rest_users.Password)
    VALUES (Email, Name, Surname, PASSWORD(Passw));
    
    SELECT LAST_INSERT_ID() AS newId;
END$$

DROP PROCEDURE IF EXISTS `rest_getCarByFilter`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `rest_getCarByFilter`(IN `model` VARCHAR(50) CHARSET utf8, IN `year` YEAR(4), IN `engineVolume` INT(5) UNSIGNED, IN `color` VARCHAR(8) CHARSET utf8, IN `topSpeed` INT(3) UNSIGNED, IN `price` INT(6) UNSIGNED)
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `rest_getCarDetails`(IN `idCar` INT(6) UNSIGNED)
    READS SQL DATA
    COMMENT '@idCar'
BEGIN
	SELECT cars.Model, cars.Year, cars.EngineVolume, cars.Color, cars.TopSpeed, cars.Price
    FROM rest_cars AS cars
    WHERE cars.idCar = idCar;
END$$

DROP PROCEDURE IF EXISTS `rest_getCarList`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `rest_getCarList`()
    READS SQL DATA
BEGIN
	SELECT cars.idCar, marks.Name AS Mark, cars.Model
    FROM rest_cars AS cars
    JOIN rest_marks AS marks
    	ON cars.idMark = marks.idMark;
END$$

DROP PROCEDURE IF EXISTS `rest_getUserByEmail`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `rest_getUserByEmail`(IN `Email` VARCHAR(255) CHARSET utf8)
    READS SQL DATA
BEGIN
	SELECT users.idUser
    FROM rest_users AS users
    WHERE users.Email = Email;
END$$

DROP PROCEDURE IF EXISTS `rest_getUserByEmailPassw`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `rest_getUserByEmailPassw`(IN `Email` VARCHAR(255) CHARSET utf8, IN `Passw` VARCHAR(50) CHARSET utf8)
    READS SQL DATA
BEGIN
	SELECT users.idUser
    FROM rest_users AS users
    WHERE users.Email = Email AND 
    	users.Password = PASSWORD(Passw);
END$$

DROP PROCEDURE IF EXISTS `rest_getUserBySession`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `rest_getUserBySession`(IN `idUser` INT(6) UNSIGNED, IN `SessionId` VARCHAR(50) CHARSET utf8)
    READS SQL DATA
BEGIN
	SELECT users.idUser, users.Name, users.Surname, users.SessionId
    FROM rest_users AS users
    WHERE users.idUser = idUser 
    	AND users.SessionId = SessionId;
END$$

DROP PROCEDURE IF EXISTS `rest_sessionDestroy`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `rest_sessionDestroy`(IN `idUser` INT(6) UNSIGNED)
    MODIFIES SQL DATA
BEGIN
	UPDATE rest_users
    SET rest_users.SessionId = NULL
    WHERE rest_users.idUser = idUser;
    
    SELECT ROW_COUNT() AS result;
END$$

DROP PROCEDURE IF EXISTS `rest_sessionStart`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `rest_sessionStart`(IN `idUser` INT(6) UNSIGNED, IN `SessionId` VARCHAR(50) CHARSET utf8)
    MODIFIES SQL DATA
BEGIN
	UPDATE rest_users 
    SET rest_users.SessionId = SessionId
    WHERE rest_users.idUser = idUser;
    
    SELECT ROW_COUNT() as result;
END$$

DELIMITER ;

-- --------------------------------------------------------