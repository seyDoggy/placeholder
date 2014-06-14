<?php
/**
 * PlaceHolder - Generates random placeholder image
 *
 * A SimpleImage class extension that allows random image requests
 * and generation, ideal for use in web work where placeholder images
 * are required.
 *
 * PHP version 5.3+
 *
 * LICENSE: This source file is subject to both MIT and GPLv2 licenses
 * that are available through the world-wide-web at the following URIs:
 * http://opensource.org/licenses/MIT.
 * http://www.gnu.org/licenses/gpl-2.0.html 
 *
 * @package    SimpleImage
 * @author     Cory LaViska
 * @author     Adam Merrifield <macagp@gmail.com>
 * @copyright  2013 Adam Merrifield
 * @license    Dual http://opensource.org/licenses/MIT MIT and  http://www.gnu.org/licenses/gpl-2.0.html GPLv2
 * @version    2.0.0
 * @since      2.0.0
 * @link       https://github.com/seyDoggy/SimpleImage
 * @see        SimpleImage, seydoggy\SimpleImage()
 */

namespace seydoggy;

/**
 * Generates random placeholder image
 *
 * A SimpleImage class extension that allows random image requests
 * and generation, ideal for use in web work where placeholder images
 * are required.
 *
 * @package    PlaceHolder
 * @author     Adam Merrifield <macagp@gmail.com>
 * @copyright  Adam Merrifield
 * @license    Dual http://opensource.org/licenses/MIT MIT and  http://www.gnu.org/licenses/gpl-2.0.html GPLv2
 * @version    1.0.2
 * @link       https://github.com/seyDoggy/Simple_Image_PlaceHolder
 * @see        SimpleImage, seydoggy\SimpleImage()
 * @since      Class available since Release 1.0.0
 */
class PlaceHolder extends \seydoggy\SimpleImage
{
	/**
	 * Holds the value of the path argument passed to of constructor.
	 * @access private
	 * @var string
	 */
	private $imageFolder;
	
	/**
	 * Handler for opening the image folder
	 * @see $imageFolder
	 * @access private
	 * @var mixed
	 */
	private $folderHandler;
	
	/**
	 * Parameters passed in the URI
	 * @access private
	 * @var array
	 */
	private $parameters;

	/**
	 * Setting for the desired width as set in parsed $parameters
	 * @see parameters
	 * @access private
	 * @var int
	 */
	private $width;

	/**
	 * Setting for the desired height as set in parsed $parameters
	 * @see parameters
	 * @access private
	 * @var int
	 */
	private $height;

	/**
	 * Setting for the desired effect as set in parsed $parameters
	 * @see parameters
	 * @access private
	 * @var mixed
	 */
	private $effect;

	/**
	 * Set by looking through the image folder for images
	 * @see $imageFolder, $folderHandler
	 * @access private
	 * @var array
	 */
	private $images;

	/**
	 * The file to store array of images found in the directory
	 * @see imageCache(), randomImage(), $imageFolder
	 * @access private
	 * @var mixed
	 */
	private $cacheFile;

	/**
	 * The number of hours to cache the image folder for
	 * @see imageCache(), randomImage()
	 * @access private
	 * @var mixed
	 */
	private $cacheHours = 24;

	/**
	 * temporary variable for a random array value
	 * @see getRandomImage(), $images
	 * @access private
	 * @var int
	 */
	private $num;

	/**
	 * holds the random image path
	 * @see getRandomImage(), $images
	 * @access private
	 * @var string
	 */
	private $image;

	/**
	 * holds the effects array
	 * @see createPlaceHolderImage()
	 * @access private
	 * @var array
	 */
	private $effects = array(
		'',
		'bw',
		'sepia',
		'pixelate',
		'sketch',
		);



	/**
	 * Constructs the PlaceHolder object
	 * @param string $path the uri to the image folder
	 * @return mixed the variables and functions declared for later use.
	 * @throws showMessage() if $_GET['parameter'] is not set or parameters array is not set or adequate the constructor will exit. 
	 * @access public
	 */
	public function __construct($path = null) {
		
		$this->imageFolder = $path;

		if (!is_dir($this->imageFolder) || !is_writable($this->imageFolder)) {

			die($this->showMessage('path'));

		}

		if (isset($_GET['parameter'])) {

			$this->parameters = explode('-',$_GET['parameter']);

		    if (is_array($this->parameters) && count($this->parameters) >= 1){
				
				if (is_numeric($this->parameters[0]) && is_numeric($this->parameters[1])) {

					if ($this->parameters[0] >= 16 && $this->parameters[1] >= 16) {
						
						$this->width = $this->parameters[0];

						$this->height = $this->parameters[1];

					} else {

						die($this->showMessage('min'));

					}

			    } elseif (is_numeric($this->parameters[0])){
			    	if ($this->parameters[0] >= 16) {
						
						$this->width = $this->parameters[0];

						$this->height = $this->parameters[0];

					} else {

						die($this->showMessage('min'));

					}
			    } else {

			    	die($this->showMessage('nan'));

			    }

			    if (count($this->parameters) > 2) {
				    $this->effect = $this->parameters[2];
			    } elseif (!is_numeric($this->parameters[1])) {
			    	$this->effect = $this->parameters[1];
			    }

		    } else {

		    	die($this->showMessage('param'));

		    }

			/**
		     * Invoke the createPlaceHolderImage function
		     */
		    $this->createPlaceHolderImage($this->width,$this->height);

		    exit;

		} else {

			die($this->showMessage('param'));

		}
	}

	/**
	 * Finds a random image path from an image folder
	 * @return string the path to the image to be manipulated
	 * @access private
	 */
	private function getRandomImage() 
	{
		/**
		 * check to see if the cache file exists
		 */
		$this->cacheFile = $this->imageFolder.'/_images.cache';

		if (file_exists($this->cacheFile)) {
			$stats = stat($this->cacheFile);

			/**
			 * compare cache file mod time with current time
			 */
			if ($stats[9] > (time() - ((60 * 60) * $this->cacheHours))) {
				
				/**
				 * get json data from cache file
				 */
				$jsondata = file_get_contents($this->cacheFile);
				
				/**
				 * make images array from json data
				 */
				$this->images = json_decode($jsondata, true);

			} else {

				$this->imageCache();

			}

		} else {
			
			$this->imageCache();

		}

		/**
		 * pick a random array item number
		 */
		$this->num = array_rand($this->images);

		/**
		 * construct an array selection
		 */
		$this->image = $this->images[$this->num];

		return $this->imageFolder.$this->image;
	}

	/**
	 * Sets an image array and caches the results from the image folder
	 * @return array the images found in the image folder
	 * @access private
	 */
	private function imageCache()
	{
		/**
		 * open directory and read the filenames
		 */
		$this->folderHandler = opendir($this->imageFolder);

		while (false !== ($file = readdir($this->folderHandler))) {

			/**
			 * if file isn't this directory or its parent, add it to the images
			 */
			if ($file != "." && $file != "..") {
				/**
				 * checks for gif, jpg, png
				 */
	            if ( preg_match("/(\.gif|\.jpg|\.jpeg|\.png)$/", $file) ) {
	                $this->images[] = $file;
	            }

			}

		}
		
		/**
		 * write the cache file
		 */
   		file_put_contents($this->cacheFile, json_encode($this->images));

		/**
		 * close the handler
		 */
		closedir($this->folderHandler);

		return $this->images;
	}

	/**
	 * Creates and outputs the manipulated image
	 * @param string $width the width value parsed from the URI
	 * @param string $height the height value parsed from the URI
	 * @return string the final manipulated image
	 * @throws $e->getMessage() if Simple\Image\Obj is unable to load the image then the error is echoed.
	 * @access private
	 */
	private function createPlaceHolderImage($width, $height)
	{
		try {
			/**
			 * uses the load method from seydoggy\SimpleImage()
			 */
			$this->load($this->getRandomImage());
			
			/**
			 * set some garbage variables for ratio comparisons
			 */
			$getRatio = $this->get_width()/$this->get_height();
			$ratio = $width/$height;

			/**
			 * test the ratios to determine which axis will be a best fit
			 */
			if ($getRatio < $ratio) {
				$this->fit_to_width($width);
			} else {
				$this->fit_to_height($height);
			}

			/**
			 * unset garbage variables
			 */
			unset($getRatio,$ratio);

			/**
			 * crop image to size in exact center
			 */
			$this->crop(
				/**
				 * start x
				 */
				($this->get_width()-$width)/2,
				/**
				 * start y
				 */
				($this->get_height()-$height)/2,
				/**
				 * end x
				 */
				($this->get_width()+$width)/2,
				/**
				 * end y
				 */
				($this->get_height()+$height)/2
			);
			
			/**
			 * check for effects
			 */
			if ($this->effect != null) {

				/**
				 * check for random effect setting
				 */
				if ($this->effect == 'random') {

					$this->num = array_rand($this->effects);
					
					$this->effect = $this->effects[$this->num];
					
				}

				/**
				 * apply seydoggy\SimpleImage() manipulations
				 */
				switch ($this->effect) {
					case 'bw':
						$this->desaturate();
						break;

					case 'sepia':
						$this->sepia();
						break;

					case 'sketch':
						$this->sketch();
						break;

					case 'pixelate':
						$this->pixelate(8);
						break;
					
					default:
						
						break;
				}
				
			}
			
			/**
			 * output the final result using seydoggy\SimpleImage() output method
			 */
			$this->output();

		} catch(Exception $e) {
			
			echo 'Error: ' . $e->getMessage();

		}
	}

	/**
	 * Standard message to display to user regarding URI format.
	 * @return string echo's a message to the user
	 * @see showMessage()
	 * @access private
	 */
	private function showFormat()
	{
		echo "<p>Please enter at URI that contains at least a width and height parameter, like so:
				<p><a href=\"400-300\">".$_SERVER['HTTP_HOST']."/400-300</a>
				<p>Or for more excitement, try an additional parameter such as 'bw', 'sepia', 'sketch', 'pixelate' or 'random':
				<p><a href=\"400-300-random\">".$_SERVER['HTTP_HOST']."/400-300-random</a>";
	}

	/**
	 * Reports the error to the user
	 * @param string $message the value for the type of message to display
	 * @return string echo's a message to the user
	 * @access private
	 */
	private function showMessage($message)
	{
		switch ($message) {
			case 'path':
				echo "Sorry Dave, I cannot find or write to the images folder with the path:
						<p>\"$this->imageFolder\".
						<p>Please check your spelling and/or permissions and try again.";
				break;
			
			case 'param':
				echo "<p>Sorry Dave, I can't do that.";
				
				$this->showFormat();

				break;

			case 'nan':
				echo "<p>Sorry Dave, ";

				if (!is_numeric($this->parameters[0]) && !is_numeric($this->parameters[1])) {
					
					echo "\"<em>" . $this->parameters[0] . "</em>\" and \"<em>" . $this->parameters[1] . "</em>\" are not numbers.";
							
				} else {

					if (!is_numeric($this->parameters[0]) && is_numeric($this->parameters[1])) {
					
						echo "\"<em>" . $this->parameters[0] . "</em>\"";

					} else {

						echo "\"<em>" . $this->parameters[1] . "</em>\"";

					}

					echo " is not a number.";

				}

				echo "<p>I am unable to make an image that is \"" . $this->parameters[0] . "\" pixels wide and \"" . $this->parameters[1] . "\" pixels high. It does not compute.";
				
				$this->showFormat();

				break;

			case 'min':
				echo "<p>Sorry Dave, ";

				if ($this->parameters[0] < 16 && $this->parameters[1] < 16) {
					
					echo "\"<em>" . $this->parameters[0] . "</em>\" and \"<em>" . $this->parameters[1] . "</em>\" do";
							
				} else {
					
					if ($this->parameters[0] < 16 && !$this->parameters[1] < 16) {
						echo "\"<em>" . $this->parameters[0] . "</em>\"";
					} else {
						echo "\"<em>" . $this->parameters[1] . "</em>\"";
					}

					echo " does";
					
				}

				echo " not meet the minimum size requirement of 16.";
					
				$this->showFormat();

				break;

			default:
				echo "<p>Sorry Dave, the door is ajar.
						<p>If you do not try to hold your breath, exposure to space for approximately 30 seconds is unlikely to produce permanent injury. Holding your breath, however, is likely to damage your lungs and you'll have eardrum trouble if your Eustachian tubes are badly plugged up.
						<p>Theory predicts -- and my own human testing with the last crew confirms -- that exposure to vacuum causes no immediate injury. You will not explode. Your blood will not boil. You will not freeze. You will not instantly lose consciousness.
						<p>After 30 seconds, however, you will die a slow, silent death of unimaginable peace and tranquility.";
				break;
		}
	}
}
