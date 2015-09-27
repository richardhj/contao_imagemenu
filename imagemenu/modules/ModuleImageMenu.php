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

use Contao\Module;
use Contao\PageModel;


/**
 * Class ModuleImageMenu
 *
 * Front end module "ImageMenu".
 * @copyright  Richard Henkenjohann 2013
 * @author     Richard Henkenjohann
 * @package    ImageMenu
 */
class ModuleImageMenu extends Module
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
		/** @var PageModel $objPage */
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
			$objSubPages = PageModel::findPublishedSubpagesWithoutGuestsByPid($trail[$level]);

			if (null !== $objSubPages)
			{
				while ($objSubPages->next())
				{
					if ((($objPage->id == $objSubPages->id || $objSubPages->type == 'forward' && $objPage->id == $objSubPages->jumpTo) && !$this instanceof \ModuleSitemap && !\Input::get('articles')) || // Active page
						(in_array($objSubPages->id, $objPage->trail)) || // Trail page
						($objSubPages->id == $this->im_fallback)) // Fallback page
					{
						$openId = $i;
					}

					$i++;
				}
			}

			$cssID = deserialize($this->cssID)[0];

			$GLOBALS['TL_JAVASCRIPT'][] = TL_SCRIPT_URL . 'system/modules/imagemenu/assets/ImageMenu.min.js|static';
			$GLOBALS['TL_CSS'][] = TL_SCRIPT_URL . 'system/modules/imagemenu/assets/ImageMenu-' . $this->id . '.css';

			$GLOBALS['TL_MOOTOOLS'][] = sprintf(<<<'EOT'
<script type="text/javascript">
window.addEvent("domready", function()
{
	var basicMenu = new ImageMenu($$("#%s ul li a"),
	{
		openWidth: %s,
		border: %s,
		duration: %s,
		open: %s,
		OnClickOpen: function(e,i)
		{
        	location.href = e;
        }
	});
});
</script>
EOT
,
				$cssID,
				deserialize($this->im_openWidth)['value'],
				deserialize($this->im_border)[2] ?: 2,
				$this->im_duration ?: 400,
				($this->im_openIfActive && $openId !== null) ? $openId : 'null'
			);
		}

		$this->Template->request = ampersand(\Environment::get('indexFreeRequest'));
		$this->Template->skipId = 'skipNavigation' . $this->id;
		$this->Template->skipNavigation = specialchars($GLOBALS['TL_LANG']['MSC']['skipNavigation']);
		$this->Template->items = $this->renderNavigation($trail[$level]);
	}
}
