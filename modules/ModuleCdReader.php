<?php

namespace Contao;

/**
 * Class ModuleCdReader
 *
 * Front end module "cd reader".
 */
class ModuleCdReader extends \Module
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_cdreader';


	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new \BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['cd_reader'][0]) . ' ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		// Return if there are no items
		if (!\Input::get('items'))
		{
			return '';
		}

		return parent::generate();
	}


	/**
	 * Generate the module
	 */
	protected function compile()
	{
		$objCd = $this->Database->prepare("SELECT *, (SELECT COUNT(*) FROM tl_cds_song WHERE tl_cds_song.pid=tl_cds.id) AS songs FROM tl_cds WHERE id=?")
								->limit(1)
								->execute(\Input::get('items'));

		// Display a 404 page if the CD was not found
		if (!$objCd->numRows)
		{
			global $objPage;
			$objHandler = new $GLOBALS['TL_PTY']['error_404']();
			$objHandler->generate($objPage->id);
		}

		$this->Template->title = $objCd->title;
		$this->Template->artist = $objCd->artist;
		$this->Template->year = $objCd->year;
		$this->Template->genre = $objCd->genre;
		$this->Template->description = $objCd->description;
		$objCover = \FilesModel::findByPk($objCd->cover);

		// Add cover image
		if ($objCover !== null)
		{
			$this->Template->cover = \Image::getHtml(\Image::get($objCover->path, '100', '100', 'center_center'));
		}

		// Return if there are no songs
		if (!$objCd->songs)
		{
			return;
		}

		$count = 0;
		$arrSongs = array();
		$objSongs = $this->Database->prepare("SELECT * FROM tl_cds_song WHERE pid=? ORDER BY sorting")
								   ->execute($objCd->id);

		// Generate songs
		while ($objSongs->next())
		{
			$arrSongs[] = array
			(
				'number' => ++$count,
				'title' => $objSongs->title,
				'duration' => $objSongs->duration
			);
		}

		$this->Template->songs = $arrSongs;
		$this->Template->numberLabel = $GLOBALS['TL_LANG']['MSC']['song_number'];
		$this->Template->titleLabel = $GLOBALS['TL_LANG']['MSC']['song_title'];
		$this->Template->durationLabel = $GLOBALS['TL_LANG']['MSC']['song_duration'];
	}
}
