<?php

declare(strict_types=1);

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * wgSlider module for xoops
 *
 * @copyright    2026 XOOPS Project (https://xoops.org)
 * @license      GPL 2.0 or later
 * @package      wgslider
 * @author       Goffy - wedega - Email:webmaster@wedega.com - Website:https://wedega.com
 */

require_once __DIR__ . '/common.php';

// ---------------- Admin Main ----------------
\define('_MI_WGSLIDER_NAME', 'wgSlider');
\define('_MI_WGSLIDER_DESC', 'wgSlider ist ein Modul zur Verwaltung von Diashows');
// ---------------- Admin Menu ----------------
\define('_MI_WGSLIDER_ADMENU1', 'Dashboard');
\define('_MI_WGSLIDER_ADMENU2', 'Kategorien');
\define('_MI_WGSLIDER_ADMENU3', 'Bilder');
\define('_MI_WGSLIDER_ADMENU4', 'Diashows');
\define('_MI_WGSLIDER_ADMENU5', 'Klonen');
\define('_MI_WGSLIDER_ADMENU6', 'Feedback');
\define('_MI_WGSLIDER_ABOUT', 'Über');
// ---------------- Blocks ----------------
\define('_MI_WGSLIDER_IMAGE_BLOCK_SLIDESHOW', 'Diashow');
\define('_MI_WGSLIDER_IMAGE_BLOCK_SLIDESHOW_DESC', 'Eine Diashow anzeigen');
// ---------------- Admin Nav ----------------
\define('_MI_WGSLIDER_ADMIN_PAGER', 'Admin-Seitenlimit');
\define('_MI_WGSLIDER_ADMIN_PAGER_DESC', 'Anzahl der Einträge pro Seite im Adminbereich');
// Config
\define('_MI_WGSLIDER_SIZE_MB', 'MB');
\define('_MI_WGSLIDER_MAXSIZE_IMAGE', 'Maximale Bildgröße');
\define('_MI_WGSLIDER_MAXSIZE_IMAGE_DESC', 'Definieren Sie die maximale Größe für hochzuladende Bilder');
\define('_MI_WGSLIDER_MIMETYPES_IMAGE', 'MIME-Typen für Bilder');
\define('_MI_WGSLIDER_MIMETYPES_IMAGE_DESC', 'Definieren Sie die erlaubten MIME-Typen für das Hochladen von Bildern');
\define('_MI_WGSLIDER_MAXWIDTH_IMAGE', 'Maximale Bildbreite');
\define('_MI_WGSLIDER_MAXWIDTH_IMAGE_DESC', 'Legen Sie die maximale Breite fest, auf die hochgeladene Bilder skaliert werden sollen (in Pixel)<br>0 bedeutet, dass Bilder ihre Originalgröße behalten.<br>Wenn ein Bild kleiner als der maximale Wert ist, wird es nicht vergrößert und in der Originalbreite gespeichert.');
\define('_MI_WGSLIDER_MAXHEIGHT_IMAGE', 'Maximale Bildhöhe');
\define('_MI_WGSLIDER_MAXHEIGHT_IMAGE_DESC', 'Legen Sie die maximale Höhe fest, auf die hochgeladene Bilder skaliert werden sollen (in Pixel)<br>0 bedeutet, dass Bilder ihre Originalgröße behalten.<br>Wenn ein Bild kleiner als der maximale Wert ist, wird es nicht vergrößert und in der Originalhöhe gespeichert.');
\define('_MI_WGSLIDER_MAINTAINEDBY', 'Betreut von');
\define('_MI_WGSLIDER_MAINTAINEDBY_DESC', 'URL der Support-Seite oder Community angeben');
\define('_MI_WGSLIDER_BOOKMARKS', 'Social Bookmarks');
\define('_MI_WGSLIDER_BOOKMARKS_DESC', 'Social-Bookmarks auf der Einzelseite anzeigen');
\define('_MI_WGSLIDER_SHOW_TAB_CLONE', 'Tab "Klonen" auf der Admin-Seite anzeigen');
\define('_MI_WGSLIDER_SHOW_TAB_FEEDBACK', 'Tab "Feedback" auf der Admin-Seite anzeigen');
// ---------------- End ----------------
