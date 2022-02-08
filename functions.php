<?php

// FUNCTION TO RESOLVE ASSETS

function getPath($file, $ext){
	if ($_SERVER['HTTP_HOST'] == 'webpack') {
		if ($ext == 'css') $folder = 'css/'; else $folder = '';
		$root = 'http://localhost:8080/assets/';
		return $root . $folder . $file . '.' . $ext;
	} else {
		// FOR WORDPRESS
		//$root = get_bloginfo('template_url');
		//$assets = json_decode(file_get_contents(str_replace(get_bloginfo('url'),'.',get_bloginfo('template_url')).'/assets/assets.json'));

		// FOR NON WORDPRESS
		$root = './';
		$assets = json_decode(file_get_contents('assets/assets.json'));
		
        return $root . $assets->$file->$ext;
	}
}

?>
