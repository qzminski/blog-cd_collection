<?php

/**
 * Back end modules
 */
array_insert($GLOBALS['BE_MOD']['content'], 1, array
(
	'cd_collection' => array
	(
		'tables' => array('tl_cds', 'tl_cds_song'),
		'icon'   => 'system/modules/cd_collection/assets/icon.png'
	)
));


/**
 * Front end modules
 */
$GLOBALS['FE_MOD']['miscellaneous']['cd_list']   = 'ModuleCdList';
$GLOBALS['FE_MOD']['miscellaneous']['cd_reader'] = 'ModuleCdReader';
