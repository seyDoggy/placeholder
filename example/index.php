<?php
/**
 * Assuming you've installed PlaceHolder via composer, i.e.
 * `composer require seydoggy/placeholder`
 * Then you should be able to access your classes by requiring the composer
 * autoloader file.
 */
require __DIR__ . '/vendor/autoload.php';

/**
 * Define a variable or constant that points to the image folder
 */
define('IMAGEPATH', dirname(__FILE__).'/image_placeholders/');

/**
 * Initialize the PlaceHolder object
 */
$placeholder = new \seydoggy\PlaceHolder(IMAGEPATH);
