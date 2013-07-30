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
 * Config
 */
$GLOBALS['TL_DCA']['tl_module']['config']['onsubmit_callback'][] = array('tl_module_imagemenu', 'generateImageMenuCss');


/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'im_openIfActive';
$GLOBALS['TL_DCA']['tl_module']['palettes']['imagemenu'] = '{title_legend},name,headline,type;{nav_legend},levelOffset,showProtected;{reference_legend:hide},rootPage;{imagemenu_legend},im_width,im_height,im_openWidth,im_duration,im_openIfActive,im_self_manage,im_border;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';


/**
 * Subpalettes
 */
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['im_openIfActive'] = 'im_fallback';


/**
 * CSS class adjustments
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['showLevel']['eval']['tl_class'] = 'w50 cbx m12';
$GLOBALS['TL_DCA']['tl_module']['fields']['showProtected']['eval']['tl_class'] = 'w50 cbx m12';


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['im_width'] = array
(
	'label'						=> &$GLOBALS['TL_LANG']['tl_module']['im_width'],
	'inputType'					=> 'inputUnit',
	'options'					=> array('px', '%', 'em', 'pt', 'pc', 'in', 'cm', 'mm'),
	'eval'						=> array('mandatory'=>true, 'includeBlankOption'=>true, 'rgxp'=>'digit', 'tl_class'=>'w50'),
	'sql'						=> "varchar(64) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['im_height'] = array
(
	'label'						=> &$GLOBALS['TL_LANG']['tl_module']['im_height'],
	'inputType'					=> 'inputUnit',
	'options'					=> array('px', '%', 'em', 'pt', 'pc', 'in', 'cm', 'mm'),
	'eval'						=> array('mandatory'=>true, 'includeBlankOption'=>true, 'rgxp'=>'digit', 'tl_class'=>'w50'),
	'sql'						=> "varchar(64) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['im_openWidth'] = array
(
	'label'						=> &$GLOBALS['TL_LANG']['tl_module']['im_openWidth'],
	'inputType'					=> 'inputUnit',
	'options'					=> array('px'),
	'eval'						=> array('mandatory'=>true, 'includeBlankOption'=>false, 'rgxp'=>'digit', 'tl_class'=>'w50'),
	'sql'						=> "varchar(64) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['im_duration'] = array
(
	'label'						=> &$GLOBALS['TL_LANG']['tl_module']['im_duration'],
	'inputType'					=> 'text',
	'eval'						=> array('maxlength'=>4, 'rgxp'=>'digit', 'tl_class'=>'w50'),
	'sql'                     => "varchar(64) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['im_openIfActive'] = array
(
	'label'						=> &$GLOBALS['TL_LANG']['tl_module']['im_openIfActive'],
	'inputType'					=> 'checkbox',
	'eval'						=> array('tl_class'=>'w50', 'submitOnChange'=>true),
	'sql'						=> "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['im_selfManage'] = array
(
	'label'						=> &$GLOBALS['TL_LANG']['tl_module']['im_selfManage'],
	'inputType'					=> 'checkbox',
	'eval'						=> array('tl_class'=>'w50'),
	'sql'						=> "char(1) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_module']['fields']['im_fallback'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['im_fallback'],
	'exclude'                 => true,
	'inputType'               => 'pageTree',
	'foreignKey'              => 'tl_page.title',
	'eval'                    => array('fieldType'=>'radio'),
	'sql'                     => "int(10) unsigned NOT NULL default '0'",
	'relation'                => array('type'=>'hasOne', 'load'=>'eager')
);


/**
 * Class tl_module_imagemenu
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Richard Henkenjohann 2013
 * @author     Richard Henkenjohann
 * @package    ImageMenu
 */
class tl_module_imagemenu extends Backend
{

	/**
	 * Initialize the system
	 */
	public function __construct()
	{
		parent::__construct();
	}


	/**
	 * Generate the css file
	 */
	public function generateImageMenuCss(DataContainer $dc)
	{
		$objModule = $this->Database->prepare("SELECT im_width,im_height,rootPage,cssID FROM tl_module WHERE id=?")
									->limit(1)
									->execute($dc->id);

		$cssID = deserialize($objModule->cssID)[0];
		$arrWidth = deserialize($objModule->im_width);
		$arrHeight = deserialize($objModule->im_height);
		$items = array();

		if ($objModule->rootPage > 0)
		{
			$objSubpages = \PageModel::findPublishedSubpagesWithoutGuestsByPid($objModule->rootPage);
			while ($objSubpages->next())
			{
				$items[] = $objSubpages->id;
			}
		}
		else
		{
			throw new Exception('No root page defined');
		}

		$css = file_get_contents(TL_ROOT . '/system/modules/imagemenu/assets/ImageMenu.css.pattern');

		$cssItems = '';

		foreach ($items as $id)
		{
			$objPage = $this->getPageDetails($id);

			if ($objPage->im_image)
			{
				$objImage = \FilesModel::findByPk($objPage->im_image);
				$cssItems .= '#' . $cssID . ' ul li a.' . $objPage->alias . "\n{\n\tbackground:url(../../../../$objImage->path) no-repeat left top;\n}\n\n";
			}
		}

		$css = str_replace
		(
			array
			(
				'{{selector}}',
				'{{width::value}}',
				'{{width::unit}}',
				'{{height::value}}',
				'{{height::unit}}',
				'{{width_twice::value}}',
				'{{width_item::value}}',
				'{{items}}'
			),
			array
			(
				$cssID,
				$arrWidth['value'],
				$arrWidth['unit'],
				$arrHeight['value'],
				$arrHeight['unit'],
				$arrWidth['value'] * 2,
				round($arrWidth['value'] / count($items)),
				$cssItems
			),
			$css
		);

		$objCss = new File('system/modules/imagemenu/assets/ImageMenu-' . $cssID  . '-' . $objModule->rootPage . '.css');
		$objCss->write($css);
		$objCss->close();
	}
}
