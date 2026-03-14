<?php declare(strict_types=1);
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * feedback plugin for xoops modules
 *
 * @copyright      module for xoops
 * @license         GNU GPL 2.0 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 * @since          1.0
 * @min_xoops      2.5.11
 * @author         XOOPS - Website:<https://xoops.org>
 */
$moduleDirName      = \basename(\dirname(__DIR__, 2));
$moduleDirNameUpper = \mb_strtoupper($moduleDirName);

\define('CO_' . $moduleDirNameUpper . '_' . 'FB_FORM_TITLE', 'Feedback senden');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_RECIPIENT', 'Empfänger');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_NAME', 'Name');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_NAME_PLACEHOLER', 'Bitte geben Sie Ihren Namen ein');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_SITE', 'Website');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_SITE_PLACEHOLER', 'Bitte geben Sie Ihre Website ein');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_MAIL', 'E-Mail');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_MAIL_PLACEHOLER', 'Bitte geben Sie Ihre E-Mail-Adresse ein');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_TYPE', 'Art des Feedbacks');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_TYPE_SUGGESTION', 'Vorschläge');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_TYPE_BUGS', 'Fehler');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_TYPE_TESTIMONIAL', 'Referenzen');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_TYPE_FEATURES', 'Funktionen');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_TYPE_OTHERS', 'Sonstiges');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_TYPE_CONTENT', 'Feedback-Inhalt');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_SEND_FOR', 'Feedback für Modul ');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_SEND_SUCCESS', 'Feedback erfolgreich gesendet');
\define('CO_' . $moduleDirNameUpper . '_' . 'FB_SEND_ERROR', 'Beim Senden des Feedbacks ist ein Fehler aufgetreten!');
