<?php

/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
    // Models
	'Contao\CdModel'        => 'system/modules/cd_collection/models/CdModel.php',
	'Contao\CdSongModel'    => 'system/modules/cd_collection/models/CdSongModel.php',
	
	// Modules
	'Contao\ModuleCdList'   => 'system/modules/cd_collection/modules/ModuleCdList.php',
	'Contao\ModuleCdReader' => 'system/modules/cd_collection/modules/ModuleCdReader.php'
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_cdlist'   => 'system/modules/cd_collection/templates/modules',
	'mod_cdreader' => 'system/modules/cd_collection/templates/modules'
));
