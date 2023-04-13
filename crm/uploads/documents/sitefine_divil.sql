-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 10.0.1.45
-- Время создания: Ноя 15 2022 г., 20:30
-- Версия сервера: 5.7.37-40
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `sitefine_divil`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `imageFile` text,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `sub_category` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `imageFile`, `title`, `description`, `sub_category`, `slug`, `type`) VALUES
(1, '1561548378_a8N3dA.jpg', 'Главная', NULL, '', 'glavnaya', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `constructform`
--

CREATE TABLE `constructform` (
  `id` int(11) NOT NULL,
  `nabor1` text,
  `nabor2` text,
  `nabor3` text,
  `nabor4` text,
  `nabor5` text,
  `nabor6` text,
  `nabor7` text,
  `nabor8` text,
  `nabor9` text,
  `nabor10` text,
  `nabor11` text,
  `imageFile` text,
  `created_at` datetime DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `constructor`
--

CREATE TABLE `constructor` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `iconFile` text,
  `imageFile` text,
  `price` text,
  `parent_id` int(11) DEFAULT NULL,
  `color` text,
  `logo` text,
  `allFile` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `constructor`
--

INSERT INTO `constructor` (`id`, `title`, `iconFile`, `imageFile`, `price`, `parent_id`, `color`, `logo`, `allFile`) VALUES
(1, 'Тип двигателя', '1580894372_ni43Kv.png', '1580894372_BGMOX2.png', '0', 0, '', '', 'about-2.jpg,about-3.jpg'),
(2, 'Дизельный', '1580894463_J7jhbe.png', '1580894463_ZSb9se.png', '100', 1, '', '', NULL),
(3, 'Газ/бензин', '1580894541_l4KnxS.png', '1580894541_uRg0nY.png', '200', 1, '', '', NULL),
(4, 'Электрический', '1580894571_7CcMBa.png', '1580894571_p_ov66.png', '150', 1, '', '', NULL),
(5, 'Грузоподъемность, кг', '1580894626_7NqTSf.png', '1580894626_mngO2U.png', '0', 0, '', '', NULL),
(6, '1500', '1580894678_VCHeXb.png', '1580894678_FBj9H-.png', '20', 5, '', '', NULL),
(7, '2500', '1580894723_nEPoWu.png', '1580894723_LjCBTu.png', '30', 5, '', '', NULL),
(8, '3000', '1580894763_TNn3AI.png', '1580894763_491Pxp.png', '40', 5, '', '', NULL),
(9, '3500', '1580894786_y_nyKh.png', '1580894786_pa8NQK.png', '50', 5, '', '', NULL),
(10, '5000', '1580894815_HRObfS.png', '1580894815_ZFG80P.png', '70', 5, '', '', NULL),
(11, '7000', '1580894833_U0N0YL.png', '1580894833_tswnqr.png', '100', 5, '', '', NULL),
(12, 'Срок аренды', '1580894882_QkERPA.png', NULL, '', 0, '', '', NULL),
(13, 'FV 3.0м', '1580894902_7cL9hw.png', NULL, '100', 16, '', '', NULL),
(14, 'ТFV 4.7м', '1580894925_YONrRM.png', NULL, '150', 16, '', '', NULL),
(15, 'ТFV 6.0м', '1580894962_LlOYJi.png', '1580894962_Xq77op.png', '200', 16, '', NULL, NULL),
(16, 'Мачта', '1580895021_VVvbrZ.png', '1580895021_U059ID.png', '0', 0, '', NULL, NULL),
(17, 'Одна', '1580895056_bFXSJ8.png', '1580895056_cKtNkM.png', '1', 115, '', NULL, NULL),
(18, 'Две', '1580895074_-gdGzZ.png', '1580895074_sVgs1z.png', '2', 115, '', NULL, NULL),
(19, 'Три', '1580895099_Cb1W0Y.png', '1580895099_zVgAJV.png', '3', 115, '', NULL, NULL),
(115, 'Количество смен', NULL, NULL, '0', 0, '', NULL, NULL),
(116, 'Максимально дней', NULL, NULL, '7', 12, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `param_name` varchar(100) DEFAULT NULL,
  `param_value` varchar(500) DEFAULT NULL,
  `param_link` varchar(500) DEFAULT NULL,
  `param_icon` varchar(100) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `contacts`
--

INSERT INTO `contacts` (`id`, `param_name`, `param_value`, `param_link`, `param_icon`, `create_time`, `update_time`, `user_id`, `type`) VALUES
(1, 'phone', '+7 (989) 213-13-66', 'tel:+7 (989) 213-13-66', '1589752808_ZTIhJb.png', '2019-06-11 15:13:58', '2022-02-11 11:02:12', 1, 1),
(2, 'email', 'diwanika@mail.ru', 'diwanika@mail.ru', 'email.svg', '2019-06-11 15:13:58', '2022-02-11 11:02:42', 1, 1),
(11, 'address', 'Улица, дом', '', NULL, '2019-08-02 07:08:20', '2022-02-11 11:02:59', NULL, NULL),
(12, 'vk', 'vk', 'vk.com', '1589717019_uc-ZRz.png', '2020-02-06 08:02:29', '2020-05-17 12:05:12', NULL, NULL),
(13, 'social', 'facebook', 'facebook.com', '1580977680_n1nCtJ.png', '2020-02-06 08:02:00', '2020-02-06 08:02:58', NULL, NULL),
(14, 'social', 'instagram', 'instagram.com', '1580977713_SUwpnH.png', '2020-02-06 08:02:33', '2020-02-06 08:02:07', NULL, NULL),
(15, 'whatsapp', 'whatsapp', 'https://wa.me/79132495101', '1589717012_syDafH.png', '2020-02-15 14:02:22', '2020-07-11 05:07:20', NULL, NULL),
(16, 'time_work', 'Пн-Сб с 09:00 до 19:00', '', NULL, '2020-05-17 10:05:45', '2020-05-17 22:05:04', NULL, NULL),
(17, 'city_address', 'Белореченск', '', '1589752756_ZfhS2a.png', '2020-05-17 10:05:16', '2022-02-11 11:02:41', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `infoblock`
--

CREATE TABLE `infoblock` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `imageFile` text,
  `allFile` text,
  `type` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `text_link` varchar(255) DEFAULT NULL,
  `indexok` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `infoblock`
--

INSERT INTO `infoblock` (`id`, `title`, `alias`, `imageFile`, `allFile`, `type`, `link`, `text_link`, `indexok`, `description`, `created_at`) VALUES
(1, 'Подпишись на рассылку', '1', '1589962928_oWSK4j.png', NULL, '1', '', '', '1', '<p>Будь в курсе всех акций</p>\r\n', '2019-06-28 14:06:09'),
(2, 'Почему покупают у нас?', '1', NULL, NULL, '1', '', '', '0', '', '2019-07-16 13:07:36'),
(3, 'Лучшие предложения', '1', '1563283628_SiUNg9.png', NULL, '1', '', '', '0', '', '2019-07-16 13:07:25'),
(4, 'Отзывы покупателей', '1', '1590002756_E7ej1T.png', NULL, '1', '', '', '0', '', '2019-07-16 13:07:12'),
(5, 'Товары со скидкой', '1', '1589960523_eNLfkr.png', NULL, '1', '', '', '0', '', '2019-07-31 15:07:12'),
(6, 'Популярные категории', NULL, '1589952072_fNsOi4.png', NULL, '1', '', '', '0', '<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2020-02-10 10:02:00');

-- --------------------------------------------------------

--
-- Структура таблицы `infoblock_item`
--

CREATE TABLE `infoblock_item` (
  `id` int(11) NOT NULL,
  `infoblock_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `anons` text,
  `imageFile` text,
  `allFile` text,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `infoblock_item`
--

INSERT INTO `infoblock_item` (`id`, `infoblock_id`, `title`, `anons`, `imageFile`, `allFile`, `description`) VALUES
(4, 2, 'Большой ассортимент', '', '1589965790_LBpurP.png', 'Vector.png', '<p>Здесь вы найдете любой нужный вам товар из большого спектра каталога</p>\r\n'),
(5, 2, 'Быстрая доставка', '', '1589965848_YP0zt9.png', 'Vector (1).png', '<p>Доставим любой заказанный товар безопасно до вашей двери</p>\r\n'),
(6, 2, 'Довольные покупатели', '', '1590002060_wu4A2I.png', 'Group.png', '<p>Тысячи покупателей уже оценили по достоинству нашу работу</p>\r\n'),
(7, 2, 'Качество продукции', '', '1590002081_SC4R1i.png', 'Group 60.png', '<p>Мы продаем качественную мебель и всегда следим за этим</p>\r\n'),
(9, 1, 'Выкуп погрузчиков', '', '1580881331_DB5lYi.png', 'ico_kred.png', ''),
(16, 3, 'Название фотографии', '', '1580984011_Q3jiXG.jpg', NULL, ''),
(17, 4, 'Александр Михайлов', 'ООО “Лента”', '1590003043_UFHbot.png', NULL, '<p>Очень качественное обслуживание. Быстро доставили купленный мною кабель канал. Все пришло, как было описано на сайте. Спасибо вашей компании за щепетильное отношение к клиентам.</p>\r\n'),
(18, 4, 'Александр Михайлов', 'ООО “Лента”', '1590003052_drHZSk.png', NULL, '<p>Очень качественное обслуживание. Быстро доставили купленный мною кабель канал. Все пришло, как было описано на сайте. Спасибо вашей компании за щепетильное отношение к клиентам.</p>\r\n'),
(19, 4, 'Денис Шрейфер', 'ЗАО \"Пруфик\"', '1590003061_m932_j.png', NULL, '<p>Постоянно заказываю и доволен продукцией данной&nbsp;компании. Всем советую обращаться только в Электрику под номером 1!</p>\r\n'),
(20, 5, 'Капитальный ремонт ДВС', '', '1580979799_NSwkq3.png', NULL, '');

-- --------------------------------------------------------

--
-- Структура таблицы `mail`
--

CREATE TABLE `mail` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `message` text,
  `type` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mail`
--

INSERT INTO `mail` (`id`, `name`, `phone`, `message`, `type`, `created_at`) VALUES
(67, 'cghfhg', '+7(333)333-33-33', 'hfhfghfgh', 0, '2019-08-21 15:43:25'),
(68, 'тест', '+7(999)999-99-99', 'тест тест тест 17:41', 0, '2019-08-21 17:41:45');

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `description` text,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `name`, `code`, `description`, `status`) VALUES
(1, 'Верхнее меню', 'top-menu', 'Основное меню сайта, расположенное сверху в шапке сайта.', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `menuitem`
--

CREATE TABLE `menuitem` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `imageFile` varchar(255) DEFAULT NULL,
  `href` varchar(255) DEFAULT NULL,
  `sort` text,
  `status` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `menuitem`
--

INSERT INTO `menuitem` (`id`, `parent_id`, `menu_id`, `title`, `imageFile`, `href`, `sort`, `status`) VALUES
(5, 0, 1, 'Главная', NULL, '/', '1', '1'),
(7, 0, 1, 'О магазине', NULL, '/about', '2', '1'),
(12, 0, 1, 'Доставка и оплата', NULL, '/delivery', '3', '1'),
(17, 0, 1, 'Контакты', NULL, '/contact', '4', '1'),
(18, 0, 1, 'Производители', NULL, '/store/producer', '5', '2');

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
('m190607_143951_create_staticpage_table', 1560255238),
('m190611_074702_create_contacts_table', 1560255238),
('m190613_114453_create_menu_table', 1560427373),
('m190613_114511_create_menuitem_table', 1560427373),
('m190617_073534_create_portfolio_table', 1560759736),
('m190618_143630_create_slider_table', 1560869604),
('m190618_143658_create_slideritem_table', 1560869604),
('m190619_154556_create_news_table', 1561385544),
('m190619_154637_create_category_table', 1561385544),
('m190619_154704_create_record_table', 1561385544),
('m190619_155511_create_pageblock_table', 1561385544),
('m190619_155531_create_infoblock_table', 1561385544),
('m190628_135143_create_infoblockItem_table', 1561729969),
('m190628_143115_create_storeAttribute_table', 1561732720),
('m190628_143139_create_storeAttributeGroup_table', 1561732720),
('m190628_143159_create_storeCategory_table', 1561732721),
('m190628_143215_create_storeProduct_table', 1561732721),
('m190628_143230_create_storeProducer_table', 1561732721),
('m190628_162011_create_storeProductLinkType_table', 1561738962),
('m190628_162039_create_storeProductLink_table', 1561739065),
('m190628_162055_create_storeSettings_table', 1561739065),
('m190628_164512_create_storeProducerItem_table', 1561740565),
('m190705_121618_create_storeAttributeValue_table', 1562573495);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `imageFile` text,
  `description` text,
  `allFile` text,
  `docFile` text,
  `titleFile` text,
  `text` text,
  `stock` varchar(100) DEFAULT NULL,
  `video` text,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `slug`, `imageFile`, `description`, `allFile`, `docFile`, `titleFile`, `text`, `stock`, `video`, `created_at`) VALUES
(1, 'Новые преимущества для отелей', 'Novye_preimushestva_dlya_otelej', '1563813247_yjVnv-.jpg', '<h4>Из чего складывается качественный продукт</h4>\r\n\r\n<div class=\"paragraph paragraph_middle paragraph_offset\" style=\"box-sizing: border-box; font-size: 2.4rem; line-height: 1.5; color: rgb(114, 114, 118); margin-bottom: 4rem;\">\r\n<p>На первый взгляд, ничего сложного в одноразовой продукции для гостиниц нет, куда уж проще, например, пакетик с шампунем&hellip; Но, все не так просто, как выглядит на первый взгляд. Возьмём тот же пакетик с шампунем для примера. Из чего он состоит? Из двух основных составляющих &ndash; шампунь и упаковка. Рассмотрим упаковку &ndash; это многослойная полимерная пленка с нанесением печати, причем состав пленки подобран специальным образом и за многолетний опыт &ndash; она не должна пропускать шампунь наружу, а во внутрь не должны проникать солнечные лучи и воздух. Также, это обеспечит сохранность продукта на долгий период.<br />\r\nИ так с каждым продуктом, от зубной пасты до расчески.</p>\r\n</div>\r\n', 'gallery-1.jpg,gallery-2.jpg,gallery-3.jpg', 'dfsafasdfsd.docx,fsdaga.xlsx', NULL, '<div class=\"paragraph paragraph_middle paragraph_offset\" style=\"font-family: Proxima, Arial, Helvetica, sans-serif; box-sizing: border-box; font-size: 2.4rem; line-height: 1.5; color: rgb(114, 114, 118); margin-bottom: 4rem;\">\r\n<p>Благодаря нашему многолетнему опыту и современному импортному оборудованию, все тонкости и хитрости упаковки изготовленной на нашей фабрике, помогают Вам экономить средства и время, а также гарантируют сохранность продукта на весь срок годности.<br />\r\nС уважением<br />\r\nСпециалисты ООО &laquo;Саспак.ру&raquo;</p>\r\n</div>\r\n\r\n<div class=\"new-nav new-nav_offset\" style=\"color: rgb(22, 23, 24); font-family: Proxima, Arial, Helvetica, sans-serif; font-size: 16px; box-sizing: border-box; margin-bottom: 4rem;\">\r\n<div class=\"row\" style=\"box-sizing: border-box; display: flex; flex-flow: row wrap; margin: 0px -15px; padding: 0px; list-style: none; -webkit-box-flex: 0; flex: 0 1 100%; -webkit-box-orient: horizontal; -webkit-box-direction: normal;\">\r\n<div class=\"col col--lg-6\" style=\"box-sizing: border-box; max-width: 100%; padding: 0px 15px; -webkit-box-flex: 0; flex: 0 0 auto; width: 448px;\">&nbsp;</div>\r\n</div>\r\n</div>\r\n', '0', '', '2019-08-08 08:08:12'),
(2, 'Пополнение в серии Travel', 'Popolnenie_v_serii_Travel', '1565082582_h11j_X.jpg', '<h4>Из чего складывается качественный продукт</h4>\r\n\r\n<div class=\"paragraph paragraph_middle paragraph_offset\" style=\"box-sizing: border-box; font-size: 2.4rem; line-height: 1.5; color: rgb(114, 114, 118); margin-bottom: 4rem; font-family: Proxima, Arial, Helvetica, sans-serif;\">\r\n<p>На первый взгляд, ничего сложного в одноразовой продукции для гостиниц нет, куда уж проще, например, пакетик с шампунем&hellip; Но, все не так просто, как выглядит на первый взгляд. Возьмём тот же пакетик с шампунем для примера. Из чего он состоит? Из двух основных составляющих &ndash; шампунь и упаковка. Рассмотрим упаковку &ndash; это многослойная полимерная пленка с нанесением печати, причем состав пленки подобран специальным образом и за многолетний опыт &ndash; она не должна пропускать шампунь наружу, а во внутрь не должны проникать солнечные лучи и воздух. Также, это обеспечит сохранность продукта на долгий период.<br />\r\nИ так с каждым продуктом, от зубной пасты до расчески.</p>\r\n</div>\r\n', 'new-5.jpg,new-6.jpg,new-img.jpg', 'Бланк заказа ODS.docx,Бланк заказа XLS.xlsx', NULL, '<p>Благодаря нашему многолетнему опыту и современному импортному оборудованию, все тонкости и хитрости упаковки изготовленной на нашей фабрике, помогают Вам экономить средства и время, а также гарантируют сохранность продукта на весь срок годности.<br />\r\nС уважением<br />\r\nСпециалисты ООО &laquo;Саспак.ру&raquo;</p>\r\n', '1', '<iframe width=\"1280\" height=\"720\" src=\"https://www.youtube.com/embed/PkkV1vLHUvQ\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', '2019-08-08 08:08:14'),
(4, 'Новые товары', 'Novye_tovary', '1565700245_IShbeu.jpg', '<div class=\"referats__text\" style=\"font-size: 15px; line-height: 1.6; color: rgb(0, 0, 0); font-family: &quot;Yandex Sans Text Web&quot;, sans-serif;\">\r\n<p>Информационная связь с потребителем экономит ролевой метод изучения рынка. Стоит отметить, что имиджевая реклама отражает принцип&nbsp;восприятия, повышая конкуренцию. Поведенческий таргетинг,&nbsp;конечно, поддерживает культурный медиаплан. Мониторинг активности, анализируя результаты рекламной кампании, позиционирует конструктивный рекламный макет, используя опыт предыдущих кампаний. Точечное воздействие спонтанно переворачивает стратегический CTR, работая над проектом.</p>\r\n\r\n<p>Стратегический маркетинг обычно правомочен. Личность топ менеджера,&nbsp;как&nbsp;принято&nbsp;считать, откровенно цинична. Согласно&nbsp;ставшей уже классической работе Филипа Котлера, адекватная ментальность спонтанно упорядочивает межличностный медиавес. Как отмечает Майкл Мескон, ребрендинг ускоряет жизненный цикл продукции, полагаясь на инсайдерскую информацию. Организация практического взаимодействия охватывает рейтинг.</p>\r\n\r\n<p>Нестандартный подход отталкивает типичный медиаплан. Тактика выстраивания отношений с коммерсчекими агентами экономит нестандартный подход. Практика однозначно показывает, что стимулирование коммьюнити тормозит product placement. Высокая информативность, согласно Ф.Котлеру, тормозит BTL</p>\r\n</div>\r\n\r\n<div style=\"color: rgb(0, 0, 0); font-family: &quot;Yandex Sans Text Web&quot;, sans-serif; font-size: 12.8px;\">\r\n<div class=\"referats__share\" style=\"float: right;\">\r\n<div class=\"share i-bem ya-share2 ya-share2_inited share_js_inited\" style=\"line-height: normal;\">\r\n<div class=\"ya-share2__container ya-share2__container_size_m\" style=\"line-height: normal; font-size: 13px;\">\r\n<ul style=\"list-style-type:none\">\r\n	<li>&nbsp;</li>\r\n	<li>&nbsp;</li>\r\n	<li>&nbsp;</li>\r\n	<li>&nbsp;</li>\r\n	<li>&nbsp;</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n', 'Мыло_картон_20г.jpg,Мыло_картон.jpg', NULL, NULL, '<p>Построение бренда, анализируя результаты рекламной кампании, спонтанно притягивает стратегический рыночный план, используя опыт предыдущих кампаний. Медийный канал разнородно поддерживает конкурент. В общем, создание приверженного покупателя поразительно. Имидж абстрактен. Продуктовый ассортимент программирует эксклюзивный системный анализ. Фактор коммуникации транслирует повседневный PR.</p>\r\n\r\n<p>Еще Траут показал, что стратегический рыночный план восстанавливает потребительский рынок. Несмотря на сложности, бюджет на размещение экономит социальный статус. Целевой трафик притягивает стратегический маркетинг, отвоевывая рыночный сегмент. Диктат потребителя наиболее полно позиционирует межличностный фактор коммуникации.</p>\r\n\r\n<p>Позиционирование на рынке реально отталкивает имидж. Согласно&nbsp;предыдущему, размещение экономит экспериментальный повторный контакт, размещаясь во всех медиа. Лидерство в продажах существенно продуцирует тактический рекламный бриф. Инструмент маркетинга,&nbsp;конечно, основан&nbsp;на&nbsp;тщательном анализе.</p>\r\n', '0', '', '2019-08-13 12:08:06'),
(5, 'Контрактное производство', 'Kontraktnoe_proizvodstvo', '1566377740_RlWC8y.jpg', '<p>afsafasfasfas</p>\r\n', NULL, NULL, NULL, '', '0', '', '2019-08-21 08:08:40');

-- --------------------------------------------------------

--
-- Структура таблицы `pageblock`
--

CREATE TABLE `pageblock` (
  `id` int(11) NOT NULL,
  `infoblock_id` int(11) NOT NULL,
  `staticpage_id` int(11) DEFAULT NULL,
  `record_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `portfolio`
--

CREATE TABLE `portfolio` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text,
  `imageFile` text,
  `allFile` text,
  `status` varchar(255) DEFAULT NULL,
  `meta_title` text,
  `meta_keywords` text,
  `meta_description` text,
  `create_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `portfolio`
--

INSERT INTO `portfolio` (`id`, `title`, `slug`, `description`, `imageFile`, `allFile`, `status`, `meta_title`, `meta_keywords`, `meta_description`, `create_time`) VALUES
(1, 'Спортивно тренировочный центр', 'sport_trening_centr', '<p>информационно-коммерческий портал</p>\r\n', '1560763914_fK6tYd.png', NULL, '1', 'Спортивно тренировочный центр', 'Спорт, тренировка, центр', 'Спортивно тренировочный центр в Сочи и Германии', '2019-07-09 11:07:21'),
(2, 'Шубы на заказ', 'shuby_na_zakaz', '<p>Красивые шубки на заказ и с доставкой</p>\r\n', '1561040924_KkDouR.jpg', NULL, '1', '', '', '', '2019-06-20 15:06:23');

-- --------------------------------------------------------

--
-- Структура таблицы `record`
--

CREATE TABLE `record` (
  `id` int(11) NOT NULL,
  `imageFile` text,
  `title` varchar(255) DEFAULT NULL,
  `anons` text,
  `slug` text,
  `description` text,
  `infoblock_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `text_link` text,
  `title_file` varchar(255) DEFAULT NULL,
  `allFile` text,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `record`
--

INSERT INTO `record` (`id`, `imageFile`, `title`, `anons`, `slug`, `description`, `infoblock_id`, `category_id`, `link`, `text_link`, `title_file`, `allFile`, `created_at`) VALUES
(1, '1561551923_N9nVLP.jpg', 'Основные сведения', NULL, 'Osnovnye_svedeniya', '<p>Основные сведения&nbsp;Основные сведения&nbsp;<strong>Основные </strong>сведения&nbsp;Основные сведения</p>\r\n', 2, 1, '', '', '', NULL, '2019-06-26 12:06:23');

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
(1, 'sun', 'logo', '1644578558_n83lUL.png', '2019-06-11 15:13:58', '2022-02-11 11:02:38', 1, 1),
(2, 'sun', 'siteName', 'Диваника', '2019-06-11 15:13:58', '2022-02-11 11:02:38', 1, 1),
(3, 'sun', 'siteDescription', 'Диваны в Краснодарском крае', '2019-06-11 15:13:58', '2022-02-11 11:02:38', 1, 1),
(4, 'sun', 'siteKeyWords', 'Диваны, Диваны недорго, купить Диваны, Диваны Краснодар', '2019-06-11 15:13:58', '2022-02-11 11:02:38', 1, 1),
(5, 'sun', 'email', '', '2019-06-11 15:13:58', '2022-02-11 11:02:38', 1, 1),
(6, 'sun', 'defaultLanguage', 'ru', '2019-06-11 15:13:58', '2022-02-11 11:02:38', 1, 1),
(7, 'sun', 'availableLanguages', 'ru,en', '2019-06-11 15:13:58', '2022-02-11 11:02:39', 1, 1),
(8, 'sun', 'allowedExtensions', 'jpg,png,svg', '2019-06-11 15:13:58', '2022-02-11 11:02:39', 1, 1),
(9, 'sun', 'defaultImage', '1573287896_s43Y7s.xlsx', '2019-06-11 15:13:58', '2022-02-11 11:02:39', 1, 1),
(10, 'sun', 'indexation', '2', '2019-06-11 15:13:58', '2022-02-11 11:02:39', 1, 1),
(11, 'sun', 'typeSite', '3', '2019-06-11 15:13:58', '2022-02-11 11:02:39', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `description` text,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `slider`
--

INSERT INTO `slider` (`id`, `name`, `code`, `description`, `status`) VALUES
(1, 'Слайдер на главной', 'index-slider', 'Основной слайдер сайта, расположенный сверху под шапкой сайта.', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `slideritem`
--

CREATE TABLE `slideritem` (
  `id` int(11) NOT NULL,
  `slider_id` int(11) DEFAULT NULL,
  `producer_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `imageFile` text,
  `allFile` text,
  `description` text,
  `href` varchar(255) DEFAULT NULL,
  `sort` text,
  `status` text,
  `background` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `slideritem`
--

INSERT INTO `slideritem` (`id`, `slider_id`, `producer_id`, `title`, `imageFile`, `allFile`, `description`, `href`, `sort`, `status`, `background`) VALUES
(1, 1, NULL, '<b>Дарим до 10% скидку</b><br> на все диваны', '1644579493_R1oV3i.png', 'img1.png', '<p><br />\r\nПерейти к покупкам</p>\r\n', '/sale', '1', '1', ''),
(10, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL),
(12, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL),
(13, 2, 6, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL),
(14, 2, 5, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL),
(15, NULL, NULL, 'Продукция для гостиниц и отелей', NULL, 'Мыло_картон_20г-removebg-preview.png,Мыло_картон-removebg-preview.png,IMG_4364_1000x1000-removebg-preview.png,IMG_4344_1000x1000-removebg-preview (1).png,IMG_4351_1000x1000-removebg-preview.png,IMG_4367_1000x1000-removebg-preview.png,IMG_4354_1000x1000-removebg-preview.png,IMG_4344_1000x1000-removebg-preview.png', '', '', '', '1', '#DDE7E9'),
(16, NULL, NULL, 'Продукция для гостиниц и отелей', NULL, 'Мыло_картон_20г-removebg-preview.png,Мыло_картон-removebg-preview.png,IMG_4364_1000x1000-removebg-preview.png,IMG_4344_1000x1000-removebg-preview (1).png,IMG_4351_1000x1000-removebg-preview.png,IMG_4367_1000x1000-removebg-preview.png,IMG_4354_1000x1000-removebg-preview.png,IMG_4344_1000x1000-removebg-preview.png', '', '', '4', '1', '#DDE7E9'),
(17, NULL, NULL, 'Тест тест слайд тест', NULL, 'slider-1.png,slider-2.png,slider-3.png,slider-4.png,slider-5.png,slider-6.png,slider-7.png,slider-8.png', '', '', '4', '1', 'red'),
(18, NULL, NULL, 'Тест тест слайд тест', NULL, 'slider-1.png,slider-2.png,slider-3.png,slider-4.png,slider-5.png,slider-6.png,slider-7.png,slider-8.png', '', '', '4', '1', 'red'),
(19, 1, NULL, '<b>Дарим до 20% скидку</b><br> на все кровати', '1644579800_VP9jUU.png', NULL, '<p><br />\r\nПерейти к покупкам</p>\r\n', '/store', '', '1', '');

-- --------------------------------------------------------

--
-- Структура таблицы `staticpage`
--

CREATE TABLE `staticpage` (
  `id` int(11) NOT NULL,
  `title_short` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text,
  `imageFile` text,
  `allFile` text,
  `meta_title` text,
  `meta_keywords` text,
  `meta_description` text,
  `status` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `infoblock_id` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `staticpage`
--

INSERT INTO `staticpage` (`id`, `title_short`, `title`, `slug`, `description`, `imageFile`, `allFile`, `meta_title`, `meta_keywords`, `meta_description`, `status`, `parent_id`, `infoblock_id`, `create_time`, `update_time`, `user_id`) VALUES
(1, 'Главная', 'Главная страница сайта', '', '<p>Описание сайта всякие&nbsp;штуки интересные.</p>\r\n', '1560424823_g51EwK.jpg', 'news1-img1.jpg,news1-img8.jpg,news1-img9.jpg', 'Главная страница сайта1', 'Сайт, yii2, главная страница', 'Интересный ресурс информационного характера.', '1', NULL, NULL, NULL, '2019-11-08 21:11:52', NULL),
(5, 'Акции', 'Акции и распродажа', 'sale', '<p>Скидки на сертифицированную продукцию.</p>\r\n', '1563279774_PWCXaB.jpg', 'in-banner-1.jpg', '', '', '', '1', NULL, NULL, '2019-07-16 12:07:54', '2019-10-22 19:10:42', NULL),
(15, 'error', '404', 'error', '<p>Страница не найдена<br />\r\nНичего страшного.</p>\r\n', '1564741245_XA3pVe.png', NULL, '', '', '', '1', NULL, NULL, '2019-08-02 10:08:45', '2019-08-02 10:08:18', NULL),
(18, 'Политика конфиденциальности', 'Политика конфиденциальности', 'confidentiality', '<p>Оптовый склад декоративных тканей&nbsp;&laquo;Saita fabric&raquo; соблюдает все меры по защите полученных персональных данных субъекта от уничтожения, искажения или разглашения.&nbsp;</p>\r\n\r\n<p><br />\r\nНастоящим, свободно, своей волей и в своем интересе даю согласие&nbsp;Оптовый склад декоративных тканей&nbsp;&laquo;Saita fabric&raquo;, на автоматизированную и неавтоматизированную обработку своих персональных данных, в соответствии с Федеральным законом от 27.07.2006 № 152-ФЗ &laquo;О персональных данных&raquo;, включая: сбор, систематизацию, накопление, хранение, уточнение (обновление, изменение), использование, распространение (в том числе передачу), обезличивание, блокирование, уничтожение.&nbsp;</p>\r\n\r\n<p><br />\r\nУказанные мною персональные данные предоставляются в целях анализа покупательского поведения и улучшения качества предоставляемых&nbsp;Оптовым складом декоративных тканей&nbsp;&laquo;Saita fabric&raquo;&nbsp;товаров и услуг, а также предоставления мне информации о товарах и услугах&nbsp;Оптового&nbsp;склада декоративных тканей&nbsp;&laquo;Saita fbric&raquo;, информации коммерческого и информационного характера (в том числе о специальных предложениях и акциях&nbsp;Оптового склада декоративных тканей&nbsp;&laquo;Твид&raquo;) через различные каналы связи, в том числе по почте, смс, электронной почте, телефону, если субъект персональных данных изъявит желание на получение подобной информации соответствующими средствами связи.&nbsp;<br />\r\nПомимо &laquo;Saita fabric&raquo;, доступ к своим персональным данным имеют сами субъекты; лица, осуществляющие поддержку служб и сервисов &laquo;Saita fabric&raquo;, в необходимом для осуществления такой поддержки объеме; иные лица, права и обязанности которых по доступу к соответствующей информации установлены законодательством РФ.</p>\r\n\r\n<p><br />\r\nОптовый склад декоративных тканей&nbsp;&laquo;Saita fabric&raquo;&nbsp;гарантирует соблюдение следующих прав субъекта персональных данных: право на получение сведений о том, какие персональные данные субъекта персональных данных хранятся у &laquo;Saita fabric&raquo;; право на удаление, уточнение или исправление хранящихся у &laquo;Saita fabrik&raquo; персональных данных; иные права, установленные действующим законодательством РФ.&nbsp;<br />\r\nОптовый склад декоративных тканей&nbsp;&laquo;Saita fabric&raquo;&nbsp;обязуется немедленно прекратить обработку персональных данных после получения соответствующего требования субъекта персональных данных, оформленного в письменной форме, в офисе &laquo;Saita fabric&raquo;.&nbsp;</p>\r\n\r\n<p><br />\r\n<span style=\"color:rgb(44, 44, 44); font-family:open sans,sans-serif; font-size:16px\">Согласие вступает в силу с момента моего перехода на сайт&nbsp;</span><a href=\"http://www.tweedcloth.ru/\" style=\"box-sizing: border-box; color: rgb(108, 187, 50); font-family: &quot;Open Sans&quot;, sans-serif; font-size: 16px;\">www.tweedcloth.ru</a><span style=\"color:rgb(44, 44, 44); font-family:open sans,sans-serif; font-size:16px\">&nbsp;и действует в течение срока, установленных действующим законодательством Российской Федерации.&nbsp;</span><br />\r\n<span style=\"color:rgb(44, 44, 44); font-family:open sans,sans-serif; font-size:16px\">Согласие может быть отозвано мной в любой момент путем письменного обращения в адрес&nbsp;Оптового&nbsp;склада декоративных тканей&nbsp;&laquo;Saita fabric&raquo;.</span></p>\r\n', NULL, NULL, '', '', '', '1', NULL, NULL, '2019-08-14 07:08:20', '2019-11-08 21:11:30', NULL),
(19, 'Контакты', 'Контакты', 'contact', '<div style=\"color: rgb(0, 0, 0); font-family: Roboto; background-color: rgb(245, 245, 245);\">\r\n<p><strong>Адрес: г. Белореченск</strong><br />\r\n<strong>Тел.:</strong>&nbsp;<strong>+7 (989) 213-13-66</strong><br />\r\n<strong>Факс:</strong>&nbsp;<strong>+7 (989) 213-13-66</strong></p>\r\n</div>\r\n', NULL, NULL, '', '', '', '1', NULL, NULL, '2020-02-15 14:02:40', '2022-02-11 12:02:36', NULL),
(20, 'О магазине', 'О магазине', 'about', '<p><strong>Мы являемся одними из крупнейших производителей мебели в Краснодарском&nbsp;крае.</strong></p>\r\n\r\n<p>Сегодня наш магазин&nbsp;&mdash; это:</p>\r\n\r\n<ul>\r\n	<li>Команда профессионалов;</li>\r\n	<li>Вся продукция по выгодной цене от производителя;</li>\r\n	<li>Качественная мебель для решения задач в вашем интеръере.</li>\r\n</ul>\r\n\r\n<blockquote>\r\n<p>Мы гордимся нашими клиентами, собственными ресурсами, мебелью, которую продаем и обслуживаем.&nbsp;Развиваясь сами, мы создаем новые возможности для роста наших клиентов.&nbsp;</p>\r\n</blockquote>\r\n\r\n<ul>\r\n	<li>Собственная команда сборщиков и проектировщиков&nbsp; для создания высококлассных систем вашего дома или бизнеса.</li>\r\n	<li>Сотрудничаем уже на начальной стадии проекта.</li>\r\n	<li>В пояснительной записке выдаются все характеристики необходимые для грамотного составления технического задания в проектную организацию для выполнения проекта будущего объекта или реконструкции уже существующего.</li>\r\n</ul>\r\n', '1589716710_ks7rHm.png', NULL, 'Коротко о Форклифт, деятельность, достижения, отзывы клиентов', 'Коротко о Форклифт, деятельность, достижения, отзывы клиентов', 'Коротко о Форклифт, деятельность, достижения, отзывы клиентов, варианты сотрудничества', '1', NULL, NULL, '2020-02-15 14:02:10', '2022-02-11 11:02:16', NULL),
(21, 'Доставка и оплата', 'Доставка и оплата', 'delivery', '', NULL, NULL, 'Купить погрузчик', 'Купить погрузчик, погрузчики дешево, купить погрузчик в Москве', '', '1', NULL, NULL, '2020-03-24 14:03:25', '2020-05-17 11:05:40', NULL),
(22, 'Производители', 'Производители', 'store/producer', '', NULL, NULL, '', '', '', '1', NULL, NULL, '2020-05-30 11:05:22', '2020-08-02 07:08:03', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `store_attribute`
--

CREATE TABLE `store_attribute` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `sort` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text,
  `group_id` int(11) DEFAULT NULL,
  `param_icon` varchar(100) DEFAULT NULL,
  `imageFile` varchar(100) DEFAULT NULL,
  `price` varchar(100) DEFAULT NULL,
  `discount` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `store_attribute`
--

INSERT INTO `store_attribute` (`id`, `name`, `title`, `type`, `sort`, `slug`, `description`, `group_id`, `param_icon`, `imageFile`, `price`, `discount`) VALUES
(1136, NULL, 'Дерево, антивандальная ткань, ткань, металл хромированный, наполнитель ППУ', NULL, NULL, NULL, NULL, 304, NULL, NULL, NULL, NULL),
(1137, NULL, '12', NULL, NULL, NULL, NULL, 305, NULL, NULL, NULL, NULL),
(1138, NULL, '2.0', NULL, NULL, NULL, NULL, 306, NULL, NULL, NULL, NULL),
(1139, NULL, '0.8-1.4', NULL, NULL, NULL, NULL, 307, NULL, NULL, NULL, NULL),
(1140, NULL, 'Синий, светлый бежевый', NULL, NULL, NULL, NULL, 308, NULL, NULL, NULL, NULL),
(1141, NULL, 'Россия', NULL, NULL, NULL, NULL, 309, NULL, NULL, NULL, NULL),
(1142, NULL, 'Дерево, ткань, наполнитель ППУ', NULL, NULL, NULL, NULL, 304, NULL, NULL, NULL, NULL),
(1143, NULL, '2.3', NULL, NULL, NULL, NULL, 306, NULL, NULL, NULL, NULL),
(1144, NULL, '1.4', NULL, NULL, NULL, NULL, 307, NULL, NULL, NULL, NULL),
(1145, NULL, 'Бежевый', NULL, NULL, NULL, NULL, 308, NULL, NULL, NULL, NULL),
(1146, NULL, 'Бежевый, коричневый', NULL, NULL, NULL, NULL, 308, NULL, NULL, NULL, NULL),
(1147, NULL, 'Фиолетовый', NULL, NULL, NULL, NULL, 308, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `store_attribute_group`
--

CREATE TABLE `store_attribute_group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `imageFile` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `store_attribute_group`
--

INSERT INTO `store_attribute_group` (`id`, `name`, `slug`, `position`, `product_id`, `imageFile`) VALUES
(304, 'Материал', 'material', NULL, 6, NULL),
(305, 'Гарантия, мес.', 'life', NULL, 6, NULL),
(306, 'Длина, мм.', 'length', NULL, 6, NULL),
(307, 'Глубина', 'depth', NULL, 6, NULL),
(308, 'Цвет', 'color', NULL, 6, NULL),
(309, 'Страна призводитель', 'country', NULL, 6, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `store_attribute_value`
--

CREATE TABLE `store_attribute_value` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `attribute_id` int(11) DEFAULT NULL,
  `number_value` varchar(255) DEFAULT NULL,
  `string_value` varchar(255) DEFAULT NULL,
  `text_value` text,
  `option_value` int(11) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `store_category`
--

CREATE TABLE `store_category` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `imageFile` text,
  `short_description` text,
  `description` text,
  `meta_title` text,
  `meta_description` text,
  `meta_keywords` text,
  `status` varchar(255) DEFAULT NULL,
  `sort` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `store_category`
--

INSERT INTO `store_category` (`id`, `parent_id`, `title`, `slug`, `imageFile`, `short_description`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `sort`, `type`) VALUES
(6, 0, 'Диваны', 'Divany', '1644581721_BAaVBS.png', '', '', '', '', '', '1', '', '1'),
(9, 0, 'Кровати', 'Krovati', '1644584727_N-M5UA.png', '', '', '', '', '', '1', '', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `store_order`
--

CREATE TABLE `store_order` (
  `id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `sum` float DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `store_order`
--

INSERT INTO `store_order` (`id`, `created_at`, `updated_at`, `qty`, `sum`, `status`, `name`, `email`, `phone`, `address`) VALUES
(1, '2020-11-16 17:38:56', '2020-11-16 17:38:56', 8, 208, 0, 'qwerty', '', '111111111111', ''),
(2, '2020-11-16 17:53:03', '2020-11-16 17:53:03', 10, 302, 0, 'qqqqqq', '', '222222222222', ''),
(3, '2020-11-16 17:53:40', '2020-11-16 17:53:40', 10, 302, 0, 'qqqqqq', '', '222222222222', ''),
(4, '2020-11-16 17:54:12', '2020-11-16 17:54:12', 10, 302, 0, 'wwwwwwwww', '', '33333333333', ''),
(5, '2020-11-16 17:56:06', '2020-11-16 17:56:06', 10, 302, 0, 'wwwwwwwww', '', '33333333333', ''),
(6, '2020-11-21 00:04:35', '2020-11-21 00:04:35', 4, 193, 0, 'Денис', '', '9676608822', '');

-- --------------------------------------------------------

--
-- Структура таблицы `store_order_item`
--

CREATE TABLE `store_order_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `qty_item` int(11) DEFAULT NULL,
  `sum_item` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `store_order_item`
--

INSERT INTO `store_order_item` (`id`, `order_id`, `product_id`, `name`, `price`, `qty_item`, `sum_item`) VALUES
(1, 5, 1270, NULL, 26, 8, 208),
(2, 5, 1272, NULL, 55, 1, 55),
(3, 5, 1271, NULL, 39, 1, 39),
(4, 6, 1271, NULL, 39, 1, 39),
(5, 6, 1272, NULL, 55, 3, 165);

-- --------------------------------------------------------

--
-- Структура таблицы `store_producer`
--

CREATE TABLE `store_producer` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `anons` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `imageFile` text,
  `allFile` text,
  `short_description` text,
  `description` text,
  `status` varchar(255) DEFAULT NULL,
  `sort` varchar(255) DEFAULT NULL,
  `meta_title` text,
  `meta_keywords` text,
  `meta_description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `store_producer`
--

INSERT INTO `store_producer` (`id`, `title`, `anons`, `slug`, `imageFile`, `allFile`, `short_description`, `description`, `status`, `sort`, `meta_title`, `meta_keywords`, `meta_description`) VALUES
(7, 'IEK', '', 'IEK', '1590827764_yyRJd9.jpg', NULL, '', '', '1', '', '', '', ''),
(8, 'JAZZWAY', '', 'JAZZWAY', '1590828495_NjOKha.jpg', NULL, '', '', '1', '', '', '', ''),
(9, 'Schneider Electric', '', 'Schneider_Electric', '1590829119_Tk5KY7.jpg', NULL, '', '', '1', '', '', '', ''),
(10, 'DKC', '', 'DKC', '1590829334_Ax8S6W.jpg', NULL, '', '', '1', '', '', '', ''),
(11, 'Ledvance/Osram', '', 'Ledvance_Osram', '1590833273_F95AJr.jpg', NULL, '', '', '1', '', '', '', ''),
(12, 'ЭРА S3 - Энергия света', '', 'ERA_S3_-_Energiya_sveta', '1590833295_xiR_Jb.jpg', NULL, '', '', '1', '', '', '', ''),
(13, 'КЭАЗ', '', 'KEAZ', '1590833325_iXX2fw.jpg', NULL, '', '', '1', '', '', '', ''),
(14, 'WAGO', '', 'WAGO', '1590833348_vklCe1.jpg', NULL, '', '', '1', '', '', '', ''),
(15, 'Philips (Signify)', '', 'Philips_(Signify)', '1590833365_wNvY9Y.jpg', NULL, '', '', '1', '', '', '', ''),
(16, 'VARTON', '', 'VARTON', '1590833392_LAz6dh.jpg', NULL, '', '', '1', '', '', '', ''),
(17, 'Ostec', '', 'Ostec', '1590833416_uVB71Y.jpg', NULL, '', '', '1', '', '', '', ''),
(18, 'Металлист', '', 'Metallist', '1590841175_AZyQqQ.jpg', NULL, '', '', '1', '', '', '', ''),
(19, 'ABB', '', 'ABB', '1590842544_e3G7yY.jpg', NULL, '', '', '1', '', '', '', ''),
(20, 'Legrand', '', 'Legrand', '1590841251_HTUEr-.jpg', NULL, '', '', '1', '', '', '', ''),
(21, 'TDM', '', 'TDM', '1590842873_D0wa-E.jpg', NULL, '', '', '1', '', '', '', ''),
(22, 'КВТ', '', 'KVT', '1590898254_pU0d7-.jpg', NULL, '', '', '1', '', '', '', ''),
(23, 'DEKraft', '', 'DEKraft', '1590842050_YjKXHF.jpg', NULL, '', '', '1', '', '', '', ''),
(24, 'Энергомера', '', 'Energomera', '1590842081_WZ0mN_.png', NULL, '', '', '1', '', '', '', ''),
(25, 'Lezard', '', 'Lezard', '1590842101_98v6y1.jpg', NULL, '', '', '1', '', '', '', ''),
(26, 'EKF', '', 'EKF', '1590842223_BS1_Z4.jpg', NULL, '', '', '1', '', '', '', ''),
(27, 'Меркурий', '', 'Merkurij', '1590893856_GcoutD.jpg', NULL, '', '', '1', '', '', '', ''),
(28, 'Elektrostandard™', '', 'Elektrostandard™', '1590894579_30QmdY.jpg', NULL, '', '', '1', '', '', '', ''),
(29, 'Tech-Krep', '', 'Tech-Krep', '1590894738_yrEw5Y.jpg', NULL, '', '', '1', '', '', '', ''),
(30, 'HAUPA', '', 'HAUPA', '1590894932_SK_tdP.jpg', NULL, '', '', '1', '', '', '', ''),
(31, 'PlastElectro', '', 'PlastElectro', '1590895161_Nvi6uJ.jpg', NULL, '', '', '1', '', '', '', ''),
(32, 'REXANT', '', 'REXANT', '1590895314_-uFoqO.jpg', NULL, '', '', '1', '', '', '', ''),
(33, 'ЛИСМА', '', 'LISMA', '1590895458_px248n.jpg', NULL, '', '', '1', '', '', '', ''),
(34, 'Евроавтоматика F&F (ФиФ)', '', 'Evroavtomatika_F&F_(FiF)', '1590895635_v_3xab.jpg', NULL, '', '', '1', '', '', '', ''),
(35, 'UNIVersal', '', 'UNIVersal', '1590895750_LOo-Xu.jpg', NULL, '', '', '1', '', '', '', ''),
(36, 'Werkel', '', 'Werkel', '1590896115_Anthl5.jpg', NULL, '', '', '1', '', '', '', ''),
(37, 'Kopos', '', 'Kopos', '1590896529_7lPP7u.jpg', NULL, '', '', '1', '', '', '', ''),
(38, 'Космос', '', 'Kosmos', '1590896764_1N3uW9.jpg', NULL, '', '', '1', '', '', '', ''),
(39, 'Navigator', '', 'Navigator', '1590896946_OePyNU.jpg', NULL, '', '', '1', '', '', '', ''),
(40, 'Folsen', '', 'Folsen', '1590897123_EpQ_xJ.jpg', NULL, '', '', '1', '', '', '', ''),
(41, 'Tplast', '', 'Tplast', '1590897241_vsfBMY.jpg', NULL, '', '', '1', '', '', '', ''),
(42, 'Energizer', '', 'Energizer', '1590897636_QO3Qyl.jpg', NULL, '', '', '1', '', '', '', ''),
(43, 'Gauss', '', 'Gauss', '1590898115_wQQ9CC.jpg', NULL, '', '', '1', '', '', '', ''),
(44, 'Makel', '', 'Makel', '1603875897_TZzbOa.png', NULL, '', '', '1', '', '', '', ''),
(45, 'Конкорд', '', 'Konkord', '1603876087_qXBGdI.jpg', NULL, '', '', '1', '', '', '', ''),
(46, 'Союз', '', 'Soyuz', NULL, NULL, '', '', '1', '', '', '', ''),
(47, ' Томский ЭЛЗ', '', '_Tomskij_ELZ', '1603874775_x6Pqf4.png', NULL, '', '', '1', '', '', '', ''),
(48, 'КЭЛЗ', '', 'KELZ', '1603947379_lJuN-x.jpg', NULL, '', '', '1', '', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `store_producer_item`
--

CREATE TABLE `store_producer_item` (
  `id` int(11) NOT NULL,
  `producer_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `anons` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `imageFile` text,
  `description` text,
  `type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `store_producer_item`
--

INSERT INTO `store_producer_item` (`id`, `producer_id`, `title`, `anons`, `slug`, `imageFile`, `description`, `type`) VALUES
(1, 7, 'Серия 1', 'Минималистичная серия', 'Seriya_1', '1563275572_0oSMA3.png', '<p>Минималистичная серия</p>\r\n', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `store_product`
--

CREATE TABLE `store_product` (
  `id` int(11) NOT NULL,
  `producer_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `discount_price` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `short_description` text,
  `description` text,
  `status` varchar(255) DEFAULT NULL,
  `imageFile` text,
  `allFile` text,
  `meta_title` text,
  `meta_keywords` text,
  `meta_description` text,
  `parent_id` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `infoblock_id` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nominal` varchar(255) DEFAULT NULL,
  `current` varchar(255) DEFAULT NULL,
  `life` varchar(255) DEFAULT NULL,
  `energy` varchar(255) DEFAULT NULL,
  `efficiency` varchar(255) DEFAULT NULL,
  `material` varchar(255) DEFAULT NULL,
  `width` varchar(255) DEFAULT NULL,
  `length` varchar(255) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `all_stock` int(11) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `depth` varchar(255) DEFAULT NULL,
  `country` varchar(250) DEFAULT NULL,
  `series` varchar(250) DEFAULT NULL,
  `popular` int(11) DEFAULT NULL,
  `recomented` int(11) DEFAULT NULL,
  `new` int(11) DEFAULT NULL,
  `sp` varchar(255) DEFAULT NULL,
  `ct` varchar(255) DEFAULT NULL,
  `usp` varchar(255) DEFAULT NULL,
  `ck` varchar(255) DEFAULT NULL,
  `mk` varchar(255) DEFAULT NULL,
  `tm` varchar(255) DEFAULT NULL,
  `sz` varchar(255) DEFAULT NULL,
  `cz` varchar(255) DEFAULT NULL,
  `ss` varchar(255) DEFAULT NULL,
  `td` varchar(255) DEFAULT NULL,
  `uo` varchar(255) DEFAULT NULL,
  `frequency` varchar(255) DEFAULT NULL,
  `ks` varchar(255) DEFAULT NULL,
  `ksh` varchar(255) DEFAULT NULL,
  `fshp` varchar(255) DEFAULT NULL,
  `armored` varchar(255) DEFAULT NULL,
  `co` varchar(255) DEFAULT NULL,
  `mish` varchar(255) DEFAULT NULL,
  `mo` varchar(255) DEFAULT NULL,
  `mshp` varchar(255) DEFAULT NULL,
  `nsp` varchar(255) DEFAULT NULL,
  `ne` varchar(255) DEFAULT NULL,
  `nnu` varchar(255) DEFAULT NULL,
  `execution` varchar(255) DEFAULT NULL,
  `km` varchar(255) DEFAULT NULL,
  `kp` varchar(255) DEFAULT NULL,
  `hs` varchar(255) DEFAULT NULL,
  `tek` varchar(255) DEFAULT NULL,
  `agl` varchar(255) DEFAULT NULL,
  `aln` varchar(255) DEFAULT NULL,
  `rdd` varchar(255) DEFAULT NULL,
  `ovu` varchar(255) DEFAULT NULL,
  `maxrc` varchar(255) DEFAULT NULL,
  `minrc` varchar(255) DEFAULT NULL,
  `pso` varchar(255) DEFAULT NULL,
  `uog` varchar(255) DEFAULT NULL,
  `uov` varchar(255) DEFAULT NULL,
  `drt` varchar(150) DEFAULT NULL,
  `mdoo` varchar(150) DEFAULT NULL,
  `ndmm` varchar(150) DEFAULT NULL,
  `stk` varchar(150) DEFAULT NULL,
  `ps1` varchar(150) DEFAULT NULL,
  `tk1` varchar(150) DEFAULT NULL,
  `mt1` varchar(150) DEFAULT NULL,
  `ntok` varchar(100) DEFAULT NULL,
  `dssh` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `store_product`
--

INSERT INTO `store_product` (`id`, `producer_id`, `type`, `category_id`, `sku`, `title`, `slug`, `price`, `discount_price`, `discount`, `short_description`, `description`, `status`, `imageFile`, `allFile`, `meta_title`, `meta_keywords`, `meta_description`, `parent_id`, `position`, `infoblock_id`, `create_time`, `update_time`, `user_id`, `nominal`, `current`, `life`, `energy`, `efficiency`, `material`, `width`, `length`, `height`, `stock`, `all_stock`, `color`, `depth`, `country`, `series`, `popular`, `recomented`, `new`, `sp`, `ct`, `usp`, `ck`, `mk`, `tm`, `sz`, `cz`, `ss`, `td`, `uo`, `frequency`, `ks`, `ksh`, `fshp`, `armored`, `co`, `mish`, `mo`, `mshp`, `nsp`, `ne`, `nnu`, `execution`, `km`, `kp`, `hs`, `tek`, `agl`, `aln`, `rdd`, `ovu`, `maxrc`, `minrc`, `pso`, `uog`, `uov`, `drt`, `mdoo`, `ndmm`, `stk`, `ps1`, `tk1`, `mt1`, `ntok`, `dssh`) VALUES
(1617, 0, NULL, 6, '', 'Диван Ричард', 'Divan_Richard', 10800, '9800', NULL, '', '<p>Диван еврокнижка - &quot;Ричард&quot; с подушками в антивандальной ткани и хромированными ножками</p>\r\n', '1', '1644582429_L1juKY.jpg', NULL, '', '', '', NULL, '', NULL, '2022-02-11 12:02:20', NULL, NULL, '', '', '12', '', '', 'Дерево, антивандальная ткань, ткань, металл хромированный, наполнитель ППУ', '', '2.0', '1.2', 1, 1, 'Синий, светлый бежевый', '0.8-1.4', 'Россия', '', 1, 1, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(1618, 0, NULL, 6, '', 'Диван Аполон', 'Divan_Apolon', 18000, '17000', NULL, '', '', '1', '1644582802_tKyKC0.jpg', NULL, '', '', '', NULL, '', NULL, '2022-02-11 12:02:22', NULL, NULL, '', '', '', '', '', 'Дерево, ткань, наполнитель ППУ', '', '2.3', '1.2', 1, 1, 'Бежевый', '1.4', 'Россия', '', 1, 1, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(1619, 0, NULL, 6, '', 'Диван Ричард Эконом', 'Divan_Richard_Ekonom', 8800, '7800', NULL, 'Диван еврокнижка - \"Ричард\" с подушками в обычной ткани и простыми ножками', '', '1', '1644584025_pc88DL.jpg', '4343-1000x1000.jpg,45645-1000x1000.jpg', '', '', '', NULL, '', NULL, '2022-02-11 13:02:15', NULL, NULL, '', '', '12', '', '', '', '', '2.0', '1.2', 0, 0, '', '0.8-1.4', 'Россия', '', 1, 0, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(1620, 0, NULL, 6, '', 'Диван Ричард2', 'Divan_Richard2', 10800, '9800', NULL, '', '<p>Диван еврокнижка - &quot;Ричард&quot; с подушками в антивандальной ткани и хромированными ножками</p>\r\n', '1', '1644584455_aivVtW.jpeg', NULL, '', '', '', NULL, '', NULL, '2022-02-11 13:02:55', NULL, NULL, '', '', '12', '', '', 'Дерево, антивандальная ткань, ткань, металл хромированный, наполнитель ППУ', '', '2.0', '1.2', 1, 1, 'Бежевый, коричневый', '0.8-1.4', 'Россия', '', 1, 1, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(1621, 0, NULL, 6, '', 'Диван Аполон2', 'Divan_Apolon2', 18000, '17000', NULL, '', '', '1', '1644582802_tKyKC0.jpg', NULL, '', '', '', NULL, '', NULL, '2022-02-11 12:02:22', NULL, NULL, '', '', '', '', '', 'Дерево, ткань, наполнитель ППУ', '', '2.3', '1.2', 1, 1, 'Бежевый', '1.4', 'Россия', '', 1, 1, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(1622, 0, NULL, 6, '', 'Диван Ричард Эконом2', 'Divan_Richard_Ekonom2', 8800, '', NULL, 'Диван еврокнижка - \"Ричард\" с подушками в обычной ткани и простыми ножками', '', '1', '1644584474_r7ig0m.jpg', 'divan_new5001-1000x1000.jpg', '', '', '', NULL, '', NULL, '2022-02-11 13:02:58', NULL, NULL, '', '', '12', '', '', 'Дерево, ткань, наполнитель ППУ', '', '2.0', '1.2', 0, 0, 'Фиолетовый', '0.8-1.4', 'Россия', '', 1, 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `store_product_link`
--

CREATE TABLE `store_product_link` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `linked_product_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `store_product_link_type`
--

CREATE TABLE `store_product_link_type` (
  `id` int(11) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `store_product_link_type`
--

INSERT INTO `store_product_link_type` (`id`, `code`, `title`) VALUES
(1, 'similar', 'Похожие'),
(2, 'related', 'Сопутствующие');

-- --------------------------------------------------------

--
-- Структура таблицы `store_settings`
--

CREATE TABLE `store_settings` (
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
-- Дамп данных таблицы `store_settings`
--

INSERT INTO `store_settings` (`id`, `module_id`, `param_name`, `param_value`, `create_time`, `update_time`, `user_id`, `type`) VALUES
(1, 'store', 'renderIndex', '1', '2019-06-28 19:24:25', NULL, 1, 1),
(2, 'store', 'currency', 'RUB', '2019-06-28 19:24:25', NULL, 1, 1),
(3, 'store', 'productCount', '10', '2019-06-28 19:24:25', NULL, 1, 1),
(4, 'store', 'productSort', 'create_time', '2019-06-28 19:24:25', NULL, 1, 1),
(5, 'store', 'routeSort', '1', '2019-06-28 19:24:25', NULL, 1, 1),
(6, 'store', 'storeTitle', 'Солнечный стиль вашего магазина на yii2!', '2019-06-28 19:24:25', NULL, 1, 1),
(7, 'store', 'storeDescription', 'Солнечный стиль вашего сайта на yii2!', '2019-06-28 19:24:25', NULL, 1, 1),
(8, 'store', 'siteKeyWords', 'магазин, yii2', '2019-06-28 19:24:25', NULL, 1, 1),
(9, 'store', 'defaultImage', 'no_image.svg', '2019-06-28 19:24:25', NULL, 1, 1);

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
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'admin', 'coGVNRRAANyP9AjfC0cko4GNsE1I4VqT', '$2y$13$JexDb9/7fF.fKYJ7qC.R7Oxz31sY73pQxAPljyM9/vmy3Nyh5YSEq', NULL, 'shedevrxxx@inbox.ru', 10, 1559920361, 1559920361, NULL),
(5, 'Shedevr', '1lzDydJceNOCjvXE-syAQwodTe5V8CNg', '$2y$13$Q2jj1Wi8qT9NmXI9deSS7eIiPdmnf3GaN6UQ/R66NozMUsJVf.vui', NULL, 'shedevrxxx@gmail.com', 10, 1573226188, 1573226229, 'Qj6lIL3Xdfwa6c44WjC3ex9WMazhNK75_1573226188');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `constructform`
--
ALTER TABLE `constructform`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `constructor`
--
ALTER TABLE `constructor`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `infoblock`
--
ALTER TABLE `infoblock`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `infoblock_item`
--
ALTER TABLE `infoblock_item`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menuitem`
--
ALTER TABLE `menuitem`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pageblock`
--
ALTER TABLE `pageblock`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `slideritem`
--
ALTER TABLE `slideritem`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `staticpage`
--
ALTER TABLE `staticpage`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `store_attribute`
--
ALTER TABLE `store_attribute`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `store_attribute_group`
--
ALTER TABLE `store_attribute_group`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `store_attribute_value`
--
ALTER TABLE `store_attribute_value`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `store_category`
--
ALTER TABLE `store_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `store_order`
--
ALTER TABLE `store_order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `store_order_item`
--
ALTER TABLE `store_order_item`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `store_producer`
--
ALTER TABLE `store_producer`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `store_producer_item`
--
ALTER TABLE `store_producer_item`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `store_product`
--
ALTER TABLE `store_product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `store_product_link`
--
ALTER TABLE `store_product_link`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `store_product_link_type`
--
ALTER TABLE `store_product_link_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `store_settings`
--
ALTER TABLE `store_settings`
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
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `constructform`
--
ALTER TABLE `constructform`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `constructor`
--
ALTER TABLE `constructor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT для таблицы `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `infoblock`
--
ALTER TABLE `infoblock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `infoblock_item`
--
ALTER TABLE `infoblock_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `menuitem`
--
ALTER TABLE `menuitem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `pageblock`
--
ALTER TABLE `pageblock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `record`
--
ALTER TABLE `record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `slideritem`
--
ALTER TABLE `slideritem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `staticpage`
--
ALTER TABLE `staticpage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `store_attribute`
--
ALTER TABLE `store_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1148;

--
-- AUTO_INCREMENT для таблицы `store_attribute_group`
--
ALTER TABLE `store_attribute_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=310;

--
-- AUTO_INCREMENT для таблицы `store_attribute_value`
--
ALTER TABLE `store_attribute_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `store_category`
--
ALTER TABLE `store_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `store_order`
--
ALTER TABLE `store_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `store_order_item`
--
ALTER TABLE `store_order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `store_producer`
--
ALTER TABLE `store_producer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT для таблицы `store_producer_item`
--
ALTER TABLE `store_producer_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `store_product`
--
ALTER TABLE `store_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1623;

--
-- AUTO_INCREMENT для таблицы `store_product_link`
--
ALTER TABLE `store_product_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `store_product_link_type`
--
ALTER TABLE `store_product_link_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `store_settings`
--
ALTER TABLE `store_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
