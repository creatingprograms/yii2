-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Мар 30 2023 г., 09:29
-- Версия сервера: 5.7.41-0ubuntu0.18.04.1
-- Версия PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `admin_crmmm`
--

-- --------------------------------------------------------

--
-- Структура таблицы `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `document`
--

INSERT INTO `document` (`id`, `title`, `link`, `project_id`, `event_id`, `type_id`, `created_at`, `updated_at`) VALUES
(36, 'Вероника_Лобачева-Cargo.pdf', '/home/market14/domains/qartop.com/public_html/crm/uploads/documents/Вероника_Лобачева-Cargo.pdf', 24, 80, NULL, 1674648062, 1674648062),
(37, 'Снимок экрана 2023-01-26 в 10.11.58.png', '/uploads/documents/Снимок экрана 2023-01-26 в 10.11.58.png', 24, 85, 1, 1674655261, 1674702109),
(38, 'Снимок экрана 2023-01-26 в 10.00.38.png', '/home/market14/domains/qartop.com/public_html/crm/uploads/documents/Снимок экрана 2023-01-26 в 10.00.38.png', 27, 83, NULL, 1674702066, 1674702066),
(39, 'test1.docx', '/uploads/documents/test1.docx', 28, 94, 10, 1675432945, 1675440147),
(40, 'Снимок экрана 2023-02-01 в 19.20.48.png', '/home/market14/domains/qartop.com/public_html/crm/uploads/documents/Снимок экрана 2023-02-01 в 19.20.48.png', 28, 94, NULL, 1675580524, 1675580524),
(41, 'Снимок экрана 2023-02-01 в 19.14.15.png', '/uploads/documents/Снимок экрана 2023-02-01 в 19.14.15.png', 29, 95, 10, 1675580542, 1675580540),
(42, 'Загрузите файл', NULL, 32, 97, 1, 1675936935, 1675936935),
(43, 'Загрузите файл', NULL, 26, 98, 1, 1675936941, 1675936941),
(44, 'Загрузите файл', NULL, 33, 100, 1, 1677564146, 1677564146),
(45, '2.jpg', '/uploads/documents/2.jpg', 0, NULL, NULL, 1678806238, 1678806238),
(46, 'Загрузите файл', NULL, 0, 103, 1, 1678806238, 1678806238),
(47, '2023-03-03 20.51.17.jpg', '/uploads/documents/2023-03-03 20.51.17.jpg', 31, 107, 10, 1678921403, 1678925002),
(48, '1A48C02C-F107-4A22-B97C-2B0D15210242.jpeg', '/uploads/documents/591ee758-c0c2-4d26-999b-c3a6bb368679.jpg', 39, NULL, NULL, 1678961033, 1678961033);

-- --------------------------------------------------------

--
-- Структура таблицы `document_type`
--

CREATE TABLE `document_type` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `project_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `manager_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `document_id` int(11) DEFAULT NULL,
  `status` text,
  `type` int(11) DEFAULT NULL,
  `comment` text NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `startdate_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `event`
--

INSERT INTO `event` (`id`, `title`, `description`, `project_id`, `user_id`, `manager_id`, `sub_id`, `document_id`, `status`, `type`, `comment`, `created_at`, `updated_at`, `startdate_at`) VALUES
(82, 'Создание нового договора', '', 26, 72, 0, 69, NULL, '1', 0, '', 1675112400, 1675141269, NULL),
(84, 'Создание нового договора', NULL, 28, NULL, 0, 0, NULL, '4', NULL, '', 1674594000, 1674651666, NULL),
(86, 'Создание нового договора', '', 29, 0, 0, 0, NULL, '2', 1, '', 1674594000, 1674655274, NULL),
(88, 'Создание нового договора', '', 29, 72, 0, 69, NULL, '1', 0, '', 1675112400, 1675162864, NULL),
(89, 'Проверка даты', '1111', 28, 72, 0, 69, NULL, '2', 0, 'дата другая', 1675803600, 1675346565, NULL),
(90, 'Проверка', '2222222', 28, 0, 0, 69, NULL, '1', 0, '', 1676926800, 1676952139, NULL),
(91, 'Создание нового договора', '', 31, 72, 0, 69, NULL, '1', 0, '', 1675198800, 1675252954, NULL),
(92, '', '', 0, 0, 0, 0, NULL, '1', 0, '', 1675285200, 1675342977, NULL),
(93, 'Событие с уведомлением', '', 26, 72, 0, 69, NULL, '2', 1, 'ууууу', 1675371600, 1675429355, NULL),
(94, 'Нужен документ от клиента', '', 28, 72, 0, 69, 40, '3', 1, '', 1675544400, 1675580542, NULL),
(95, 'Нужен документ от клиента о договору 11', '', 29, 72, 0, 69, NULL, '3', 0, 'не загружается файл', 1675544400, 1675580533, NULL),
(96, 'Создание нового договора', NULL, 32, NULL, 0, 0, NULL, '3', NULL, '', 1675890000, 1675926172, NULL),
(97, 'Нужен документ от клиента2', '', 32, 74, 0, 69, NULL, '1', 0, '', 1675890000, 1675940569, NULL),
(98, '', '', 26, 74, 0, 69, NULL, '1', 0, '', 1675976400, 1675936941, NULL),
(99, 'Создание нового договора', NULL, 33, NULL, 0, 0, NULL, '3', NULL, '', 1677531600, 1677564162, NULL),
(100, '1', '', 33, 0, 0, 0, NULL, '1', 1, '', 1677790800, 1677564146, NULL),
(102, 'TESTING NOW ', 'WE HAVE TO MAKE A GREAT A GREAT JOB', 33, 76, 0, 0, NULL, '1', 0, '', 1677618000, 1677564135, NULL),
(103, 'пУПА И ЛУПА', 'кАКОЙ-ТО ТЕКСТ IN ENGLISH', 0, 0, 0, 0, 45, '3', 1, '', 1679864400, 1678806238, NULL),
(104, 'какой-то этап', '', 0, 0, 0, 0, NULL, '1', 1, '', 1678741200, 1678806217, NULL),
(106, 'Создание нового договора', NULL, 35, NULL, 0, 0, NULL, '3', NULL, '', 1678914000, 1678921418, NULL),
(107, 'Договор 16', '', 31, 81, 0, 82, NULL, '3', 0, '', 1678914000, 1678921403, NULL),
(108, 'Создание нового договора', NULL, 36, NULL, 0, 0, NULL, '1', NULL, '', 1678914000, 1678957390, NULL),
(109, 'acdc', '', 0, 0, 0, 0, NULL, '1', 0, '', 1685998800, 1678957398, NULL),
(110, 'Создание нового договора', NULL, 37, NULL, 0, 0, NULL, '1', NULL, '', 1678914000, 1678960997, NULL),
(111, 'Создание нового договора', NULL, 38, NULL, 0, 0, NULL, '3', NULL, '', 1678914000, 1678960988, NULL),
(112, 'Создание нового договора', NULL, 39, NULL, 0, 0, NULL, '3', NULL, '', 1678914000, 1678961010, NULL),
(113, 'Тест ', '', 39, 84, 0, 0, 48, '3', 0, '', 1678914000, 1678964630, NULL),
(114, 'лор', '', 0, 0, 0, 0, NULL, '1', 1, '', 1678914000, 1678964633, NULL),
(115, 'ход', '', 0, 0, 0, 0, NULL, '1', 0, '', 1680123600, 1678964596, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1559920163),
('m130524_201442_init', 1559920165),
('m190124_110200_add_verification_token_column_to_user_table', 1559920165),
('m190607_093453_create_settings_table', 1560255238),
('m190607_124511_create_event_table', 1664986537),
('m190607_143951_create_documentType_table', 1664986537),
('m190611_074702_create_document_table', 1664986538),
('m190617_073534_create_status_table', 1664986538),
('m190619_154637_create_project_table', 1664986538),
('m190628_143115_add_columns_to_user_table', 1664986542),
('m190629_143115_create_eventProject_table', 1664986542);

-- --------------------------------------------------------

--
-- Структура таблицы `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `user_id` int(11) DEFAULT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `sub_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `document_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `status_men` int(11) DEFAULT NULL,
  `status_ad` int(11) DEFAULT NULL,
  `status_us` int(11) DEFAULT NULL,
  `status_sub` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `notification`
--

INSERT INTO `notification` (`id`, `title`, `description`, `user_id`, `manager_id`, `sub_id`, `event_id`, `document_id`, `status`, `status_men`, `status_ad`, `status_us`, `status_sub`, `created_at`, `updated_at`) VALUES
(101, 'Создание нового договора', 'Менеджер: <b>Manager manager</b> создал новый договор, <b>\"Договор 1\"</b>, с клиентом: <b>Клиент client</b>', 68, 70, 0, NULL, NULL, 1, NULL, 2, NULL, 0, 1674648106, 1674817290),
(102, 'Создание нового договора', 'Менеджер: <b>Manager manager</b> создал новый договор, <b>\"Договор 2\"</b>, с клиентом: <b>Клиент client</b>', 68, 70, 0, NULL, NULL, 1, NULL, 2, NULL, 0, 1674648064, 1674817290),
(103, 'Создание нового договора', 'Менеджер: <b>Manager manager</b> создал новый договор, <b>\"Договор 2\"</b>, с клиентом: <b>Клиент client</b>', 68, 70, 0, NULL, NULL, 1, NULL, 2, NULL, 0, 1674648065, 1674817291),
(104, 'Создание нового договора', 'Менеджер: <b>Manager manager</b> создал новый договор, <b>\"Договор 3\"</b>, с клиентом: <b>Клиент client</b>', 68, 70, 0, NULL, NULL, 1, NULL, 2, NULL, 0, 1674651666, 1674817269),
(105, 'Требуется загрузка документа', '<p>Менеджер: <b>Manager manager</b> запросил у вас загрузку документа к событию: <b>\"\"</b>, загрузите по ссылке: </p>', 68, 70, 69, 85, 37, 5, 0, 0, NULL, 1, 1674655261, 1674655261),
(106, 'Новое событие', 'Менеджер: <b>Manager manager</b> создал новое событие, <b>\"\"</b>, с клиентом: <b>Клиент client</b>', 68, 70, 0, 85, NULL, 1, 2, 2, 1, 0, 1674655261, 1674817270),
(107, 'Создание нового договора', 'Менеджер: <b>Manager manager</b> создал новый договор, <b>\"Договор 11\"</b>, с клиентом: <b>Клиент client</b>', 68, 70, 0, NULL, NULL, 1, NULL, 2, NULL, 0, 1674655278, 1674817271),
(108, 'Создание нового договора', 'Менеджер: <b>Manager manager</b> создал новый договор, <b>\"Объект с уведомлением\"</b>, с клиентом: <b>Клиент client</b>', 68, 70, 0, NULL, NULL, 1, NULL, 2, NULL, 0, 1674810070, 1674817272),
(109, 'Новое событие', 'Менеджер: <b>Admin admin</b> создал новое событие, <b>\"Создание нового договора\"</b>, с клиентом: <b>client client</b>', 72, 1, 0, 88, NULL, 1, 1, 2, 2, 0, 1675162864, 1675245761),
(110, 'Новое событие', 'Менеджер: <b>Admin admin</b> создал новое событие, <b>\"Проверка даты\"</b>, с клиентом: <b>client client</b>', 72, 1, 0, 89, NULL, 1, 1, 2, 0, 0, 1675238557, 1675252925),
(111, 'Новое событие', 'Менеджер: <b>Admin admin</b> создал новое событие, <b>\"Проверка\"</b>, с клиентом: <b>client client</b>', 72, 1, 0, 90, NULL, 1, 1, 2, 0, 0, 1675238548, 1675252954),
(112, 'Отклик от клиента client client', 'Клиент: <b>client client</b> одобрил блокирующее событие, <b>\"Новое событие</b>, работа над объектом продолжается!', 72, 1, 0, 90, NULL, 1, 1, 2, 0, 0, 1675252946, 1675252962),
(113, 'Отклик от клиента client client', 'Клиент: <b>client client</b> одобрил блокирующее событие, <b>\"Новое событие</b>, работа над объектом продолжается!', 72, 1, 0, 90, NULL, 1, 1, 2, 0, 0, 1675252954, 1675252964),
(114, 'Отклик от клиента client client', 'Клиент: <b>client client</b> одобрил блокирующее событие, <b>\"Новое событие</b>, работа над объектом продолжается!', 72, 1, 0, 89, NULL, 1, 1, 2, 0, 0, 1675252956, 1675252968),
(115, 'Отклик от клиента client client', 'Клиент: <b>client client</b> хочет обсудить событие, <b>\"Новое событие</b>, работа над объектом приостановлена!', 72, 1, 0, 89, NULL, 1, 1, 2, 0, 0, 1675252974, 1675252970),
(116, 'Отклик от клиента client client', 'Клиент: <b>client client</b> хочет обсудить событие, <b>\"Новое событие</b>, работа над объектом приостановлена!', 72, 1, 0, 89, NULL, 1, 1, 2, 0, 0, 1675252978, 1675252973),
(117, 'Отклик от клиента client client', 'Клиент: <b>client client</b> хочет обсудить событие, <b>\"Новое событие</b>, работа над объектом приостановлена!', 72, 1, 0, 89, NULL, 1, 1, 2, 0, 0, 1675252925, 1675252974),
(118, 'Создание нового договора', 'Менеджер: <b>Manager manager</b> создал новый договор, <b>\"Договор \"</b>, с клиентом: <b>client client</b>', 72, 70, 0, NULL, NULL, 1, NULL, 2, NULL, 0, 1675252922, 1675252976),
(119, 'Новое событие', 'Менеджер: <b>Admin admin</b> создал новое событие, <b>\"Событие с уведомлением\"</b>, с клиентом: <b>client client</b>', 72, 1, 0, 93, NULL, 1, 1, 2, 0, 0, 1675425766, 1675569728),
(127, 'Отклик от клиента client client', 'Клиент: <b>client client</b> хочет обсудить событие, <b>\"Новое событие</b>, работа над объектом приостановлена!', 72, 1, 0, 93, NULL, 1, 1, 2, 0, 0, 1675429355, 1675569728),
(128, 'Требуется загрузка документа', '<p>Менеджер: <b>Admin admin</b> запросил у вас загрузку документа к событию: <b>\"Нужен документ от клиента\"</b>, загрузите по ссылке: </p>', 72, 1, 69, 94, 39, 5, 0, 0, NULL, 1, 1675432945, 1675432945),
(129, 'Новое событие', 'Менеджер: <b>Admin admin</b> создал новое событие, <b>\"Нужен документ от клиента\"</b>, с клиентом: <b>client client</b>', 72, 1, 0, 94, NULL, 1, 1, 2, 0, 0, 1675432945, 1675569741),
(130, 'Отклик от клиента client client', 'Клиент: <b>client client</b> одобрил блокирующее событие, <b>\"Новое событие</b>, работа над объектом продолжается!', 72, 1, 0, 94, NULL, 1, 1, 2, 0, 0, 1675569741, 1675576926),
(131, 'Требуется загрузка документа', '<p>Менеджер: <b>Manager manager</b> запросил у вас загрузку документа к событию: <b>\"Нуэен документ от клиента о договору 11\"</b>, загрузите по ссылке: </p>', 72, 70, 69, 95, 41, 5, 0, 0, NULL, 1, 1675580542, 1675580542),
(132, 'Новое событие', 'Менеджер: <b>Manager manager</b> создал новое событие, <b>\"Нуэен документ от клиента о договору 11\"</b>, с клиентом: <b>client client</b>', 72, 70, 0, 95, NULL, 1, 2, 2, 0, 0, 1675580542, 1675767723),
(133, 'Отклик от клиента client client', 'Клиент: <b>client client</b> хочет обсудить событие, <b>\"Новое событие</b>, работа над объектом приостановлена!', 72, 70, 0, 95, NULL, 1, 2, 2, 0, 0, 1675580568, 1675767723),
(134, 'Создание нового договора', 'Менеджер: <b>Manager manager</b> создал новый договор, <b>\"разработка дизайн-проекта бара \"</b>, с клиентом: <b>артем  Абдулаев</b>', 73, 70, 0, NULL, NULL, 1, NULL, 1, NULL, 0, 1675926172, 1675926172),
(135, 'Требуется загрузка документа', '<p>Менеджер: <b>Admin admin</b> запросил у вас загрузку документа к событию: <b>\"Нужен документ от клиента2\"</b>, загрузите по ссылке: </p>', 73, 1, 69, 97, 42, 5, 0, 0, NULL, 1, 1675936935, 1675936935),
(136, 'Новое событие', 'Менеджер: <b>Admin admin</b> создал новое событие, <b>\"Нужен документ от клиента2\"</b>, с клиентом: <b>артем  Абдулаев</b>', 73, 1, 0, 97, NULL, 1, 1, 1, 1, 0, 1675936935, 1675936935),
(137, 'Требуется загрузка документа', '<p>Менеджер: <b>Admin admin</b> запросил у вас загрузку документа к событию: <b>\"\"</b>, загрузите по ссылке: </p>', 74, 1, 69, 98, 43, 5, 0, 0, NULL, 1, 1675936941, 1675936941),
(138, 'Новое событие', 'Менеджер: <b>Admin admin</b> создал новое событие, <b>\"\"</b>, с клиентом: <b>Денис Шрейфер</b>', 74, 1, 0, 98, NULL, 1, 1, 1, 1, 0, 1675936941, 1675936941),
(139, 'Создание нового договора', 'Менеджер: <b>Manager manager</b> создал новый договор, <b>\"PROJECT 1\"</b>, с клиентом: <b>Денис Шрейфер</b>', 74, 70, 0, NULL, NULL, 1, NULL, 1, NULL, 0, 1677564162, 1677564162),
(140, 'Новое событие', 'Менеджер: <b>Admin admin</b> создал новое событие, <b>\"1\"</b>, с клиентом: <b>артем  Абдулаев</b>', 73, 1, 0, 101, NULL, 1, 1, 1, 1, 0, 1677564128, 1677564128),
(141, 'Новое событие', 'Менеджер: <b>Admin admin</b> создал новое событие, <b>\"TESTING NOW \"</b>, с клиентом: <b>TEST1 TEST1</b>', 76, 1, 0, 102, NULL, 1, 1, 1, 1, 0, 1677564135, 1677564135),
(142, 'Создание нового договора', 'Менеджер: <b>Manager manager</b> создал новый договор, <b>\"test\"</b>, с клиентом: <b>Client Client</b>', 81, 80, 0, NULL, NULL, 1, NULL, 1, NULL, 0, 1678896235, 1678896235),
(143, 'Создание нового договора', 'Менеджер: <b>Manager manager</b> создал новый договор, <b>\"Договор\"</b>, с клиентом: <b>Client Client</b>', 81, 80, 0, NULL, NULL, 1, NULL, 1, NULL, 0, 1678921418, 1678921418),
(144, 'Требуется загрузка документа', '<p>Менеджер: <b>Manager manager</b> запросил у вас загрузку документа к событию: <b>\"Договор 16\"</b>, загрузите по ссылке: </p>', 81, 80, 82, 107, 47, 5, 0, 0, NULL, 1, 1678921403, 1678921403),
(145, 'Новое событие', 'Менеджер: <b>Manager manager</b> создал новое событие, <b>\"Договор 16\"</b>, с клиентом: <b>Client Client</b>', 81, 80, 0, 107, NULL, 1, 2, 1, 0, 0, 1678921403, 1678925030),
(146, 'Отклик от клиента Client Client', 'Клиент: <b>Client Client</b> одобрил блокирующее событие, <b>\"Новое событие</b>, работа над объектом продолжается!', 81, 80, 0, 107, NULL, 1, 2, 1, 0, 0, 1678925030, 1678925036),
(147, 'Создание нового договора', 'Менеджер: <b>Даня подвальный</b> создал новый договор, <b>\"Мясницкая \"</b>, с клиентом: <b>урзик бутотенечкин</b>', 77, 78, 0, NULL, NULL, 1, NULL, 1, NULL, 0, 1678957390, 1678957390),
(148, 'Создание нового договора', 'Менеджер: <b>Даня подвальный</b> создал новый договор, <b>\"qwerty\"</b>, с клиентом: <b>урзик бутотенечкин</b>', 77, 78, 0, NULL, NULL, 1, NULL, 1, NULL, 0, 1678960997, 1678960997),
(149, 'Создание нового договора', 'Менеджер: <b>Даня подвальный</b> создал новый договор, <b>\"Тест 16/03/2022\"</b>, с клиентом: <b>иван водкин</b>', 84, 78, 0, NULL, NULL, 1, NULL, 1, NULL, 0, 1678961010, 1678961010),
(150, 'Новое событие', 'Менеджер: <b>Admin admin</b> создал новое событие, <b>\"Тест \"</b>, с клиентом: <b>иван водкин</b>', 84, 1, 0, 113, NULL, 1, 1, 1, 1, 0, 1678961033, 1678961033);

-- --------------------------------------------------------

--
-- Структура таблицы `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `address` text,
  `user_id` int(11) DEFAULT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `description` text,
  `number` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `project`
--

INSERT INTO `project` (`id`, `title`, `address`, `user_id`, `manager_id`, `area`, `type`, `status_id`, `description`, `number`, `created_at`, `updated_at`) VALUES
(26, 'Договор 2', '', 78, 0, '', NULL, 3, '', '', 1674648064, 1678806233),
(28, 'Договор 3', '', 77, 0, '345', NULL, 4, '', '', 1674651666, 1678806203),
(29, 'Договор 11', 'Саратов', 78, 0, '26', NULL, 2, '', '11', 1674655278, 1678806195),
(31, 'Договор ', 'Саратов', 0, 0, '', NULL, 1, '', '12', 1675252922, 1678683813),
(32, 'разработка дизайн-проекта бара ', '', 77, 0, '', NULL, 3, '', '07/Д/2023', 1675926172, 1678806208),
(33, 'PROJECT 1', '', 85, 0, '', NULL, 3, '', '28-02-2023', 1677564162, 1678964603),
(34, 'test', '', 81, 80, '', NULL, 1, '', '1', 1678896235, 1678896235),
(35, 'Договор', '', 81, 80, '', NULL, 3, '', '16', 1678921418, 1678921418),
(36, 'Мясницкая ', '12 12 12', 77, 78, '12', NULL, 1, '', '12 12 12', 1678957390, 1678957390),
(37, 'qwerty', '', 77, 78, '', NULL, 1, '', '16032023', 1678960997, 1678960997),
(38, 'Тест 16/03/2022', '', 84, 0, '', NULL, 3, '', '', 1678960988, 1678960988),
(39, 'Тест 16/03/2022', '', 84, 78, '23', NULL, 3, '', '16032023', 1678961010, 1678961010);

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `module_id` varchar(100) DEFAULT NULL,
  `param_name` varchar(100) DEFAULT NULL,
  `param_value` varchar(500) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `module_id`, `param_name`, `param_value`, `create_time`, `update_time`, `user_id`, `type`) VALUES
(1, 'sun', 'logo', '1667058998_xmP_G9.png', '2019-06-11 15:13:58', '2022-11-14 18:11:17', 1, 1),
(2, 'sun', 'siteName', 'Архо-СРМ', '2019-06-11 15:13:58', '2022-11-14 18:11:17', 1, 1),
(3, 'sun', 'siteDescription', '', '2019-06-11 15:13:58', '2022-11-14 18:11:17', 1, 1),
(4, 'sun', 'siteKeyWords', '', '2019-06-11 15:13:58', '2022-11-14 18:11:17', 1, 1),
(5, 'sun', 'email', '', '2019-06-11 15:13:58', '2022-11-14 18:11:17', 1, 1),
(6, 'sun', 'defaultLanguage', 'ru', '2019-06-11 15:13:58', '2022-11-14 18:11:17', 1, 1),
(7, 'sun', 'availableLanguages', 'ru,en', '2019-06-11 15:13:58', '2022-11-14 18:11:17', 1, 1),
(8, 'sun', 'allowedExtensions', 'jpg,png,svg', '2019-06-11 15:13:58', '2022-11-14 18:11:17', 1, 1),
(9, 'sun', 'defaultImage', '1573287896_s43Y7s.xlsx', '2019-06-11 15:13:58', '2022-11-14 18:11:17', 1, 1),
(10, 'sun', 'indexation', '2', '2019-06-11 15:13:58', '2022-11-14 18:11:17', 1, 1),
(11, 'sun', 'typeSite', '2', '2019-06-11 15:13:58', '2022-11-14 18:11:17', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id`, `title`, `created_at`) VALUES
(1, 'Рассмотрение', NULL),
(2, 'Утверждение', NULL),
(3, 'В работе', NULL),
(4, 'Смежные этапы', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `patronymic` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT '1',
  `type` int(11) NOT NULL DEFAULT '1',
  `ogrn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `inn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rs` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bik` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ur_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ur_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fis_passport` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fis_vidan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fis_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fis_registration` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`, `name`, `surname`, `patronymic`, `phone`, `active`, `role`, `type`, `ogrn`, `inn`, `rs`, `ks`, `bik`, `bank`, `ur_address`, `ur_name`, `fis_passport`, `fis_vidan`, `fis_number`, `fis_registration`) VALUES
(1, 'Admin admin', '93WGmO8gB1BgK4wefipyB-msAftb4RBV', '$2y$13$.OWu04n9Ld7BQyEuE0sw8OOre.aWvgoAjqZXptD6aS1rx.VZIyLJW', NULL, 'shedevrxxx@inbox.ru', 10, 1559920361, 1674104499, NULL, 'Admin', 'admin', NULL, '+7 (967) 660-88-22', '1', 10, 0, '', '', '', '', '', '', '', '', '', '', '', ''),
(77, 'урзик бутотенечкин', 'W0GoPEhEUewoiworta27BhkpPDLSjmQb', '$2y$13$j.lqk7FMHwgRoV2kVVHNp.55y45qNYTs61DFPZdNAsELOhhAMbOyq', NULL, 'sjlrashevsv@mail.ru', 10, 1678806208, 1678806235, NULL, 'урзик', 'бутотенечкин', NULL, '+7 (999) 999-99-99', '1', 1, 1, '', '', '', '', '', '', '', '', '', '', '', ''),
(78, 'Даня подвальный', 'MwNrkOI0YaKgTYlpZQDbSf_b622For3F', '$2y$13$QUFh0kbzyzOWBtSEQFh90OS8GXPp3EwTLJLWy34BgnHA7VhpTQGB2', NULL, 'woomba0909@gmail', 10, 1678806233, 1678806195, NULL, 'Даня', 'подвальный', NULL, '+7 (999) 999-99-99', '1', 5, 1, '', '', '', '', '', '', '', '', '', '', '', ''),
(80, 'Manager manager', '11SUamnilM0GWDozjbKdHIB7FohmpSef', '$2y$13$dORPqe66.eGwTgPi/zX9R.Q5XHwLwWHD51piGilsuZPtKXOcsDqe6', NULL, 'test@ya.ru', 10, 1678896189, 1678921417, NULL, 'Manager', 'manager', NULL, '+7 (999) 999-99-99', '1', 5, 1, '', '', '', '', '', '', '', '', '', '', '', ''),
(81, 'Client Client', 'QbETsEEwILkpQCeqUg6Ivb5YktEHrCIp', '$2y$13$pruz.X.Q0kC6ZIVdGTzwiOUye5W7kvNcwe8ehtvTeBJjEhQK6ZwYO', NULL, 'test1@ya.ru', 10, 1678896231, 1678896231, NULL, 'Client', 'Client', NULL, '+7 (999) 999-99-99', '1', 1, 1, '', '', '', '', '', '', '', '', '', '', '', ''),
(82, 'Sub Sub', 'p20JOGRpIQYBVI5U2Opjf6raWlLu_ml4', '$2y$13$nd9bQ7wNw/VuIozpC.PBmesI/dJBJFJVsvdCHfB7oCLoBOgaozEUu', NULL, 'Test2@ya.ru', 10, 1678921413, 1678957439, NULL, 'Sub', 'Sub', NULL, '+7 (999) 999-99-99', '1', 2, 1, '', '', '', '', '', '', '', '', '', '', '', ''),
(83, 'Сергей Шаповалов', 'Zq8E29ws-nSiKFOEAl2KS9lYaAcrEls8', '$2y$13$Ci46KR.GVfKFqm8BpLHewuH/v/M5dmiuZ4zoswhrVfQfIBnjFBfdC', NULL, 'qwerty@qwerty.qw', 10, 1678946629, 1678957437, NULL, 'Сергей', 'Шаповалов', NULL, '+7 (999) 999-99-99', '0', 2, 1, '', '', '', '', '', '', '', '', '', '', '', ''),
(84, 'иван водкин', '93tBOK3TogRSmNv5UBkhyF4a0gbJa6vG', '$2y$13$sH7UldKFinp44GvVpovVvepZZ8RdoB.BrUniM/ISqW7ixJNexT3FS', NULL, '1@', 10, 1678961015, 1678964589, NULL, 'иван', 'водкин', NULL, '+7 (987) 878-89-98', '0', 1, 1, '', '', '', '', '', '', '', '', '1111111111', 'риопрломьрмьрмь', '2222222', 'наекреагегеа'),
(85, 'ццц ййй', 'yIuUO9iVjPzny4-eM3AHR2-uazKvpR7D', '$2y$13$6PLGVGo3Gb3WFvQJuQ8M7uIu9l0nfYvgUB7bpG66OzXPVav0vofNS', NULL, 'qwerty@', 10, 1678964603, 1678964603, NULL, 'ццц', 'ййй', NULL, '+7 (888) 888-88-88', '0', 2, 1, '', '', '', '', '', '', '', '', '', '', '', ''),
(86, 'Денис Шрейфер', 'E2Enx5U2p7v4OFI35edLQMmApCC9KCns', '$2y$13$0GwstLbBebFMZ7Np1cwLdelcWSeeLLMBvrxVlh0irQfLcw0/5P9dO', NULL, 'shedevrxxx@gmail.com', 10, 1680001432, 1680001425, NULL, 'Денис', 'Шрейфер', NULL, '+7 (967) 660-88-22', '1', 1, 1, '', '', '', '', '', '', '', '', '', '', '', ''),
(87, 'Д М', '9gCTQKbjpxNY9kcwRRvCBU6dRRZgvy9s', '$2y$13$gW/4KsWpCE0DvfGB/f2A3uKxbsJF0YgAn5EQd0nnnDv4cyHRBGSsK', NULL, '1@gmail.com', 10, 1680073425, 1680073425, NULL, 'Д', 'М', 'А', '+7 (999) 999-99-99', '0', 1, 1, '', '', '', '', '', '', '', '', '', '', '', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `document_type`
--
ALTER TABLE `document_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT для таблицы `document_type`
--
ALTER TABLE `document_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
--
-- AUTO_INCREMENT для таблицы `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;
--
-- AUTO_INCREMENT для таблицы `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
