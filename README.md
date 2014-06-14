# The Random Image PlaceHolder #
**AUTHOR: [Adam Merrifield][theme developer]**   
**VERSION: [1.0.2][PlaceHolder]**

[Skip to installation][]

## Overview ##

The SimpleImage PlaceHolder class allows you to self host a random image placeholder engine to fill your in-development sites and mockups with real, random images instead of boring gray boxes. This class extends [my fork](https://github.com/seyDoggy/SimpleImage) of the SimpleImage Class by Cory LaViska and is intended as a web developer aid to generate temporary, random placeholder images.

You can use your own images or any freely available creative commons images. Use as many as you like — obviously the more you use, the more random and varied the engine will be. It doesn't matter what size, aspect ratio or orientation you use, PlaceHolder will work out the best fit when generating the placeholder image.

### Why did I make PlaceHolder? ###

I am a [theme developer][] by day and make a [lot][Sytten] [of][tre3rty] [demo][Copper] [sites][Nuvem]. I am forever moving and changing images to keep things fresh but not without inevitably breaking or losing an image or two along the way. I wanted an image placeholder solution that would let me update or remove images without worrying about naming scheme, file type or having to update countless demo sites. I also want a variety of styles and sizes in my demo sites without the need for duplicate images for each variation. PlaceHolder takes care of all my style and sizing needs and I don't have to worry about naming conventions, saving for web, image type or getting any broken image links.

### Why Server-side? ###

Simply put, server-side is faster and more powerful and far more efficient. While some of the client-side JavaScript solutions, jQuery plugins included, might seem easier to add to a page on a one off basis, consider how their poor performance looks to your customer when they're trying to view your progress on their "big site".

What you request is what you get. With PlaceHolder, when you request an image that is 370px x 130px, for instance, you are serving up an image that is 370px x 130px. Period. That's about 15KB worth of image and no unnecessary client-side overhead.

The reality is, once you have your own random image server set up, you'll use it across all of your mockup work.

### Why Extend SimpleImage? ###

Why reinvent the wheel? I didn't set out to make any of this in the first place. I found SimpleImage while on my quest for a random image placeholder. While it wasn't the solution I needed, it did have a lot of great features I could use if I were to make my own placeholder engine... and here we are.

<hr id="Requirements">

## Requirements ##

* PHP 5.3 or higher
* PHP GD library (bundled in PHP since 4.3 so you're probably good)
* [SimpleImage](https://github.com/seyDoggy/SimpleImage)

<hr id="Installation">

## Installation ##

1. Clone [PlaceHolder][].
2. Set up a dedicated domain, sub-domain or folder with which to store PlaceHolder.
3. FTP/SSH into your domain/sub-domain/folder and drop in the:
    * .htaccess file,
    * the index.php file
    * the images folder (filled with your own images)
    * the classes folder containing both the [SimpleImage](https://github.com/seyDoggy/SimpleImage) class (not included here) and the PlaceHolder class that extends it.

NOTE: the .htaccess and index.php contain just enough to get you going and the folder names, paths and namespaces are arbitrary. Consider them examples of what you need at a minimum but are by no means set in stone. Change the paths and namespaces to suit your current setup. If you are pretty new at all this, consider getting PlaceHolder running all on its own in a dedicated sub-domain before trying to run it in a folder on your main domain.

NOTE^2: the namespace for both my fork of SimpleImage and PlaceHolder are set to 'seydoggy' in keeping with the php-fig PSR-0 standard of `\<Vendor Name>\(<Namespace>\)*<Class Name>`. If you have a class heirarchy that suits you better then have at it.

<hr id="Usage">

## Usage ##

### Basics ###

Make a request of your new PlaceHolder engine with a minimum of 2 parameters — width then height — separated by a dash. Like this, `http://image.domain.url/600-400`.

In an HTML img tag it'd look like this:

    <img src="http://image.domain.url/600-400" alt="some random image">

Or a CSS background would look like this:

    .header {
        background: #000 url(http://image.domain.url/960-200) center center no-repeat;
    }

### Fun Tricks ###

There is also an optional third parameter which will perform a few modifications to the generated image.

* Introducing square image handling, example:

        <img src="http://image.domain.url/400" alt="some random image">
        
* `bw` will render the random image in black and white:

        <img src="http://image.domain.url/600-400-bw" alt="some random image">

* `sepia` will render the random image in sepia tones:

        <img src="http://image.domain.url/600-400-sepia" alt="some random image">

* `sketch` will render the random image in with sharpness turned up to give a sketched effect (meh):

        <img src="http://image.domain.url/600-400-sketch" alt="some random image">

* `pixelate` will render the random image pixelated beyond recognition (pretty cool):

        <img src="http://image.domain.url/600-400-pixelate alt="some random image">

* `random` will render the random image with any one of the above effects:

        <img src="http://image.domain.url/600-400-random" alt="some random image">

### Avoiding Duplicates ###

Chances are you are going to have multiple requests of the same size image on the the same page. If the request is identical then the image will be identical too. The easy way around this to make each request unique, either with a third or even a fourth parameter. The third parameter can be any one of the supported keywords or it can be any made up identifier. And if you do use a supported keyword, then simply use a pseudo forth parameter with any made up identifier.

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

<hr id="Action">

## See It In Action ##

I've made a special page for PlaceHolder so you can see it in action. Every image on the page (including the slider at the top) is generated with PlaceHolder. Under each example is the code used to request each image. Go [check it out][examples]!

<hr id="Changelog">

## Changelog ##
**1.0.1:** Added simple caching to reduce server load.

<hr id="Contribute">

## Contribute! ##

I like to hack about in PHP but I am by no means an expert. I've tried to conform to what I understand as the best phpdoc, namespace and overall OOP practices but I understand there is likely to be huge room for improvement in my code. So please help me out, fork the code, submit pull requests, issue bug reports, whatever... if you use this code then share your thoughts.

<hr id="plug">

## Made Possible by [seydesign.com][theme developer] ##

As I mentioned, my full time job is a theme developer at seydesign.com. I'd like to keep it that way so if I might be so bold as to make a plug... eh-hem!

[seydesign.com][theme developer], makers of RapidWeaver themes.

Thanks. I knew you would understand.

[Skip to installation]: #Installation
[theme developer]: http://seydesign.com "RapidWeaver themes by seydesign"
[Sytten]: http://showcase.seydesign.com/Sytten "Sytten RapidWeaver theme by seydesign"
[tre3rty]: http://showcase.seydesign.com/tre3rty "tre3rty RapidWeaver theme by seydesign"
[Copper]: http://showcase.seydesign.com/Copper "Copper RapidWeaver theme by seydesign"
[Nuvem]: http://showcase.seydesign.com/Nuvem "Nuvem RapidWeaver theme by seydesign"
[PlaceHolder]: https://github.com/seyDoggy/placeholder "PlaceHolder on GitHub"
[examples]: http://placeholder.seydoggy.com/examples/ "PlaceHolder examples"
