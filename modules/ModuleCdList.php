<?php

namespace Contao;

/**
 * Class ModuleCdList
 *
 * Front end module "cd list".
 */
class ModuleCdList extends \Module
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_cdlist';


	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new \BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['cd_list'][0]) . ' ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		return parent::generate();
	}


	/**
	 * Generate the module
	 */
	protected function compile()
	{
		$objCds = $this->Database->execute("SELECT * FROM tl_cds");

		// Return if no CDs were found
		if (!$objCds->numRows)
		{
			return;
		}

		$arrCds = array();

		// Generate CDs
		while ($objCds->next())
		{
			$strCover = '';
			$objCover = \FilesModel::findByPk($objCds->cover);

			// Add cover image
			if ($objCover !== null)
			{
				$strCover = \Image::getHtml(\Image::get($objCover->path, '100', '100', 'center_center'));
			}

			$arrCds[] = array
			(
				'title' => $objCds->title,
				'artist' => $objCds->artist,
				'genre' => $objCds->genre,
				'year' => $objCds->year,
				'cover' => $strCover,
				'description' => $objCds->description
			);
		}

		$this->Template->cds = $arrCds;
	}
}
