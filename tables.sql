--
-- Структура таблицы `cars`
--

DROP TABLE IF EXISTS `rest_cars`;
CREATE TABLE IF NOT EXISTS `rest_cars` (
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
-- Очистить таблицу перед добавлением данных `cars`
--

TRUNCATE TABLE `rest_cars`;
--
-- Дамп данных таблицы `cars`
--

INSERT INTO `rest_cars` (`idCar`, `idMark`, `Model`, `Year`, `EngineVolume`, `Color`, `TopSpeed`, `Price`) VALUES
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

DROP TABLE IF EXISTS `rest_marks`;
CREATE TABLE IF NOT EXISTS `rest_marks` (
  `idMark` int(6) unsigned NOT NULL,
  `Name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `marks`
--

TRUNCATE TABLE `rest_marks`;
--
-- Дамп данных таблицы `marks`
--

INSERT INTO `rest_marks` (`idMark`, `Name`) VALUES
(3, 'Audi'),
(1, 'BMW'),
(2, 'Mercedes');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

DROP TABLE IF EXISTS `rest_orders`;
CREATE TABLE IF NOT EXISTS `rest_orders` (
  `idOrder` int(6) unsigned NOT NULL,
  `idUser` int(6) unsigned DEFAULT NULL,
  `idCar` int(6) unsigned NOT NULL,
  `PayMethod` enum('credit cart','cash') NOT NULL,
  `Submitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `orders`
--

TRUNCATE TABLE `rest_orders`;
-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `rest_users`;
CREATE TABLE IF NOT EXISTS `rest_users` (
  `idUser` int(6) unsigned NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Surname` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `SessionId` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Очистить таблицу перед добавлением данных `users`
--

TRUNCATE TABLE `rest_users`;
--
-- Дамп данных таблицы `users`
--

INSERT INTO `rest_users` (`idUser`, `Email`, `Name`, `Surname`, `Password`, `SessionId`) VALUES
(1, 'qwe', 'asd', 'zxc', '*A4B6157319038724E3560894F7F932C8886EBFCF', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cars`
--
ALTER TABLE `rest_cars`
  ADD PRIMARY KEY (`idCar`),
  ADD KEY `idMark` (`idMark`);

--
-- Индексы таблицы `marks`
--
ALTER TABLE `rest_marks`
  ADD PRIMARY KEY (`idMark`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `rest_orders`
  ADD PRIMARY KEY (`idOrder`),
  ADD KEY `idCar` (`idCar`),
  ADD KEY `idUser` (`idUser`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `rest_users`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cars`
--
ALTER TABLE `rest_cars`
  MODIFY `idCar` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `marks`
--
ALTER TABLE `rest_marks`
  MODIFY `idMark` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `rest_orders`
  MODIFY `idOrder` int(6) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `rest_users`
  MODIFY `idUser` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cars`
--
ALTER TABLE `rest_cars`
  ADD CONSTRAINT `cars_ibfk_5` FOREIGN KEY (`idMark`) REFERENCES `rest_marks` (`idMark`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `rest_orders`
  ADD CONSTRAINT `orders_ibfk_5` FOREIGN KEY (`idCar`) REFERENCES `rest_cars` (`idCar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_6` FOREIGN KEY (`idUser`) REFERENCES `rest_users` (`idUser`) ON DELETE SET NULL ON UPDATE CASCADE;
