<?php 

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2013 Leo Feyer
 * 
 * @package   ImageMenu
 * @author    Richard Henkenjohann
 * @license   LGPL
 * @copyright Richard Henkenjohann 2013
 */


/**
 * Front end modules
 */
$GLOBALS['TL_LANG']['FMD']['imagemenu'] = array('ImageMenu', 'Erzeugt ein MooTools-basierendes Navigationsmenü, unterstützt nur eine Ebene');


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_module']['im_width']        = array('Breite des Menüs', 'Hier können Sie die Breite des Menüs mit passender Einheit eingeben.');
$GLOBALS['TL_LANG']['tl_module']['im_height']       = array('Höhe des Menüs', 'Hier können Sie die Höhe des Menüs mit passender Einheit eingeben.');
$GLOBALS['TL_LANG']['tl_module']['im_openWidth']    = array('Breite des aktiven Menüpunktes', 'Hier können Sie die Breite des geöffneten Menüpunktes angeben. <em>Das Hintergrundbild sollte auch so breit sein.</em>');
$GLOBALS['TL_LANG']['tl_module']['im_duration']     = array('Dauer / Geschwindigkeit', 'Hier können Sie die Dauer für das Öffnen/Schließen angeben. <em>Standard ist <strong>400</strong>.</em>');
$GLOBALS['TL_LANG']['tl_module']['im_openIfActive'] = array('Menüpunkt offen lassen, wenn aktiv', 'Hier können Sie entscheiden, ob der Menüpunkt offen bleiben soll, wenn er aktiv ist.');
$GLOBALS['TL_LANG']['tl_module']['im_fallback']     = array('Fallback-Seite', 'Wählen Sie hier die Seite aus, die geöffnet angezeigt werden soll, wenn die aktuelle Seite nicht in der Navigation vorhanden ist.');
