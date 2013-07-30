<?php 

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2012 Leo Feyer
 * 
 * @package   ImageMenu
 * @author    Richard Henkenjohann
 * @license   LGPL
 * @copyright Richard Henkenjohann 2013
 */

 
/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_module']['im_width']              = array('Breite des Menüs', 'Hier können Sie die Breite des Menüs mit passender Einheit eingeben.');
$GLOBALS['TL_LANG']['tl_module']['im_height']             = array('Höhe des Menüs', 'Hier können Sie die Höhe des Menüs mit passender Einheit eingeben.');
$GLOBALS['TL_LANG']['tl_module']['im_openWidth']          = array('Breite des aktiven Menüpunktes', 'Hier können Sie die Breite des geöffneten Menüpunktes angeben. <em>Das Hintergrundbild sollte auch so breit sein.</em>');
$GLOBALS['TL_LANG']['tl_module']['im_duration']           = array('Dauer / Geschwindigkeit', 'Hier können Sie die Dauer für das Öffnen/Schließen angeben. <em>Testen Sie es aus, Standard ist <strong>400</strong>.</em>');
$GLOBALS['TL_LANG']['tl_module']['im_openIfActive']       = array('Menüpunkt offen lassen, wenn aktiv', 'Hier können Sie entscheiden, ob der Menüpunkt offen bleiben soll, wenn er aktiv ist.');
$GLOBALS['TL_LANG']['tl_module']['im_self_manage']        = array('Selbstverwaltung der CSS-Hintergrundbild-Einstellungen', 'Hier können Sie entscheiden, ob Sie die CSS-Einstellungen für die Hintergrundbilder der Elemente selbst vornehmen wollen. Dieses Häkchen ist beispielsweise bei CSS-Sprites notwendig.<br>Lassen Sie dann beim nächsten Punkt <em>Objekte</em> einfach die Felder (bis auf Fallback) leer.');
$GLOBALS['TL_LANG']['tl_module']['im_items']              = array('Objekte (Hintergrundbilder)', 'Hier können Sie jeweils den Pfad zum Hintergrundbild der Objekte und den dazugehörigen Seitenalias angeben.');
$GLOBALS['TL_LANG']['tl_module']['im_border']             = array('Rahmen (für die einzelnen Menüpunkte)', 'Klicken Sie hier, um für die einzelnen im_Objekte einen Rahmen einzustellen.');
$GLOBALS['TL_LANG']['tl_module']['im_borderwidth']        = array('Rahmenbreite', 'Hier können Sie die obere, rechte, untere und linke Rahmenbreite eingeben.');
$GLOBALS['TL_LANG']['tl_module']['im_borderstyle']        = array('Rahmenstil', 'Hier können Sie den Stil des Rahmens auswählen.');
$GLOBALS['TL_LANG']['tl_module']['im_bordercolor']        = array('Rahmenfarbe', 'Hier können Sie eine hexadezimale Rahmenfarbe eingeben (z.B. ff0000 für rot).');
$GLOBALS['TL_LANG']['tl_module']['im_bordercollapse']     = array('Rahmenmodell', 'Hier können Sie das Rahmenmodell auswählen.');


/**
 * Legends
 */
//$GLOBALS['TL_LANG']['tl_module']['ImageMenu_legend']             = 'ImageMenu';


/**
 * ItemsWizard
 */
$GLOBALS['TL_LANG']['tl_module']['im_wiz_path']             = 'Pfad zum Hintergrundbild';
$GLOBALS['TL_LANG']['tl_module']['im_wiz_alias']            = 'Seitenalias (bzw. CSS-Klasse)';
$GLOBALS['TL_LANG']['tl_module']['im_wiz_fallback']         = 'Fallback';

?>