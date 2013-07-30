<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2012 Leo Feyer
 * 
 * @package ImageMenu
 * @link    http://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Front end modules
 */
array_insert($GLOBALS['FE_MOD']['navigationMenu'], 1,
	array
	(
		'imagemenu'        => 'ModuleImageMenu'
	)
);
