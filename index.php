<?php 
/*
	Pixel-Gyro 1.0
	
	This script searches for all images in a given directory and displays them as seperate pages.
	Great for presenting mockups.
	
	Published under MIT License

	Copyright (c) 2013 by Patrick Heck (patrick@patrickheck.de)
	
	Permission is hereby granted, free of charge, to any person obtaining a copy of this software and
	associated documentation files (the "Software"), to deal in the Software without restriction,
	including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
	and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so,
	subject to the following conditions:
	
	The above copyright notice and this permission notice shall be included in all copies or substantial
	portions of the Software.
	
	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT
	LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
	IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
	WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

*/

// You can set your own constants in a file called config.php
// otherwise defaults will be loaded below
if (file_exists('config.php')) {
    include 'config.php';
}

// What is the name of the website? This is used for the <title>.
if (! defined("SITENAME")) {
	define("SITENAME",basename(__DIR__));
}

// In which subdiretory to look for images?
if (! defined("IMGSUBDIR")) {
	define("IMGSUBDIR","img");
}

// What ending do the image files have?
if (! defined("FILEEXTENSION")) {
	define("FILEEXTENSION","png");
}

// how broad should the clickable area be?
if (! defined("CLICKABLEWIDTH")) {
	define("CLICKABLEWIDTH",1024);
}

/* if the "height" attribute is given return a transparent image instead of HTML
 * this is used to define the clickable area
 */
if (isset($_GET["height"]) && is_numeric($_GET["height"]) ) {
	header("Content-Type: image/png");
	// Set the image
	$img = imagecreatetruecolor(CLICKABLEWIDTH,$_GET["height"]);
	imagesavealpha($img, true);
	
	// Fill the image with transparent color
	$color = imagecolorallocatealpha($img,0x00,0x00,0x00,127);
	imagefill($img, 0, 0, $color);
	
	// create the image
	imagepng($img);
	
	// Destroy image
	imagedestroy($img);
	exit();
}

define("IMAGEDIR", dirname(__FILE__) . DIRECTORY_SEPARATOR . IMGSUBDIR);

if (isset($_GET["n"]) && is_numeric($_GET["n"])) {
	$n = $_GET["n"];
} else {
	$n = 0;
}

if (! is_dir(IMAGEDIR)) {
	die('Error: Directory can not be read. "'.IMAGEDIR.'"');
}
$files = glob(IMAGEDIR  . DIRECTORY_SEPARATOR . "*.".FILEEXTENSION);
if (count($files[$n]) == 0) {
	die('Error: No images found with the extension "'.FILEEXTENSION.'".');
}
if (isset($files[$n])) {
	$imgpath = $files[$n];
} else {
	$imgpath = $files[0];
}

$imgsize = getimagesize($imgpath);
$imgheight = $imgsize[1];

if (isset($files[$n+1])) {
	$nextindex = $n+1;
} else {
	$nextindex = 0;
}
?><html>
<head>
<meta charset="utf-8">
<title><?=htmlentities(SITENAME,ENT_QUOTES,'UTF-8')?> :: <?=htmlentities(basename($imgpath,".".FILEEXTENSION),ENT_QUOTES,'UTF-8')?></title>
<style>
body, html, img {
	margin:0;
	border:0;
	padding:0;
	outline:none;
}
body {
	background: #fff url("<?=IMGSUBDIR?>/<?=rawurlencode(basename($imgpath))?>") center top repeat-x;
	text-align:center;
	margin: 0 auto;
}
</style>
</head>
<body>
<a title="Click for next image" href="<?php echo $_SERVER['PHP_SELF'] . '?n=' . $nextindex ?>"><img src="<?php echo $_SERVER['PHP_SELF'] . '?height=' . $imgheight ?>" /></a>
</body>
</html>
