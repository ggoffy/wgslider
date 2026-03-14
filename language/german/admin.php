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

// ---------------- Admin Index ----------------
\define('_AM_WGSLIDER_STATISTICS', 'Statistiken');
// There are
\define('_AM_WGSLIDER_THEREARE_CATEGORIES', "Es gibt <span class='bold'>%s</span> Kategorien in der Datenbank");
\define('_AM_WGSLIDER_THEREARE_IMAGES', "Es gibt <span class='bold'>%s</span> Bilder in der Datenbank");
\define('_AM_WGSLIDER_THEREARE_SLIDESHOWS', "Es gibt <span class='bold'>%s</span> Diashows in der Datenbank");
// ---------------- Admin Files ----------------
// There aren't
\define('_AM_WGSLIDER_THEREARENT_CATEGORIES', "Es sind keine Kategorien vorhanden");
\define('_AM_WGSLIDER_THEREARENT_IMAGES', "Es sind keine Bilder vorhanden");
\define('_AM_WGSLIDER_THEREARENT_SLIDESHOWS', "Es sind keine Diashows vorhanden");
// Save/Delete
\define('_AM_WGSLIDER_FORM_OK', 'Erfolgreich gespeichert');
\define('_AM_WGSLIDER_FORM_DELETE_OK', 'Erfolgreich gelöscht');
\define('_AM_WGSLIDER_FORM_SURE_DELETE', "Möchten Sie wirklich löschen: <b><span style='color : Red;'>%s </span></b>?");
\define('_AM_WGSLIDER_FORM_SURE_RENEW', "Möchten Sie wirklich aktualisieren: <b><span style='color : Red;'>%s </span></b>?");
\define('_AM_WGSLIDER_FORM_UPLOAD_IMG', 'Neues Bild hochladen');
// Buttons
\define('_AM_WGSLIDER_ADD_CATEGORY', 'Neue Kategorie hinzufügen');
\define('_AM_WGSLIDER_ADD_IMAGE', 'Neues Bild hinzufügen');
\define('_AM_WGSLIDER_ADD_SLIDESHOW', 'Neue Diashow hinzufügen');
\define('_AM_WGSLIDER_SLIDESHOW_SHOW', 'Diashow anzeigen');
\define('_AM_WGSLIDER_SLIDESHOW_RESET', 'Alle Diashows zurücksetzen');
// Lists
\define('_AM_WGSLIDER_LIST_CATEGORY', 'Kategorienliste');
\define('_AM_WGSLIDER_LIST_IMAGE', 'Bilderliste');
\define('_AM_WGSLIDER_LIST_SLIDESHOW', 'Diashowliste');
// ---------------- Admin Classes ----------------
// Category display types
\define('_AM_WGSLIDER_DISPLAY_BLOCK', 'Als Block anzeigen');
\define('_AM_WGSLIDER_DISPLAY_KEY', 'Als Smarty-Variable anzeigen');
// Category add/edit
\define('_AM_WGSLIDER_CATEGORY_ADD', 'Kategorie hinzufügen');
\define('_AM_WGSLIDER_CATEGORY_EDIT', 'Kategorie bearbeiten');
// Elements of Category
\define('_AM_WGSLIDER_CATEGORY_ID', 'ID');
\define('_AM_WGSLIDER_CATEGORY_NAME', 'Name');
\define('_AM_WGSLIDER_CATEGORY_DISPLAY', 'Anzeige');
\define('_AM_WGSLIDER_CATEGORY_KEY', 'Name der Smarty-Variable');
\define('_AM_WGSLIDER_CATEGORY_KEY_DESCR', "Name ist nur erforderlich, wenn '" . _AM_WGSLIDER_DISPLAY_KEY . "' ausgewählt wurde.<br>Die Smarty-Variable muss in Ihrem Template eingefügt werden");
\define('_AM_WGSLIDER_CATEGORY_STATUS', 'Status');
\define('_AM_WGSLIDER_CATEGORY_MAXIMG', 'Maximale Anzahl Bilder');
\define('_AM_WGSLIDER_CATEGORY_MAXIMG_DESCR', 'Definiert die maximale Anzahl von Bildern pro Kategorie. 0 bedeutet kein Limit');
\define('_AM_WGSLIDER_CATEGORY_IMGWIDTH', 'Bildbreite');
\define('_AM_WGSLIDER_CATEGORY_IMGWIDTH_DESCR', 'Definiert die Breite der Bilder. Bilder müssen exakt diese Breite haben, um angezeigt zu werden. 0 bedeutet keine Einschränkung.');
\define('_AM_WGSLIDER_CATEGORY_IMGHEIGHT', 'Bildhöhe');
\define('_AM_WGSLIDER_CATEGORY_IMGHEIGHT_DESCR', 'Definiert die Höhe der Bilder. Bilder müssen exakt diese Höhe haben, um angezeigt zu werden. 0 bedeutet keine Einschränkung.');
\define('_AM_WGSLIDER_CATEGORY_SLIDESHOW', 'Diashow');
\define('_AM_WGSLIDER_CATEGORY_DATECREATED', 'Erstellt am');
\define('_AM_WGSLIDER_CATEGORY_SUBMITTER', 'Eingereicht von');

// Image add/edit
\define('_AM_WGSLIDER_IMAGE_ADD', 'Bild hinzufügen');
\define('_AM_WGSLIDER_IMAGE_EDIT', 'Bild bearbeiten');
// Elements of Image
\define('_AM_WGSLIDER_IMAGE_ID', 'ID');
\define('_AM_WGSLIDER_IMAGE_NAME', 'Name');
\define('_AM_WGSLIDER_IMAGE_TOOLTIP', 'Tooltip');
\define('_AM_WGSLIDER_IMAGE_REALNAME', 'Originaldateiname');
\define('_AM_WGSLIDER_IMAGE_REALNAME_UPLOADS', 'Pfad in %s :');
\define('_AM_WGSLIDER_IMAGE_PREVIEW', 'Vorschau');
\define('_AM_WGSLIDER_IMAGE_WIDTH', 'Breite');
\define('_AM_WGSLIDER_IMAGE_HEIGHT', 'Höhe');
\define('_AM_WGSLIDER_IMAGE_WEIGHT', 'Gewichtung');
\define('_AM_WGSLIDER_IMAGE_CATEGORY', 'Kategorie');
\define('_AM_WGSLIDER_IMAGE_STATUS', 'Status');
\define('_AM_WGSLIDER_IMAGE_DATECREATED', 'Erstellt am');
\define('_AM_WGSLIDER_IMAGE_SUBMITTER', 'Eingereicht von');

// Slideshow misc
\define('_AM_WGSLIDER_SLIDESHOW_DESCR_DEFAULT', 'Standard-Diashow ohne zusätzliche Anforderungen');
\define('_AM_WGSLIDER_SLIDESHOW_DESCR_BT3', 'Bootstrap3 Carousel benötigt ein Theme basierend auf Bootstrap 3');
\define('_AM_WGSLIDER_SLIDESHOW_DESCR_BT5', 'Bootstrap5 Carousel benötigt ein Theme basierend auf Bootstrap 5');
\define('_AM_WGSLIDER_SLIDESHOW_RESET_SURE', 'Möchten Sie wirklich alle Diashows zurücksetzen? Alle aktuellen Parameter-Einstellungen gehen verloren.');
\define('_AM_WGSLIDER_SLIDESHOW_RESET_OK', 'Alle Diashows wurden erfolgreich zurückgesetzt');
\define('_AM_WGSLIDER_SLIDESHOW_RESET_ERROR', 'Beim Zurücksetzen der Diashow ist ein Fehler aufgetreten');
// Slideshow add/edit
\define('_AM_WGSLIDER_SLIDESHOW_ADD', 'Diashow hinzufügen');
\define('_AM_WGSLIDER_SLIDESHOW_EDIT', 'Diashow bearbeiten');
// Elements of Slideshow
\define('_AM_WGSLIDER_SLIDESHOW_ID', 'ID');
\define('_AM_WGSLIDER_SLIDESHOW_NAME', 'Name');
\define('_AM_WGSLIDER_SLIDESHOW_DESCR', 'Beschreibung');
\define('_AM_WGSLIDER_SLIDESHOW_TPL', 'Template-Datei');
\define('_AM_WGSLIDER_SLIDESHOW_PARAMS', 'Parameter');
// General
\define('_AM_WGSLIDER_FORM_UPLOAD', 'Datei hochladen');
\define('_AM_WGSLIDER_FORM_UPLOAD_NEW', 'Neue Datei hochladen: ');
\define('_AM_WGSLIDER_FORM_UPLOAD_SIZE', 'Maximale Dateigröße: ');
\define('_AM_WGSLIDER_FORM_UPLOAD_SIZE_MB', 'MB');
\define('_AM_WGSLIDER_FORM_UPLOAD_IMG_WIDTH', 'Maximale Bildbreite: ');
\define('_AM_WGSLIDER_FORM_UPLOAD_IMG_HEIGHT', 'Maximale Bildhöhe: ');
\define('_AM_WGSLIDER_FORM_IMAGE_PATH', 'Dateien in %s :');
\define('_AM_WGSLIDER_FORM_ACTION', 'Aktion');
\define('_AM_WGSLIDER_FORM_EDIT', 'Bearbeiten');
\define('_AM_WGSLIDER_FORM_DELETE', 'Löschen');
// Status
\define('_AM_WGSLIDER_STATUS_NONE', 'Kein Status');
\define('_AM_WGSLIDER_STATUS_OFFLINE', 'Offline');
\define('_AM_WGSLIDER_STATUS_OFFLINE_CLICK', 'Offline, klicken um online zu setzen!');
\define('_AM_WGSLIDER_STATUS_ONLINE', 'Online');
\define('_AM_WGSLIDER_STATUS_ONLINE_CLICK', 'Online, klicken um offline zu setzen!');
\define('_AM_WGSLIDER_STATUS_INVALID_SIZE', 'Ungültige Größe');
\define('_AM_WGSLIDER_STATUS_CHANGE', 'Status ändern');
\define('_AM_WGSLIDER_STATUS_CHANGE_ERROR', 'Fehler beim Ändern des Status');
// Clone feature
\define('_AM_WGSLIDER_CLONE', 'Klonen');
\define('_AM_WGSLIDER_CLONE_DSC', 'Das Klonen eines Moduls war noch nie so einfach! Geben Sie einfach den gewünschten Namen ein und klicken Sie auf Absenden!');
\define('_AM_WGSLIDER_CLONE_TITLE', 'Klon von %s');
\define('_AM_WGSLIDER_CLONE_NAME', 'Wählen Sie einen Namen für das neue Modul');
\define('_AM_WGSLIDER_CLONE_NAME_DSC', 'Keine Sonderzeichen verwenden! <br>Wählen Sie keinen bereits existierenden Modulordner oder Datenbanktabellennamen!');
\define('_AM_WGSLIDER_CLONE_INVALIDNAME', 'FEHLER: Ungültiger Modulname, bitte versuchen Sie einen anderen!');
\define('_AM_WGSLIDER_CLONE_EXISTS', 'FEHLER: Modulname bereits vergeben, bitte versuchen Sie einen anderen!');
\define('_AM_WGSLIDER_CLONE_CONGRAT', 'Glückwunsch! %s wurde erfolgreich erstellt!<br>Sie möchten eventuell Änderungen in den Sprachdateien vornehmen.');
\define('_AM_WGSLIDER_CLONE_IMAGEFAIL', 'Achtung: Das neue Modul-Logo konnte nicht erstellt werden. Bitte bearbeiten Sie assets/images/logo_module.png manuell!');
\define('_AM_WGSLIDER_CLONE_FAIL', 'Leider konnte der Klon nicht erstellt werden. Möglicherweise müssen Sie dem modules-Ordner temporär Schreibrechte (CHMOD 777) geben und es erneut versuchen.');
// Image editor
\define('_AM_WGSLIDER_IMAGE_EDITOR', 'Bildeditor');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CREATE', 'Bild erstellen');
\define('_AM_WGSLIDER_IMAGE_EDITOR_APPLY', 'Anwenden');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP', 'Bild zuschneiden');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP_MOVE', 'Verschieben');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP_ZOOMIN', 'Vergrößern');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP_ZOOMOUT', 'Verkleinern');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP_MOVE_LEFT', 'Nach links verschieben');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP_MOVE_RIGHT', 'Nach rechts verschieben');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP_MOVE_UP', 'Nach oben verschieben');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP_MOVE_DOWN', 'Nach unten verschieben');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP_ROTATE_LEFT', 'Nach links drehen');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP_ROTATE_RIGHT', 'Nach rechts drehen');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP_FLIP_HORIZONTAL', 'Horizontal spiegeln');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP_FLIP_VERTICAL', 'Vertikal spiegeln');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP_ASPECTRATIO', 'Seitenverhältnis');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP_ASPECTRATIO_FREE', 'Frei');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CURRENT2', 'Quelle des aktuellen Bildes');
\define('_AM_WGSLIDER_IMAGE_EDITOR_RESXY', 'Auflösung');
\define('_AM_WGSLIDER_IMAGE_EDITOR_CROP_ERROR', 'Zuschneiden fehlgeschlagen. Bitte erneut versuchen.');
// ---------------- Checks and errors ----------------
\define('_AM_WGSLIDER_INVALID_PARAM', 'Ungültiger Parameter');
\define('_AM_WGSLIDER_INVALID_VALUE', 'Ungültiger Wert');
\define('_AM_WGSLIDER_INVALID_DATE', 'Ungültiges Datum');
\define('_AM_WGSLIDER_FORM_ERROR_INVALID_ID', 'Ungültige ID');
\define('_AM_WGSLIDER_ERROR_MOVE_FILE', 'Fehler: Datei konnte nicht verschoben werden!');
\define('_AM_WGSLIDER_ERROR_MOVE_FILE_RESTORED', 'Fehler: Datei konnte nicht verschoben werden, vorherige Datei wurde wiederhergestellt!');
\define('_AM_WGSLIDER_ERROR_FILE_NOT_FOUND', 'Fehler: Datei nicht gefunden!');
// ---------------- Admin Others ----------------
\define('_AM_WGSLIDER_ABOUT_MAKE_DONATION', 'Absenden');
\define('_AM_WGSLIDER_SUPPORT_FORUM', 'Support-Forum');
\define('_AM_WGSLIDER_DONATION_AMOUNT', 'Spendenbetrag');
\define('_AM_WGSLIDER_MAINTAINEDBY', ' wird gepflegt von ');
// ---------------- End ----------------
