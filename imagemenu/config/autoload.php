<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2013 Leo Feyer
 * 
 * @package Imagemenu
 * @link    http://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'ImageMenu',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Modules
	'ImageMenu\ModuleImageMenu' => 'system/modules/imagemenu/modules/ModuleImageMenu.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'nav_imagemenu' => 'system/modules/imagemenu/templates',
));
