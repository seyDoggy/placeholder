# The Random Image PlaceHolder #
**AUTHOR: Adam Merrifield**
**VERSION: 1.0.0**

## Overview ##

The SimpleImage PlaceHolder class allows you to self host a random image placeholder engine to fill your in-development sites and mockups with real, random images instead of boring gray boxes. This class extends [my fork](https://github.com/seyDoggy/SimpleImage) of the SimpleImage Class by Cory LaViska and is intended as a web developer aid to generate temporary, random placeholder images.

You can use your own images or any freely available creative commons images. Use as many as you like — obviously the more you use, the more random and varied the engine will be. It doesn't matter what size, aspect ratio or orientation you use, PlaceHolder will work out the best fit when generating the placeholder image.

## Requirements ##

* PHP 5.3 or higher
* PHP GD library
* [SimpleImage](https://github.com/seyDoggy/SimpleImage)

## Installation ##

1. You'll need a dedicated domain, sub-domain or folder with which to store the app in.
2. FTP/SSH into your domain and drop in the:
	* .htaccess file,
	* the index.php file
	* the images folder (filled with your own images)
	* the classes folder containing both the [SimpleImage](https://github.com/seyDoggy/SimpleImage) class (not included here) and the PlaceHolder class that extends it.

## Usage ##

### Basics ###

Make a request of your new PlaceHolder engine with a minimum or 2 parameters — width then height — separated by a dash. Like this, `http://image.domain.url/600-400`.

In an HTML img tag it'd look like this:

	<img src="http://image.domain.url/600-400" alt="some random image">

Or a CSS background would look like this:

	.header {
		background: #000 url(http://image.domain.url/960-200) center center no-repeat;
	}

### Fun Tricks ###

There is also an optional third parameter which will perform a few modifications to the generated image.

* `bw` will render the random image in black and white:

		<img src="http://image.domain.url/600-400-bw" alt="some random image">

* `sepia` will render the random image in sepia tones:

		<img src="http://image.domain.url/600-400-sepia" alt="some random image">

* `sketch` will render the random image in with sharpness turned up to give sketched effect (meh):

		<img src="http://image.domain.url/600-400-sketch" alt="some random image">

* `pixelate` will render the random image pixelated beyond recognition (pretty cool):

		<img src="http://image.domain.url/600-400-pixelate alt="some random image">

* `random` will render the random image with any one of the above effects:

		<img src="http://image.domain.url/600-400-random" alt="some random image">

### Avoiding Duplicates ###

Chances are you are going to have multiple requests of the same size image on the the same page. If the request is identical then the image be identical too. The easy way around this to make each request unique, either with a third or even a fourth parameter. The third parameter can be any one of the supported keywords or it can be any made up identifier. And if you do use a supported keyword, then simply use a pseudo forth parameter with any made up identifier.

The following examples will all render unique images, all with the same 200px X 100px dimension:

	<img src="http://image.domain.url/200-100" alt="some random image">
	<img src="http://image.domain.url/200-100-0" alt="some random image">
	<img src="http://image.domain.url/200-100-0-1" alt="some random image">
	<img src="http://image.domain.url/200-100-small" alt="some random image">
	<img src="http://image.domain.url/200-100-small2" alt="some random image">
	<img src="http://image.domain.url/200-100-small-2" alt="some random image">
	<img src="http://image.domain.url/200-100-bw" alt="some random image">
	<img src="http://image.domain.url/200-100-bw-small" alt="some random image">
	<img src="http://image.domain.url/200-100-random" alt="some random image">
	<img src="http://image.domain.url/200-100-random-1" alt="some random image">

Similarly the following CSS examples will all render unique images, all with the same 960px X 200px dimension:

	.slider1 {
		background: #000 url(http://image.domain.url/960-200-slider-1) center center no-repeat;
	}
	.slider2 {
		background: #000 url(http://image.domain.url/960-200-slider-2) center center no-repeat;
	}
	.slider3 {
		background: #000 url(http://image.domain.url/960-200-slider-3) center center no-repeat;
	}
	.slider4 {
		background: #000 url(http://image.domain.url/960-200-slider-4) center center no-repeat;
	}
	.slider5 {
		background: #000 url(http://image.domain.url/960-200-slider-5) center center no-repeat;
	}

## Contribute! ##

I like to hack about in PHP but I am by no means an expert. I've tried to conform to what I understand as the best phpdoc, namespace and overall OOP practices but I understand there is likely to be huge room for improvement in my code. So please help me out, fork the code, submit pull requests, issue bug reports, whatever... if you use this code then share your thoughts.