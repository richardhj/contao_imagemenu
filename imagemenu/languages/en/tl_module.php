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
$GLOBALS['TL_LANG']['FMD']['imagemenu'] = array('ImageMenu', 'Creates a MooTools based navigation menu, supports only one level');


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_module']['im_width']        = array('ImageMenu width', 'Here you can enter the ImageMenu width.');
$GLOBALS['TL_LANG']['tl_module']['im_height']       = array('ImageMenu height', 'Here you can enter the ImageMenu height.');
$GLOBALS['TL_LANG']['tl_module']['im_openWidth']    = array('Width of the active object', 'Here you can enter the width of the active object. <em>The background image should have the same width.</em>');
$GLOBALS['TL_LANG']['tl_module']['im_duration']     = array('Duration / Speed', 'Here you can enter the duration. <em>Default is <strong>400</strong>.</em>');
$GLOBALS['TL_LANG']['tl_module']['im_openIfActive'] = array('Object should be open, if active', 'If you tick the box, the object should be open, if active.');
$GLOBALS['TL_LANG']['tl_module']['im_fallback']     = array('Fallback page', 'Choose the site which is open if the current page is not in the navigation menu.');
