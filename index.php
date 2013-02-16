<?php
/**
 * Use your favorite autoload routine here.
 */
function __autoload($class)  
{  
  $filename = str_replace('\\', '/', $class) . '.php';  
  @require_once 'classes/'.$filename;  
}

/**
 * Define a variable or constant that points to the image folder
 */
define('IMAGEPATH', dirname(__FILE__).'/image_placeholders/');

/**
 * Initialize the PlaceHolder object
 */
$placeholder = new \seydoggy\PlaceHolder(IMAGEPATH);