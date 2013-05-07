# Pixel-Gyro 1.0

This script searches for all images in a given directory and displays them as seperate pages.
Great for presenting mockups. The center of the page will be clickable and link to the next image.

## Usage
* Copy repository content to a web directory
* Drop all your images in "png" format inside the "img" folder
* Now navigate to the directory with your browser. Done.

## Configuration

You can set your own configuration in a config.php file. Just create it and set any of the
following constants:

    // What is the name of the website? This is used for the <title>.
    define("SITENAME","");
    
    // In which subdiretory to look for images?
    define("IMGSUBDIR","img");
    
    // What ending do the image files have?
    define("FILEEXTENSION","png");
    
    // how broad should the clickable area be?
    define("CLICKABLEWIDTH",1024);
