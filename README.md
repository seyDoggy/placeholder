# The Random Image PlaceHolder
**AUTHOR: [Adam Merrifield](https://adam.merrifield.ca)**   

## Overview

The SimpleImage PlaceHolder class allows you to self host a random image placeholder engine to fill your in-development sites and mockups with real, random images instead of boring gray boxes. This class extends [SimpleImage](https://github.com/claviska/SimpleImage) by Cory LaViska and is intended as an aid for web developers generate temporary, random placeholder images.

You can use your own images or any freely available creative commons images. Use as many as you like — obviously the more you use, the more random and varied the engine will be. It doesn't matter what size, aspect ratio or orientation you use, PlaceHolder will work out the best fit when generating the placeholder image.

<hr id="Requirements">

## Requirements

* PHP 5.6+
* [SimpleImage](https://github.com/claviska/SimpleImage) (composer should take care of that)

<hr id="Installation">

## Installation

Install with Composer:

```sh
composer require seydoggy/placeholder
```

<hr id="GettingStarted">

## Getting Started

1. The example folder contains a `.htaccess` file, and images folder and an `index.php` file.
1. Copy these files to the public location of your domain/sub-domain.
1. Use composer to install PlaceHolder:

    ```sh
    composer require seydoggy/placeholder
    ```

NOTE: the .htaccess and index.php contain just enough to get you going and the folder names, paths and namespaces are arbitrary. Consider them examples of what you need at a minimum but are by no means set in stone. Change the paths and namespaces to suit your current setup. If you are pretty new at all this, consider getting PlaceHolder running all on its own in a dedicated sub-domain before trying to run it in a folder on your main domain.

<hr id="Usage">

## Usage ##

### Basics ###

Make a request of your new PlaceHolder engine with a minimum of 2 parameters — width then height — separated by a dash. Like this, `http://image.domain.url/600-400`.

In an HTML img tag it'd look like this:

```html
<img src="http://image.domain.url/600-400" alt="some random image">
```

Or a CSS background would look like this:

```css
.header {
    background: #000 url(http://image.domain.url/960-200) center center no-repeat;
}
```

### Fun Tricks ###

There is also an optional third parameter which will perform a few modifications to the generated image.

* Introducing square image handling, example:

    ```html
    <img src="http://image.domain.url/400" alt="some random image">
    ```
        
* `bw` will render the random image in black and white:

    ```html
    <img src="http://image.domain.url/600-400-bw" alt="some random image">
    ```

* `sepia` will render the random image in sepia tones:

    ```html
    <img src="http://image.domain.url/600-400-sepia" alt="some random image">
    ```

* `sketch` will render the random image in with sharpness turned up to give a sketched effect (meh):

    ```html
    <img src="http://image.domain.url/600-400-sketch" alt="some random image">
    ```

* `pixelate` will render the random image pixelated beyond recognition (pretty cool):

    ```html
    <img src="http://image.domain.url/600-400-pixelate alt="some random image">
    ```

* `random` will render the random image with any one of the above effects:

    ```html
    <img src="http://image.domain.url/600-400-random" alt="some random image">
    ```

### Avoiding Duplicates ###

Chances are you are going to have multiple requests of the same size image on the the same page. If the request is identical then the image will be identical too. The easy way around this to make each request unique, either with a third or even a fourth parameter. The third parameter can be any one of the supported keywords or it can be any made up identifier. And if you do use a supported keyword, then simply use a pseudo forth parameter with any made up identifier.

The following examples will all render unique images, all with the same 200px X 100px dimension:

```html
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
```

Similarly the following CSS examples will all render unique images, all with the same 960px X 200px dimension:

```css
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
```


<hr id="Action">

## See It In Action ##

I've made a special page for PlaceHolder so you can see it in action. Every image on the page (including the slider at the top) is generated with PlaceHolder. Under each example is the code used to request each image. Go [check it out][examples]!

<hr id="Contribute">

## Contribute! ##

I like to hack about in PHP but I am by no means an expert. I've tried to conform to what I understand as the best phpdoc, namespace and overall OOP practices but I understand there is likely to be huge room for improvement in my code. So please help me out, fork the code, submit pull requests, issue bug reports, whatever... if you use this code then share your thoughts.

[Skip to installation]: #Installation
[examples]: http://placeholder.seydoggy.com/examples/ "PlaceHolder examples"
