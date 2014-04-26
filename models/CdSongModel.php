<?php

namespace Contao;

/**
 * Class CdSongModel
 *
 * Reads and writes CD songs.
 */
class CdSongModel extends \Model
{

    /**
     * Table name
     * @var string
     */
    protected static $strTable = 'tl_cds_song';


    /**
     * Find the songs by parent ID
     * @param integer
     * @return \Model|null
     */
    public static function findByParent($intPid)
    {
        $t = static::$strTable;

        $arrColumns = array("$t.pid=?");
        $arrValues = array($intPid);
        $arrOptions['order'] = "$t.sorting";

        return static::findBy($arrColumns, $arrValues, $arrOptions);
    }
}
