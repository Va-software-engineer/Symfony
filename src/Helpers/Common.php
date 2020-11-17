<?php

namespace App\Helpers;

class Common
{
    public static function getProjectRootDir()
    {
        $dirFullPath = __DIR__;

        //PRE: $dirs = /app/public/src/Helpers
        $dirs = explode('/', $dirFullPath);

        array_pop($dirs); //remove last element in array ('Helpers')
        array_pop($dirs); //remove the next last element from array ('src')

        //POST: $dirs = /app/public
        return implode('/', $dirs);
    }

   public static function isJson($str) {
        $json = json_decode($str);
        return $json && $str != $json;
    }
}
