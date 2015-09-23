<?php
  // Include the zip engine
	include_once(__DIR__.'/classes/ZipEngine.php');
	// Include the directory iterator
	include_once(__DIR__.'/functions/function.get_directory_list.php');
	// Save name
	$folder		=	'/zipfile.zip';
	// Retrieves the directory listing (recursive)
	$dir		=	get_directory_list(array("dir"=>__DIR__.'/myflies/'));
	// Creates a saveto folder
	$ZipEngine	=	new ZipEngine(__DIR__.'/crashcart/');
	// Adds all the files from the "myfiles" folder and adds them to an archive
	foreach($dir['host'] as $docs) {
			if(is_file($docs))
				$ZipEngine->AddFiles($docs);
		}
	// Stores them on the server
	$ZipEngine->ZipAndStore($folder);
	// Alternatively you can download them
	// $ZipEngine->DownloadZip();
