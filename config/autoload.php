<?php

/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'Contao\ModuleCdList' => 'system/modules/cd_collection/modules/ModuleCdList.php'
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_cdlist' => 'system/modules/cd_collection/templates/modules'
));
