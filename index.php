<?php 
/**
 *	Pixel-Gyro
 *	
 *	This script searches for all images in a given directory and displays them as seperate pages.
 *	Great for presenting mockups.
 *	
 *	Published under MIT License
 *
 *	Copyright (c) 2013 by Patrick Heck (patrick@patrickheck.de)
 *	
 *	Permission is hereby granted, free of charge, to any person obtaining a copy of this software and
 *	associated documentation files (the "Software"), to deal in the Software without restriction,
 *	including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
 *	and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so,
 *	subject to the following conditions:
 *	
 *	The above copyright notice and this permission notice shall be included in all copies or substantial
 *	portions of the Software.
 *	
 *	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT
 *	LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 *	IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 *	WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * @version 1.1
 * @author Patrick Heck (patrick@patrickheck.de)
 * @copyright Copyright (c) 2013 by Patrick Heck (patrick@patrickheck.de)
 * @license http://opensource.org/licenses/MIT
 * @link https://github.com/patrickheck/pixel-gyro
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

// how broad should the clickable area be?
if (! defined("SHOWNAV")) {
	define("SHOWNAV",true);
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
if ($n == 0) {
	$previndex = sizeof($files) - 1;
} else {
	$previndex = $n-1;
}

?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?=htmlentities(SITENAME,ENT_QUOTES,'UTF-8')?> :: <?=htmlentities(basename($imgpath,".".FILEEXTENSION),ENT_QUOTES,'UTF-8')?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/pixelgyro-bootstrap.css">
<style>
.slide {
	background: #fff url("<?=IMGSUBDIR?>/<?=rawurlencode(basename($imgpath))?>") center top repeat-x;
}
</style>
</head>
<body>
<?php if (SHOWNAV): ?>
<div class="navigation dark">
  <div class="container-fluid">
<div class="col-sm-2 col-xs-4 paging">
	<a href="<?php echo $_SERVER['PHP_SELF'] . '?n=' . $previndex ?>"><i class="fa fa-arrow-circle-left"></i></a>
	<span class="pagenumber"><?php echo $n+1 ?>/<?php echo sizeof($files) ?></span>
	<a href="<?php echo $_SERVER['PHP_SELF'] . '?n=' . $nextindex ?>"><i class="fa fa-arrow-circle-right"></i></a>
</div>
<div class="col-xs-8 col-sm-10">
	<strong><?=htmlentities(SITENAME,ENT_QUOTES,'UTF-8')?></strong> :
	
	<?=htmlentities(basename($imgpath,".".FILEEXTENSION),ENT_QUOTES,'UTF-8')?>
<button type="button" class="close" aria-hidden="true">&times;</button>
</div>
</div>
</div>
<?php endif; ?>
<div class="slide <?=SHOWNAV?'with-nav':''?>">
<a title="Click for next image" href="<?php echo $_SERVER['PHP_SELF'] . '?n=' . $nextindex ?>"><img src="<?php echo $_SERVER['PHP_SELF'] . '?height=' . $imgheight ?>" /></a>
</div>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
