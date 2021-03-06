<?php return array(
	
	/*
	|-----------------------------------------------------------------------------
	| Image source and crop destination
	|-----------------------------------------------------------------------------
	*/

	/**
	 * The directory where source images are found.  This is generally where your 
	 * admin stores uploaded files.  Can be either an absolute path to your local 
	 * disk (the default) or the name of an IoC binding of a Flysystem  instance.
	 *
	 * @var string     Absolute path in local fileystem
	 *      | string   IoC binding name of League\Flysystem\Filesystem 
	 *      | string   IoC binding name of League\Flysystem\Cached\CachedAdapter
	 */
	'src_dir' => public_path().'/images',

	/**
	 * The directory where cropped images should be saved.  The route to the 
	 * cropped versions is what should be rendered in your markup; it must be a 
	 * web accessible directory.
	 *
	 * @var string     Absolute path in local fileystem
	 *      | string   IoC binding name of League\Flysystem\Filesystem 
	 *      | string   IoC binding name of League\Flysystem\Cached\CachedAdapter
	 */
	'crops_dir' => public_path().'/images',

	/**
	 * Maximum number of sizes to allow for a particular source file.  This is to 
	 * limit scripts from filling up your hard drive with images.  Set to falsey or 
	 * comment out to have no limit.
	 *
	 * @var integer | boolean
	 */
	'max_crops' => 12,


	/*
	|-----------------------------------------------------------------------------
	| URL parsing and generation
	|-----------------------------------------------------------------------------
	*/

	/**
	 * A regex pattern that compares against the Request path (`Request::path()`) 
	 * to find the image path to the image relative to the crops_dir. This path 
	 * will be used to find the source image in the src_dir. The path component of 
	 * the regex must exist in the first captured subpattern.  In other words, in 
	 * the `preg_match` $matches[1].
	 *
	 * @var string 
	 */
	'path' => 'images/(.*)$',

	/**
	 * A regex pattern that works like `path` except it is only used by the
	 * `Croppa::url($url)` generator function.  If the $path url matches, it is
	 * passed through with no Croppa URL suffixes added.  Thus, it will not be
	 * cropped.  This is designed, in particular, for animated gifs which lose 
	 * animation when cropped.
	 * 
	 * @var string 
	 */
	'ignore' => '\.(gif|GIF)$',

	/**
	 * A string that is prepended to the path captured by the `path` pattern
	 * (above) that is used to from the URL to crops.
	 */
	// 'url_prefix' =>  '//'.Request::getHttpHost().'/uploads/',        // Local
	// 'url_prefix' => 'https://your-bucket.s3.amazonaws.com/uploads/', // S3


	/*
	|-----------------------------------------------------------------------------
	| Image settings
	|-----------------------------------------------------------------------------
	*/

	/**
	 * The jpeg quality of generated images.  The difference between 100 and 95 
	 * usually cuts the file size in half.  Going down to 70 looks ok on photos 
	 * and will reduce filesize by more than another half but on vector files 
	 * there is noticeable aliasing.
	 *
	 * @var integer
	 */
	'jpeg_quality' => 95,

	/**
	 * Turn on interlacing to make progessive jpegs
	 *
	 * @var boolean
	 */
	'interlace' => true,
	
);