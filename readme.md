# Pixel-Gyro 1.1

This script searches for all images in a given directory and displays them as seperate pages.
Great for presenting mockups. The center of the page will be clickable and link to the next image.
So the user gets a good impression what the final website will look like at different screen sizes.

The images themselves will be used as background, while the script will generate a transparent
png that's put on top and serves as clickable area. This transparent image will have the 
exact same height as the image underneath and a width that can be set in the config. 
(Default is 1024px.) 

## Usage
* Clone repository to a web directory
* Drop all your images in "png" format inside the "img" folder.
  (You can also use "jpg", but you have to specify it in your config)
  Your images should be broad enough for large screens (e.g. 2000 x 2000 px)
* Now navigate to the directory with your browser. Done.

## Configuration

You can set your own configuration in a config.php file. Just create it and set any of the
following constants:

    // What is the name of the website? This is used for the <title>.
    define("SITENAME","Pixel-Gyro");
    
    // In which subdiretory to look for images?
    define("IMGSUBDIR","img");
    
    // What ending do the image files have?
    define("FILEEXTENSION","png");
    
    // How broad should the clickable area be?
    define("CLICKABLEWIDTH",1024);

    // Show Navigation Bar on Top?
    define("SHOWNAV",true);

	## Licence

The MIT License (MIT)

Copyright (c) 2013 Patrick Heck (patrick@patrickheck.de)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
