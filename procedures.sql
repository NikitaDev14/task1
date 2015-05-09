SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+02:00";

DELIMITER $$
--
-- Процедуры
--
DROP PROCEDURE IF EXISTS `addOrder`$$
CREATE PROCEDURE `addOrder`(IN `idCar` INT(6) UNSIGNED, IN `UserName` VARCHAR(50) CHARSET utf8, IN `UserSurname` VARCHAR(50) CHARSET utf8, IN `PayMethod` SET('credit cart','cash'))
    MODIFIES SQL DATA
    COMMENT '@idCar @UserName @UserSurname @PayMethod'
BEGIN
	INSERT INTO orders (orders.idCar, orders.UserName, orders.UserSurname, orders.PayMethod)
    VALUES (idCar, UserName, UserSurname, PayMethod);

    SELECT ROW_COUNT() AS result;
END$$

DROP PROCEDURE IF EXISTS `getCarByParams`$$
CREATE PROCEDURE `getCarByParams`(IN `model` VARCHAR(50) CHARSET utf8, IN `year` YEAR(4), IN `engineVolume` DECIMAL(3,1) UNSIGNED, IN `color` VARCHAR(8) CHARSET utf8, IN `topSpeed` INT(3) UNSIGNED, IN `price` INT(6) UNSIGNED)
    READS SQL DATA
BEGIN
	SELECT cars.idCar, marks.Name AS Mark, cars.Model
    FROM cars
    JOIN marks
    	ON cars.idMark = marks.idMark
    WHERE cars.Model LIKE IF(model = '', '%', model)
    	AND cars.Year LIKE IF(year = 0, '%', year)
        AND cars.EngineVolume LIKE IF(engineVolume = 0.0, '%', engineVolume)
        AND cars.Color LIKE IF(color = '', '%', color)
        AND cars.TopSpeed LIKE IF(topSpeed = 0, '%', topSpeed)
        AND cars.Price LIKE IF(price = 0, '%', price);
END$$

DROP PROCEDURE IF EXISTS `getCarDetails`$$
CREATE PROCEDURE `getCarDetails`(IN `idCar` INT(6) UNSIGNED)
    READS SQL DATA
    COMMENT '@idCar'
BEGIN
	SELECT cars.Model, cars.Year, cars.EngineVolume, cars.Color, cars.TopSpeed, cars.Price
    FROM cars
    WHERE cars.idCar = idCar;
END$$

DROP PROCEDURE IF EXISTS `getCarList`$$
CREATE PROCEDURE `getCarList`()
    READS SQL DATA
BEGIN
	SELECT cars.idCar, marks.Name AS Mark, cars.Model
    FROM cars
    JOIN marks
    	ON cars.idMark = marks.idMark;
END$$

DELIMITER ;

-- --------------------------------------------------------