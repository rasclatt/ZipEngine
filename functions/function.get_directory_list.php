<?php
	function get_directory_list($settings = false)
		{
			$directory		=	(!empty($settings['dir']))? $settings['dir']:CLIENT_DIR."/";

			$array			=	array();
			$array['dirs']	=	array();
			$array['host']	=	array();
			$array['root']	=	array();
			
			if(!is_dir($directory))
				return false;
			
			$dir			=	new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory),RecursiveIteratorIterator::CHILD_FIRST);
					
			// Loop through directories
			while($dir->valid()) {
					try {
							$file = $dir->current();
							
							ob_start();
							echo $file;
							$data	=	ob_get_contents();
							ob_end_clean();
							$data	=	trim($data);
							if(basename($data) != '.' && basename($data) != '..') {
									$array['host'][]	=	$data;
									$array['root'][]	=	str_replace(ROOT_DIR,"",$data);
									if(is_dir($data) && !in_array($data."/",$array['dirs'])) {
											$array['dirs'][]	=	$data."/";
										}
								}
							unset($data);
							$dir->next();
						}
					catch (UnexpectedValueException $e) {
							continue;
						}
				}
			
			return (isset($array))? $array:false;
		}
