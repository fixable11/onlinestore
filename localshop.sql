-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 02 2018 г., 11:55
-- Версия сервера: 5.7.14
-- Версия PHP: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `localshop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `symlink` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `symlink`) VALUES
(1, 0, 'Телефоны', 'phones'),
(2, 0, 'Планшеты', 'tablets'),
(3, 1, 'Телефоны Samsung', 'samsung'),
(4, 1, 'Телефоны Apple', 'apple'),
(5, 2, 'Планшеты Apple', 'apple'),
(7, 2, 'Планшеты Samsung ', 'samsung'),
(15, 1, 'Телефоны Meizu', 'meizu');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_payment` datetime DEFAULT NULL,
  `date_modification` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `user_ip` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `date_created`, `date_payment`, `date_modification`, `status`, `comment`, `user_ip`) VALUES
(82, 51, '2018-03-07 16:47:12', NULL, '2018-03-31 19:45:22', 0, 'id пользователя: 51 <br>\n							Имя:  <br>\n							Тел:  <br>\n							Адрес: ', '127.0.0.1'),
(83, 51, '2018-03-07 16:47:25', NULL, '2018-03-07 16:47:25', 0, 'id пользователя: 51 <br>\r\n							Имя:  <br>\r\n							Тел:  <br>\r\n							Адрес: ', '127.0.0.1'),
(84, 51, '2018-03-07 16:48:15', NULL, '2018-03-07 16:48:15', 0, 'id пользователя: 51 <br>\r\n							Имя:  <br>\r\n							Тел:  <br>\r\n							Адрес: ', '127.0.0.1'),
(85, 51, '2018-03-07 16:51:30', NULL, '2018-03-07 16:51:30', 0, 'id пользователя: 51 <br>\r\n							Имя:  <br>\r\n							Тел:  <br>\r\n							Адрес: ', '127.0.0.1'),
(86, 51, '2018-03-07 16:54:50', NULL, '2018-03-07 16:54:50', 0, 'id пользователя: 51 <br>\r\n							Имя:  <br>\r\n							Тел:  <br>\r\n							Адрес: ', '127.0.0.1'),
(87, 51, '2018-03-07 16:55:02', NULL, '2018-03-07 16:55:02', 0, 'id пользователя: 51 <br>\r\n							Имя:  <br>\r\n							Тел:  <br>\r\n							Адрес: ', '127.0.0.1'),
(88, 51, '2018-03-07 16:57:08', NULL, '2018-03-07 16:57:08', 0, 'id пользователя: 51 <br>\r\n							Имя:  <br>\r\n							Тел:  <br>\r\n							Адрес: ', '127.0.0.1'),
(89, 51, '2018-03-07 16:57:20', NULL, '2018-03-07 16:57:20', 0, 'id пользователя: 51 <br>\r\n							Имя:  <br>\r\n							Тел:  <br>\r\n							Адрес: ', '127.0.0.1'),
(90, 51, '2018-03-07 16:58:08', NULL, '2018-03-07 16:58:08', 0, 'id пользователя: 51 <br>\r\n							Имя:  <br>\r\n							Тел:  <br>\r\n							Адрес: ', '127.0.0.1'),
(91, 51, '2018-03-07 16:59:22', NULL, '2018-03-07 16:59:22', 0, 'id пользователя: 51 <br>\r\n							Имя:  <br>\r\n							Тел:  <br>\r\n							Адрес: ', '127.0.0.1'),
(92, 51, '2018-03-07 17:00:25', NULL, '2018-03-07 17:00:25', 0, 'id пользователя: 51 <br>\r\n							Имя:  <br>\r\n							Тел:  <br>\r\n							Адрес: ', '127.0.0.1'),
(93, 51, '2018-03-07 17:01:07', NULL, '2018-03-07 17:01:07', 0, 'id пользователя: 51 <br>\r\n							Имя:  <br>\r\n							Тел:  <br>\r\n							Адрес: ', '127.0.0.1'),
(94, 51, '2018-03-07 17:01:17', NULL, '2018-03-07 17:01:17', 0, 'id пользователя: 51 <br>\r\n							Имя:  <br>\r\n							Тел:  <br>\r\n							Адрес: ', '127.0.0.1'),
(95, 51, '2018-03-07 17:01:18', NULL, '2018-03-07 17:01:18', 0, 'id пользователя: 51 <br>\r\n							Имя:  <br>\r\n							Тел:  <br>\r\n							Адрес: ', '127.0.0.1'),
(96, 51, '2018-03-07 17:01:26', NULL, '2018-03-07 17:01:26', 0, 'id пользователя: 51 <br>\r\n							Имя:  <br>\r\n							Тел:  <br>\r\n							Адрес: ', '127.0.0.1'),
(97, 51, '2018-03-07 17:01:33', NULL, '2018-03-07 17:01:33', 0, 'id пользователя: 51 <br>\r\n							Имя:  <br>\r\n							Тел:  <br>\r\n							Адрес: ', '127.0.0.1'),
(98, 51, '2018-03-07 17:01:42', NULL, '2018-03-07 17:01:42', 0, 'id пользователя: 51 <br>\r\n							Имя:  <br>\r\n							Тел:  <br>\r\n							Адрес: ', '127.0.0.1'),
(99, 51, '2018-03-07 17:03:48', NULL, '2018-03-07 17:03:48', 0, 'id пользователя: 51 <br>\r\n							Имя:  <br>\r\n							Тел:  <br>\r\n							Адрес: ', '127.0.0.1'),
(100, 51, '2018-03-07 17:04:02', NULL, '2018-03-07 17:04:02', 0, 'id пользователя: 51 <br>\r\n							Имя:  <br>\r\n							Тел:  <br>\r\n							Адрес: ', '127.0.0.1'),
(101, 51, '2018-03-07 17:04:23', NULL, '2018-03-07 17:04:23', 0, 'id пользователя: 51 <br>\r\n							Имя:  <br>\r\n							Тел:  <br>\r\n							Адрес: ', '127.0.0.1'),
(102, 51, '2018-03-07 17:04:35', NULL, '2018-03-07 17:04:35', 0, 'id пользователя: 51 <br>\r\n							Имя:  <br>\r\n							Тел:  <br>\r\n							Адрес: ', '127.0.0.1'),
(103, 51, '2018-03-07 17:04:36', NULL, '2018-03-07 17:04:36', 0, 'id пользователя: 51 <br>\r\n							Имя:  <br>\r\n							Тел:  <br>\r\n							Адрес: ', '127.0.0.1'),
(104, 51, '2018-03-07 17:05:54', NULL, '2018-03-07 17:05:54', 0, 'id пользователя: 51 <br>\r\n							Имя:  <br>\r\n							Тел:  <br>\r\n							Адрес: ', '127.0.0.1'),
(105, 51, '2018-03-07 17:06:27', NULL, '2018-03-07 17:06:27', 0, 'id пользователя: 51 <br>\r\n							Имя:  <br>\r\n							Тел:  <br>\r\n							Адрес: ', '127.0.0.1'),
(106, 51, '2018-03-07 17:06:28', NULL, '2018-03-07 17:06:28', 0, 'id пользователя: 51 <br>\r\n							Имя:  <br>\r\n							Тел:  <br>\r\n							Адрес: ', '127.0.0.1'),
(107, 51, '2018-03-07 17:08:01', NULL, '2018-03-07 17:08:01', 0, 'id пользователя: 51 <br>\r\n							Имя:  <br>\r\n							Тел:  <br>\r\n							Адрес: ', '127.0.0.1'),
(108, 51, '2018-03-07 17:14:43', NULL, '2018-03-07 17:14:43', 0, 'id пользователя: 51 <br>\r\n							Имя:  <br>\r\n							Тел:  <br>\r\n							Адрес: ', '127.0.0.1'),
(109, 51, '2018-03-07 17:17:44', NULL, '2018-03-07 17:17:44', 0, 'id пользователя: 51 <br>\r\n							Имя:  <br>\r\n							Тел:  <br>\r\n							Адрес: ', '127.0.0.1'),
(110, 51, '2018-03-07 17:18:15', NULL, '2018-03-07 17:18:15', 0, 'id пользователя: 51 <br>\r\n							Имя: Admin <br>\r\n							Тел: 12356 <br>\r\n							Адрес: ', '127.0.0.1'),
(111, 5, '2018-03-30 22:12:32', NULL, '2018-04-01 12:45:25', 0, 'id пользователя: 5 <br>\r\n							ФИО: admin admin <br>\r\n							Тел: +333-333-33 <br>\r\n							Адрес: address', '127.0.0.1'),
(112, 5, '2018-03-30 22:13:33', NULL, '2018-04-01 12:45:22', 1, 'id пользователя: 5 <br>\r\n							ФИО: admin admin <br>\r\n							Тел: +333-333-33 <br>\r\n							Адрес: address', '127.0.0.1'),
(113, 5, '2018-03-30 22:14:33', NULL, '2018-03-31 19:54:05', 1, 'id пользователя: 5 <br>\r\n							ФИО: admin admin <br>\r\n							Тел: +333-333-33 <br>\r\n							Адрес: address', '127.0.0.1'),
(114, 5, '2018-03-30 22:17:23', '2018-03-07 00:02:01', '2018-04-01 11:35:01', 1, 'id пользователя: 5 <br>\r\n							ФИО: admin admin <br>\r\n							Тел: +333-333-33 <br>\r\n							Адрес: address', '127.0.0.1'),
(115, 5, '2018-03-30 22:18:07', '2018-03-07 00:00:00', '2018-03-31 20:04:41', 1, 'id пользователя: 5 <br>\r\n							ФИО: admin admin <br>\r\n							Тел: +333-333-33 <br>\r\n							Адрес: address', '127.0.0.1'),
(116, 5, '2018-03-30 22:18:26', '2018-03-07 00:00:00', '2018-03-31 20:04:27', 1, 'id пользователя: 5 <br>\r\n							ФИО: admin admin <br>\r\n							Тел: +333-333-33 <br>\r\n							Адрес: address', '127.0.0.1'),
(117, 5, '2018-04-10 13:17:23', NULL, '2018-04-10 13:17:23', 0, 'id пользователя: 5 <br>\r\n		ФИО: admin admin <br>\r\n		Телефон: +333-333-33 <br>\r\n		Адрес: address', '127.0.0.1'),
(118, 5, '2018-04-10 13:34:54', NULL, '2018-04-14 09:58:57', 0, 'id пользователя: 5 <br>\r\n		ФИО: admin admin <br>\r\n		Телефон: +333-333-33 <br>\r\n		Адрес: address', '127.0.0.1');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `type` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `image`, `status`, `type`) VALUES
(1, 3, 'GT-C3560', '																																				<p>Закругленные углы и окантовка  вносят стильный штрих в минималистичный дизайн телефона. Металлическая отделка смотрится  элегантно и современно. А благодаря небольшим размерам С3560 удобно лежи�� в руке и ��егко помещается в кармане.</p>\n<br />\n\n<p>Спецификации:</p>\n<ul><li>Стандарты сети GSM и EDGE : GSM (850/900/1800/1900)</li><li>Стандарт сети 3G : N/A</li><li>Стандарт сети CDMA : N/A</li><li>TD-SCDMA Band : N/A</li></ul>\n                    																																								', 3000, '1.jpg', 1, 'телефон'),
(2, 3, 'S5570 Galaxy mini', 'Платформа\n850/900/1800/1900 МГц\nДиапазон 900/2100 МГц\nAndroid 2.2 OS\nИнтернет браузер (Android Browser)\nФизические характеристики\nВес трубки 106,6 г.\nРазмеры трубки: 110,4 x 60,6 x 12,1 мм', 7000, '2.jpg', 1, 'телефон'),
(3, 3, 'GT-E2600', '<p>Тонкий и изящный дизайн телефона E2600? широкий экран и пользовательский интерфейс Paragon UX обеспечивают удобство и комфорт в использовании.  Телефон оснащен интуитивно-понятным пользовательским интерфейсом.  </p>\n<br />\n<p>Спецификации:</p>\n<ul><li>850 / 900 / 1800 / 1900 МГц GSM &amp; EDGE Band</li><li>GPRS Network&amp;Data: 850 / 900 / 1800 / 1900</li><li>EDGE Network&amp;Data: 850 / 900 / 1800 / 1900</li><li>фирменная</li><li>Интернет браузерr ( NetFront 4.2)</li><li>JAVA™ SUN CLDC HotSpot Implementation 1.1 (MIDP 2.0) Platform</li><li>SAR 0,45 Вт./кг.</li></ul>\n\n<a href="http://www.samsung.com/ru/consumer/mobile-devices/mobile-phones/hhp-gsm/GT-E2600ZKASER">http://www.samsung.com/ru/consumer/mobile-devices/mobile-phones/hhp-gsm/GT-E2600ZKASER</a>', 5000, '3.jpg', 1, 'телефон'),
(4, 3, 'E2530 La Fleur', '                        <ul><li>850/900/1800/1900 МГц</li><li>GPRS класс 12</li><li>EDGE Class12(только RX)</li><li>Proprietary (MMP) OS</li><li>Интернет браузер</li><li>MIDP 2,1 / CLDC 1.1</li></ul>\n\n<ul><li>Вес трубки 86 г.</li><li>Размеры трубки: 94.4 x 47.2 x 17.4 мм</li></ul>\n\n<ul><li>Стандартная батарея: до 800 мАч</li><li>До 680 мин. в режиме разговора</li></ul>\n\n<a href="http://www.samsung.com/ru/consumer/mobile-devices/mobile-phones/hhp-gsm/GT-E2530SRFSER">\nhttp://www.samsung.com/ru/consumer/mobile-devices/mobile-phones/hhp-gsm/GT-E2530SRFSER</a>\n                    ', 6000, '4.jpg', 1, 'телефон'),
(5, 3, 'S3350 Chat 335', '<p>Samsung Ch@t 335 — самый тонкий QWERTY-телефон на современном рынке, чья толщина составляет всего 11,9&nbsp;мм. Обтекаемый корпус с хромированным покрытием придает модели изысканный классический вид. 2,4-дюймовый LQVGA дисплей идеально подходит для просмотра снимков и чтения длинных сообщений.</p>\n<br />\n<p>Благодаря новой, улучшенной QWERTY-клавиатуре набор текста становится еще более быстрым и удобным, как при печати на ПК. Есть возможность настраивать горячие клавиши для часто используемых приложений (например, A для будильника и т.п.).</p>\n\n<a href="http://www.samsung.com/ru/consumer/mobile-devices/mobile-phones/hhp-gsm/GT-S3350HKASER">http://www.samsung.com/ru/consumer/mobile-devices/mobile-phones/hhp-gsm/GT-S3350HKASER</a>', 10000, '5.jpg', 1, 'телефон'),
(6, 3, 'S5380 La Fleur Wave Y', 'Стандарты сети 850/900/1800/1900MHz GSM&EDGE Band\nСтандарты сети: 900/2100МГц 3G\nПоддерживаемые 3G: GPRS Network&Data :850/900/1800/1900 (Slave)\nEDGE Network&Data: стандарты сетей: 850/900/1800/1900 (Master)\nNetwork&Data (3G): HSDPA 7,2Мбит/с.\nBada 2.0\nБраузер Dolfin Browser 3.0\nПлатформа SUN CLDC 1.1\nЗначение SAR: 0,797мВт./г.\n', 12000, '6.jpg', 1, 'телефон'),
(7, 3, 'I9001 Galaxy S Plus', 'Платформа\n850 / 900 / 1800 / 1900 МГц\nGPRS Class12\nEDGE Class12\nИнтернет браузер (Android Browser)\nДисплей\nРазрешение дисплея 480 x 800 WVGA\n<br />\n<br />\n<a href="http://www.samsung.com/ru/consumer/mobile-devices/mobile-phones/hhp-smart/GT-I9001HKDSER">http://www.samsung.com/ru/consumer/mobile-devices/mobile-phones/hhp-smart/GT-I9001HKDSER</a>', 11000, '7.png', 1, 'телефон'),
(8, 3, 'I8350 Omnia W', 'Windows Phone 7.5 Mango\nGSM&EDGE 850 / 900 / 1,800 / 1,900 МГц\n3G 900 / 2,100 MГц\nGPRS: Класс 12\nEDGE: Класс 12\nHSDPA 14.4 / HSUPA 5.76 Мбит/с\nInternet Explorer 9\n', 15000, '8.png', 1, 'телефон'),
(11, 4, 'iPhone 3GS', 'Широкоформатный дисплей Multi-Touch с диагональю 3,5 дюйма\nРазрешение 480 x 320 пикселей (163 пикселя/дюйм)\nОлеофобное покрытие, препятствующее появлению отпечатков пальцев\nПоддержка одновременного отображения нескольких языков и наборов символов\n<br /><br />\n<a href="http://www.apple.com/ru/iphone/iphone-3gs/specs.html">http://www.apple.com/ru/iphone/iphone-3gs/specs.html</a>', 20000, '11.png', 1, 'телефон'),
(12, 4, 'iPhone 4S', '																		                                                Поддержка международных сетей\nUMTS/HSDPA/HSUPA (850, 900, 1900, 2100 МГц); \nGSM/EDGE (850, 900, 1800, 1900 МГц)\nCDMA EV-DO Rev. A (800, 1900 МГц)3\n802.11b/g/n Wi-Fi (802.11n только 2,4 ГГц)\nБеспроводная технология Bluetooth 4.0\n<br /><br />\n<a href="http://www.apple.com/ru/iphone/specs.html">http://www.apple.com/ru/iphone/specs.html</a>\n                    \n                    																', 25000, '12.png', 1, 'телефон'),
(26, 4, 'iPhone X', '																																																', 35000, '26.png', 1, NULL),
(27, 15, 'Meizu M5s', 'lorem', 3000, '27.jpg', 1, NULL),
(28, 15, 'Meizu M5 Note', '', 3200, '28.jpg', 1, NULL),
(29, 15, 'Meizu M6', '', 3150, '29.jpg', 1, NULL),
(30, 15, 'Meizu Pro 7', '																	', 9500, '30.jpg', 1, NULL),
(31, 5, 'Apple iPad A1822', '', 10000, '31.jpg', 1, 'планшет'),
(32, 5, 'Apple iPad Pro 10.5', '																	', 40000, '32.jpg', 1, 'планшет'),
(33, 5, 'Apple iPad A1823', '																	', 15000, '33.jpg', 1, NULL),
(34, 5, 'Apple A1538 iPad mini 4', '', 13200, '34.jpg', 1, NULL),
(35, 5, 'Apple iPad Pro 9.7', '', 12500, '35.jpg', 1, NULL),
(36, 7, 'Samsung Galaxy Tab A 8.0', '																	', 7000, '36.jpg', 1, NULL),
(37, 7, 'Samsung Galaxy Tab A 10.1', '																																		', 9000, '37.jpg', 1, NULL),
(38, 7, 'Samsung Galaxy Tab A 7.0', '																	', 5000, '38.jpg', 1, NULL),
(39, 7, 'Samsung Galaxy Tab S2 9.7', '																	', 11500, '39.jpg', 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `purchase`
--

INSERT INTO `purchase` (`id`, `order_id`, `product_id`, `price`, `amount`) VALUES
(5, 110, 1, 3000, 1),
(6, 110, 3, 5000, 1),
(7, 110, 11, 20000, 1),
(8, 111, 1, 3000, 3),
(9, 111, 2, 7000, 4),
(10, 112, 1, 3000, 1),
(11, 112, 2, 7000, 1),
(12, 113, 1, 3000, 1),
(13, 113, 2, 7000, 1),
(14, 114, 1, 3000, 1),
(15, 115, 1, 3000, 1),
(16, 116, 1, 3000, 1),
(17, 116, 2, 7000, 1),
(18, 117, 1, 3000, 1),
(19, 118, 1, 3000, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pwd` varchar(200) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `pwd`, `name`, `phone`, `address`) VALUES
(5, 'admin@admin.ru', '$5$rounds=5000$salt$B6Hq87Z/CNEsCJTW4JselQQtV3ky1cVjGrbsODpBh.6', 'admin admin', '+333-333-33', 'address');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`) USING BTREE;

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT для таблицы `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
