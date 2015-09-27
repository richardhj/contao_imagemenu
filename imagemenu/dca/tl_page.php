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
 * Palettes
 */
foreach ($GLOBALS['TL_DCA']['tl_page']['palettes'] as $name => $palette)
{
	if ($name == '__selector__')
	{
		continue;
	}

	$GLOBALS['TL_DCA']['tl_page']['palettes'][$name] = str_replace
	(
		';{cache_legend:hide}',
		';{imagemenu_legend},im_image;{cache_legend:hide}',
		$palette);
}


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_page']['fields']['im_image'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_page']['im_image'],
	'exclude'                 => true,
	'inputType'               => 'fileTree',
	'eval'                    => array('filesOnly'=>true, 'fieldType'=>'radio', 'tl_class'=>'clr', 'extensions'=>Config::get('validImageTypes')),
	'sql'                     => "binary(16) NULL",
	'relation'                => array('type'=>'hasOne', 'table'=>\FilesModel::getTable(), 'field'=>'uuid')
);
