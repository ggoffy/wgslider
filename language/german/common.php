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
 * wgSlider module
 *
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2.0 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 * @since           3.23
 * @author          Xoops Development Team
 */
$moduleDirName      = \basename(\dirname(__DIR__, 2));
$moduleDirNameUpper = \mb_strtoupper($moduleDirName);

\define('CO_' . $moduleDirNameUpper . '_GDLIBSTATUS', 'GD-Bibliothek Unterstützung: ');
\define('CO_' . $moduleDirNameUpper . '_GDLIBVERSION', 'GD-Bibliothek Version: ');
\define('CO_' . $moduleDirNameUpper . '_GDOFF', "<span style='font-weight: bold;'>Deaktiviert</span> (Keine Thumbnails verfügbar)");
\define('CO_' . $moduleDirNameUpper . '_GDON', "<span style='font-weight: bold;'>Aktiviert</span> (Thumbnails verfügbar)");
\define('CO_' . $moduleDirNameUpper . '_IMAGEINFO', 'Serverstatus');
\define('CO_' . $moduleDirNameUpper . '_MAXPOSTSIZE', 'Maximale POST-Größe (post_max_size Directive in php.ini): ');
\define('CO_' . $moduleDirNameUpper . '_MAXUPLOADSIZE', 'Maximale Upload-Größe (upload_max_filesize Directive in php.ini): ');
\define('CO_' . $moduleDirNameUpper . '_MEMORYLIMIT', 'Speicherlimit (memory_limit Directive in php.ini): ');
\define('CO_' . $moduleDirNameUpper . '_METAVERSION', "<span style='font-weight: bold;'>Downloads Meta-Version:</span> ");
\define('CO_' . $moduleDirNameUpper . '_OFF', "<span style='font-weight: bold;'>AUS</span>");
\define('CO_' . $moduleDirNameUpper . '_ON', "<span style='font-weight: bold;'>EIN</span>");
\define('CO_' . $moduleDirNameUpper . '_SERVERPATH', 'Serverpfad zum XOOPS-Root: ');
\define('CO_' . $moduleDirNameUpper . '_SERVERUPLOADSTATUS', 'Server-Upload-Status: ');
\define('CO_' . $moduleDirNameUpper . '_SPHPINI', "<span style='font-weight: bold;'>Informationen aus der PHP-ini-Datei:</span>");
\define('CO_' . $moduleDirNameUpper . '_UPLOADPATHDSC', 'Hinweis: Der Upload-Pfad *MUSS* den vollständigen Serverpfad zu Ihrem Upload-Ordner enthalten.');

\define('CO_' . $moduleDirNameUpper . '_PRINT', "<span style='font-weight: bold;'>Drucken</span>");
\define('CO_' . $moduleDirNameUpper . '_PDF', "<span style='font-weight: bold;'>PDF erstellen</span>");

\define('CO_' . $moduleDirNameUpper . '_UPGRADEFAILED0', "Update fehlgeschlagen – Feld '%s' konnte nicht umbenannt werden");
\define('CO_' . $moduleDirNameUpper . '_UPGRADEFAILED1', "Update fehlgeschlagen – neue Felder konnten nicht hinzugefügt werden");
\define('CO_' . $moduleDirNameUpper . '_UPGRADEFAILED2', "Update fehlgeschlagen – Tabelle '%s' konnte nicht umbenannt werden");
\define('CO_' . $moduleDirNameUpper . '_ERROR_COLUMN', 'Spalte konnte nicht in der Datenbank erstellt werden: %s');
\define('CO_' . $moduleDirNameUpper . '_ERROR_BAD_XOOPS', 'Dieses Modul benötigt XOOPS %s+ (%s installiert)');
\define('CO_' . $moduleDirNameUpper . '_ERROR_BAD_PHP', 'Dieses Modul benötigt PHP-Version %s+ (%s installiert)');
\define('CO_' . $moduleDirNameUpper . '_ERROR_TAG_REMOVAL', 'Tags konnten aus dem Tag-Modul nicht entfernt werden');

\define('CO_' . $moduleDirNameUpper . '_FOLDERS_DELETED_OK', 'Upload-Ordner wurden gelöscht');

// Error Msgs
\define('CO_' . $moduleDirNameUpper . '_ERROR_BAD_DEL_PATH', 'Verzeichnis %s konnte nicht gelöscht werden');
\define('CO_' . $moduleDirNameUpper . '_ERROR_BAD_REMOVE', '%s konnte nicht gelöscht werden');
\define('CO_' . $moduleDirNameUpper . '_ERROR_NO_PLUGIN', 'Plugin konnte nicht geladen werden');

//Help
\define('CO_' . $moduleDirNameUpper . '_DIRNAME', \basename(\dirname(__DIR__, 2)));
\define('CO_' . $moduleDirNameUpper . '_HELP_HEADER', __DIR__ . '/help/helpheader.tpl');
\define('CO_' . $moduleDirNameUpper . '_BACK_2_ADMIN', 'Zurück zur Administration von ');
\define('CO_' . $moduleDirNameUpper . '_OVERVIEW', 'Übersicht');

//help multi-page
\define('CO_' . $moduleDirNameUpper . '_DISCLAIMER', 'Haftungsausschluss');
\define('CO_' . $moduleDirNameUpper . '_LICENSE', 'Lizenz');
\define('CO_' . $moduleDirNameUpper . '_SUPPORT', 'Support');

//Sample Data
\define('CO_' . $moduleDirNameUpper . '_' . 'ADD_SAMPLEDATA', 'Beispieldaten importieren (löscht ALLE aktuellen Daten)');
\define('CO_' . $moduleDirNameUpper . '_' . 'SAMPLEDATA_SUCCESS', 'Beispieldaten erfolgreich importiert');
\define('CO_' . $moduleDirNameUpper . '_' . 'SAVE_SAMPLEDATA', 'Tabellen nach YAML exportieren');
\define('CO_' . $moduleDirNameUpper . '_' . 'SAVE_SAMPLEDATA_SUCCESS', 'Tabellen erfolgreich nach YAML exportiert');
\define('CO_' . $moduleDirNameUpper . '_' . 'SAVE_SAMPLEDATA_ERROR', 'FEHLER: Export der Tabellen nach YAML fehlgeschlagen');
\define('CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON', 'Beispieldaten-Button anzeigen?');
\define('CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON_DESC', 'Wenn Ja, wird der Button „Beispieldaten hinzufügen“ für den Admin angezeigt. Standardmäßig Ja bei Erstinstallation.');
\define('CO_' . $moduleDirNameUpper . '_' . 'EXPORT_SCHEMA', 'DB-Schema nach YAML exportieren');
\define('CO_' . $moduleDirNameUpper . '_' . 'EXPORT_SCHEMA_SUCCESS', 'Export des DB-Schemas nach YAML erfolgreich');
\define('CO_' . $moduleDirNameUpper . '_' . 'EXPORT_SCHEMA_ERROR', 'FEHLER: Export des DB-Schemas nach YAML fehlgeschlagen');
\define('CO_' . $moduleDirNameUpper . '_' . 'ADD_SAMPLEDATA_OK', 'Möchten Sie wirklich Beispieldaten importieren? (Alle aktuellen Daten werden gelöscht)');
\define('CO_' . $moduleDirNameUpper . '_' . 'HIDE_SAMPLEDATA_BUTTONS', 'Import-Buttons ausblenden');
\define('CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLEDATA_BUTTONS', 'Import-Buttons anzeigen');
\define('CO_' . $moduleDirNameUpper . '_' . 'CONFIRM', 'Bestätigen');

//letter choice
\define('CO_' . $moduleDirNameUpper . '_' . 'BROWSETOTOPIC', "<span style='font-weight: bold;'>Einträge alphabetisch durchsuchen</span>");
\define('CO_' . $moduleDirNameUpper . '_' . 'OTHER', 'Andere');
\define('CO_' . $moduleDirNameUpper . '_' . 'ALL', 'Alle');

// block defines
\define('CO_' . $moduleDirNameUpper . '_' . 'ACCESSRIGHTS', 'Zugriffsrechte');
\define('CO_' . $moduleDirNameUpper . '_' . 'ACTION', 'Aktion');
\define('CO_' . $moduleDirNameUpper . '_' . 'ACTIVERIGHTS', 'Aktive Rechte');
\define('CO_' . $moduleDirNameUpper . '_' . 'BADMIN', 'Block-Administration');
\define('CO_' . $moduleDirNameUpper . '_' . 'BLKDESC', 'Beschreibung');
\define('CO_' . $moduleDirNameUpper . '_' . 'CBCENTER', 'Mitte');
\define('CO_' . $moduleDirNameUpper . '_' . 'CBLEFT', 'Mitte Links');
\define('CO_' . $moduleDirNameUpper . '_' . 'CBRIGHT', 'Mitte Rechts');
\define('CO_' . $moduleDirNameUpper . '_' . 'SBLEFT', 'Links');
\define('CO_' . $moduleDirNameUpper . '_' . 'SBRIGHT', 'Rechts');
\define('CO_' . $moduleDirNameUpper . '_' . 'SIDE', 'Ausrichtung');
\define('CO_' . $moduleDirNameUpper . '_' . 'TITLE', 'Titel');
\define('CO_' . $moduleDirNameUpper . '_' . 'VISIBLE', 'Sichtbar');
\define('CO_' . $moduleDirNameUpper . '_' . 'VISIBLEIN', 'Sichtbar in');
\define('CO_' . $moduleDirNameUpper . '_' . 'WEIGHT', 'Gewichtung');

\define('CO_' . $moduleDirNameUpper . '_' . 'PERMISSIONS', 'Berechtigungen');
\define('CO_' . $moduleDirNameUpper . '_' . 'BLOCKS', 'Block-Administration');
\define('CO_' . $moduleDirNameUpper . '_' . 'BLOCKS_DESC', 'Blöcke/Gruppen-Administration');

\define('CO_' . $moduleDirNameUpper . '_' . 'BLOCKS_MANAGMENT', 'Verwalten');
\define('CO_' . $moduleDirNameUpper . '_' . 'BLOCKS_ADDBLOCK', 'Neuen Block hinzufügen');
\define('CO_' . $moduleDirNameUpper . '_' . 'BLOCKS_EDITBLOCK', 'Block bearbeiten');
\define('CO_' . $moduleDirNameUpper . '_' . 'BLOCKS_CLONEBLOCK', 'Block klonen');

//myblocksadmin
\define('CO_' . $moduleDirNameUpper . '_' . 'AGDS', 'Admin-Gruppen');
\define('CO_' . $moduleDirNameUpper . '_' . 'BCACHETIME', 'Cache-Zeit');
\define('CO_' . $moduleDirNameUpper . '_' . 'BLOCKS_ADMIN', 'Block-Admin');

//Template Admin
\define('CO_' . $moduleDirNameUpper . '_' . 'TPLSETS', 'Template-Verwaltung');
\define('CO_' . $moduleDirNameUpper . '_' . 'GENERATE', 'Generieren');
\define('CO_' . $moduleDirNameUpper . '_' . 'FILENAME', 'Dateiname');

//Menu
\define('CO_' . $moduleDirNameUpper . '_' . 'ADMENU_MIGRATE', 'Migrieren');
\define('CO_' . $moduleDirNameUpper . '_' . 'FOLDER_YES', 'Ordner "%s" existiert');
\define('CO_' . $moduleDirNameUpper . '_' . 'FOLDER_NO', 'Ordner "%s" existiert nicht. Bitte erstellen Sie ihn mit CHMOD 777.');
\define('CO_' . $moduleDirNameUpper . '_' . 'SHOW_DEV_TOOLS', 'Button für Entwickler-Tools anzeigen?');
\define('CO_' . $moduleDirNameUpper . '_' . 'SHOW_DEV_TOOLS_DESC', 'Wenn Ja, werden der Tab „Migration“ und andere Entwickler-Tools für den Admin sichtbar.');
\define('CO_' . $moduleDirNameUpper . '_' . 'ADMENU_FEEDBACK', 'Feedback');

//Latest Version Check
\define('CO_' . $moduleDirNameUpper . '_' . 'NEW_VERSION', 'Neue Version: ');

//DirectoryChecker
\define('CO_' . $moduleDirNameUpper . '_' . 'AVAILABLE', "<span style='color: green;'>Verfügbar</span>");
\define('CO_' . $moduleDirNameUpper . '_' . 'NOTAVAILABLE', "<span style='color: red;'>Nicht verfügbar</span>");
\define('CO_' . $moduleDirNameUpper . '_' . 'NOTWRITABLE', "<span style='color: red;'>Sollte Berechtigung ( %d ) haben, hat aber ( %d )</span>");
\define('CO_' . $moduleDirNameUpper . '_' . 'CREATETHEDIR', 'Erstellen');
\define('CO_' . $moduleDirNameUpper . '_' . 'SETMPERM', 'Berechtigung setzen');
\define('CO_' . $moduleDirNameUpper . '_' . 'DIRCREATED', 'Verzeichnis wurde erstellt');
\define('CO_' . $moduleDirNameUpper . '_' . 'DIRNOTCREATED', 'Verzeichnis konnte nicht erstellt werden');
\define('CO_' . $moduleDirNameUpper . '_' . 'PERMSET', 'Berechtigung wurde gesetzt');
\define('CO_' . $moduleDirNameUpper . '_' . 'PERMNOTSET', 'Berechtigung konnte nicht gesetzt werden');

//FileChecker
//\define('CO_' . $moduleDirNameUpper . '_' . 'AVAILABLE', "<span style='color: green;'>Available</span>");
//\define('CO_' . $moduleDirNameUpper . '_' . 'NOTAVAILABLE', "<span style='color: red;'>Not available</span>");
//\define('CO_' . $moduleDirNameUpper . '_' . 'NOTWRITABLE', "<span style='color: red;'>Should have permission ( %d ), but it has ( %d )</span>");
//\define('CO_' . $moduleDirNameUpper . '_' . 'COPYTHEFILE', 'Copy it');
//\define('CO_' . $moduleDirNameUpper . '_' . 'CREATETHEFILE', 'Create it');
//\define('CO_' . $moduleDirNameUpper . '_' . 'SETMPERM', 'Set the permission');
\define('CO_' . $moduleDirNameUpper . '_' . 'FILECOPIED', 'Datei wurde kopiert');
\define('CO_' . $moduleDirNameUpper . '_' . 'FILENOTCOPIED', 'Datei konnte nicht kopiert werden');
//\define('CO_' . $moduleDirNameUpper . '_' . 'PERMSET', 'The permission has been set');
//\define('CO_' . $moduleDirNameUpper . '_' . 'PERMNOTSET', 'The permission cannot be set');

//image config
\define('CO_' . $moduleDirNameUpper . '_' . 'IMAGE_WIDTH', 'Anzeigebreite des Bildes');
\define('CO_' . $moduleDirNameUpper . '_' . 'IMAGE_WIDTH_DSC', 'Breite für die Bildanzeige');
\define('CO_' . $moduleDirNameUpper . '_' . 'IMAGE_HEIGHT', 'Anzeigehöhe des Bildes');
\define('CO_' . $moduleDirNameUpper . '_' . 'IMAGE_HEIGHT_DSC', 'Höhe für die Bildanzeige');
\define('CO_' . $moduleDirNameUpper . '_' . 'IMAGE_CONFIG', '<span style="color: #FF0000; font-size: Small; font-weight: bold;">--- EXTERNE Bildkonfiguration ---</span> ');
\define('CO_' . $moduleDirNameUpper . '_' . 'IMAGE_CONFIG_DSC', '');
\define('CO_' . $moduleDirNameUpper . '_' . 'IMAGE_UPLOAD_PATH', 'Bild-Upload-Pfad');
\define('CO_' . $moduleDirNameUpper . '_' . 'IMAGE_UPLOAD_PATH_DSC', 'Pfad zum Hochladen von Bildern');

//Preferences
\define('CO_' . $moduleDirNameUpper . '_' . 'TRUNCATE_LENGTH', 'Anzahl der Zeichen für die Kürzung des langen Textfeldes');
\define('CO_' . $moduleDirNameUpper . '_' . 'TRUNCATE_LENGTH_DESC', 'Maximale Anzahl an Zeichen, auf die lange Textfelder gekürzt werden');

//Module Stats
\define('CO_' . $moduleDirNameUpper . '_' . 'STATS_SUMMARY', 'Modulstatistik');
\define('CO_' . $moduleDirNameUpper . '_' . 'TOTAL_CATEGORIES', 'Kategorien:');
\define('CO_' . $moduleDirNameUpper . '_' . 'TOTAL_ITEMS', 'Einträge');
\define('CO_' . $moduleDirNameUpper . '_' . 'TOTAL_OFFLINE', 'Offline');
\define('CO_' . $moduleDirNameUpper . '_' . 'TOTAL_PUBLISHED', 'Veröffentlicht');
\define('CO_' . $moduleDirNameUpper . '_' . 'TOTAL_REJECTED', 'Abgelehnt');
\define('CO_' . $moduleDirNameUpper . '_' . 'TOTAL_SUBMITTED', 'Eingereicht');
