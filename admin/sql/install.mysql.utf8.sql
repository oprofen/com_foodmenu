
-- --------------------------------------------------------

--
-- Структура таблицы `#__foodmenu`
--

DROP TABLE IF EXISTS `#__foodmenu`;
CREATE TABLE IF NOT EXISTS `#__foodmenu` (
	`id` int(10) unsigned NOT NULL,
	`asset_id` int(10) unsigned NOT NULL DEFAULT '0',
	`title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
	`image` varchar(5120) COLLATE utf8mb4_unicode_ci NOT NULL,
	`description` varchar(6000) COLLATE utf8mb4_unicode_ci NOT NULL,
	`price` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
	`state` tinyint(3) NOT NULL DEFAULT '0',
	`catid` int(10) unsigned NOT NULL DEFAULT '0',
	`created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`created_by` int(10) unsigned NOT NULL DEFAULT '0',
	`created_by_alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
	`modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`modified_by` int(10) unsigned NOT NULL DEFAULT '0',
	`checked_out` int(10) unsigned NOT NULL DEFAULT '0',
	`checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	`ordering` int(11) NOT NULL DEFAULT '0',
	`language` char(7) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'The language code for the article.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `#__foodmenu`
--
ALTER TABLE `#__foodmenu`
ADD PRIMARY KEY (`id`),
ADD KEY `idx_checkout` (`checked_out`),
ADD KEY `idx_state` (`state`),
ADD KEY `idx_catid` (`catid`),
ADD KEY `idx_createdby` (`created_by`),
ADD KEY `idx_featured_catid` (`catid`),
ADD KEY `idx_language` (`language`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `#__foodmenu`
--
ALTER TABLE `#__foodmenu`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
