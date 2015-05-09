--
-- Структура таблицы `cars`
--

DROP TABLE IF EXISTS `cars`;
CREATE TABLE IF NOT EXISTS `cars` (
  `idCar` int(6) unsigned NOT NULL,
  `idMark` int(6) unsigned NOT NULL,
  `Model` varchar(50) NOT NULL,
  `Year` year(4) NOT NULL,
  `EngineVolume` decimal(3,1) unsigned NOT NULL COMMENT 'Liters',
  `Color` varchar(8) NOT NULL,
  `TopSpeed` int(3) unsigned NOT NULL COMMENT 'km/h',
  `Price` int(6) unsigned NOT NULL COMMENT '$'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cars`
--

INSERT INTO `cars` (`idCar`, `idMark`, `Model`, `Year`, `EngineVolume`, `Color`, `TopSpeed`, `Price`) VALUES
(1, 1, 'X5', 2014, '3.2', '#000000', 200, 53000),
(2, 1, 'X6', 2013, '4.5', '#A3A3A3', 220, 76000),
(3, 2, 'S600', 2014, '6.0', '#000000', 320, 120000),
(4, 2, 'GL550', 2014, '5.5', '#000000', 320, 135000),
(5, 3, 'A8L', 2014, '5.8', '#000000', 320, 98000),
(6, 3, 'Q7', 2014, '5.0', '#ffffff', 280, 103000);

-- --------------------------------------------------------

--
-- Структура таблицы `marks`
--

DROP TABLE IF EXISTS `marks`;
CREATE TABLE IF NOT EXISTS `marks` (
  `idMark` int(6) unsigned NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `marks`
--

INSERT INTO `marks` (`idMark`, `Name`) VALUES
(3, 'Audi'),
(1, 'BMW'),
(2, 'Mercedes');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `idCar` int(6) unsigned NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `UserSurname` varchar(50) NOT NULL,
  `PayMethod` enum('credit cart','cash') NOT NULL,
  `Submitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`idCar`),
  ADD KEY `idMark` (`idMark`);

--
-- Индексы таблицы `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`idMark`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD KEY `idCar` (`idCar`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cars`
--
ALTER TABLE `cars`
  MODIFY `idCar` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `marks`
--
ALTER TABLE `marks`
  MODIFY `idMark` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`idMark`) REFERENCES `marks` (`idMark`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`idCar`) REFERENCES `cars` (`idCar`) ON DELETE CASCADE ON UPDATE CASCADE;