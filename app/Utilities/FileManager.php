<?php

namespace App\Utilities;




class FileManager
{
    //TODO:: optimize code
    protected static $coverDir= 'cover/';//For Cover Directory
    protected static $musicDir = 'mp3/';//For Music Files Directory

    public function __construct()
    {

    }



    public static function uploadMusic($music)
    {

        $directory = self::$musicDir ;
        $mainFileName = md5(microtime()) . '.' . $music->getClientOriginalExtension();
	    $music->move($directory, $mainFileName);
	    $directory = $directory . $mainFileName;
	    return $directory;
    }

	public static function uploadCover($cover)
	{
		$directory = self::$coverDir ;
		$mainFileName = md5(microtime()) . '.' . $cover->getClientOriginalExtension();
		$cover->move($directory, $mainFileName);
		$directory = $directory . $mainFileName;
		return $directory;
	}

    public static function directoryExists($subDirectory)
    {
        if (!(\File::isDirectory($subDirectory)))
            \File::makeDirectory($subDirectory);

    }

     public static function getRootDirectory($imageAddress)
    {
        return public_path($imageAddress);
    }

    public static function removeFile($address)
    {
        if ($address == "" || empty($address))
            return;
        \File::delete(self::getRootDirectory($address));
    }


}