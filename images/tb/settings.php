<?php

class Conf {
  public static $qaulity = array('png'=>9, 'jpeg'=>80);
  public static $orig = '..';
  public static $max_width = 1000;
  public static $max_height = 1000;
  public static $aspect_handling = 2; // 0 stretch, 1 pad, 2 crop
  public static $sizes = array(
  
	// small
	"80x80"=>true,
	"120x120"=>true,
	"200x200"=>true,
	"250x250"=>true,
	"250x250"=>true,
	
	// meduim
	"480x480"=>true,
	"620x620"=>true,
	
	//... your custom sizes
  
  
  // Watermark
  // "480x480"=>array(
    // array("watermark-corner.png", 1.0, 1.0), // file x-percent y-percent x-margin y-margin
    // array("watermark-center.png", 0.5, 0.5),
    // "watermark-tile.png", // tile
  // ),
  // "480x480_c"=>array(
    // see http://php.net/manual/en/function.imagefilter.php for list of supported filters
    // array("filter", IMG_FILTER_GRAYSCALE),
    // array("closed.png", 1.0, 1.0),
  // ) 
  );
}