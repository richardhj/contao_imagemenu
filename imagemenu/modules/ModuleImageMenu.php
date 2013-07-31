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
 * Run in a custom namespace, so the class can be replaced
 */
namespace ImageMenu;


/**
 * Class ModuleImageMenu
 *
 * Front end module "ImageMenu".
 * @copyright  Richard Henkenjohann 2013
 * @author     Richard Henkenjohann
 * @package    ImageMenu
 */
class ModuleImageMenu extends \Module
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_navigation';


	/**
	 * Do not display the module if there are no menu items
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new \BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### IMAGE MENU ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		$strBuffer = parent::generate();
		return ($this->Template->items != '') ? $strBuffer : '';
	}


	/**
	 * Generate the module
	 */
	protected function compile()
	{
		global $objPage;

		$trail = $objPage->trail;
		$level = ($this->levelOffset > 0) ? $this->levelOffset : 0;

		// Overwrite with custom reference page
		if ($this->rootPage > 0)
		{
			$trail = array($this->rootPage);
			$level = 0;
		}

		// ImageMenu does not support a multi level navigation
		$this->showLevel = '1';
		$this->hardLimit = '1';
		$this->defineRoot = '1';
		$this->navigationTpl = 'nav_imagemenu';

		if (TL_MODE == 'FE')
		{
			$i = 0;
			$objSubpages = \PageModel::findPublishedSubpagesWithoutGuestsByPid($trail[$level]);

			while ($objSubpages->next())
			{
				if ((($objPage->id == $objSubpages->id || $objSubpages->type == 'forward' && $objPage->id == $objSubpages->jumpTo) && !$this instanceof \ModuleSitemap && !\Input::get('articles')) || // Active page
					(in_array($objSubpages->id, $objPage->trail)) || // Trail page
					($objSubpages->id == $this->im_fallback)) // Fallback page
				{
					$openId = $i;
				}
				$i++;
			}

			$cssID = deserialize($this->cssID)[0];

			$GLOBALS['TL_JAVASCRIPT'][] = TL_SCRIPT_URL . 'system/modules/imagemenu/assets/ImageMenu.min.js|static';
			$GLOBALS['TL_CSS'][] = TL_SCRIPT_URL . 'system/modules/imagemenu/assets/ImageMenu-' . $this->id . '.css';
			$GLOBALS['TL_MOOTOOLS'][] = '<script type="text/javascript">
window.addEvent("domready", function()
{
	var basicMenu = new ImageMenu($$("#imageMenu ul li a"),
	{
		openWidth: ' . deserialize($this->im_openWidth)['value'] . ',
		border: ' . (deserialize($this->im_border)[2] ?: 2) . ',
		duration: ' . $this->im_duration . ',
		open: ' . (($this->im_openIfActive && $openId !== null) ? $openId : 'null') . ',
		OnClickOpen: function(e,i)
		{
        	location.href = e;
        }
	});
});
</script>';

		}

		$this->Template->request = $this->getIndexFreeRequest(true);
		$this->Template->skipId = 'skipNavigation' . $this->id;
		$this->Template->skipNavigation = specialchars($GLOBALS['TL_LANG']['MSC']['skipNavigation']);
		$this->Template->items = $this->renderNavigation($trail[$level]);
	}
}
