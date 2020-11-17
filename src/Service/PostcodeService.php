<?php
namespace App\Service;

use App\Helpers\Common;
use Error;

class PostcodeService
{
    public function searchPostcode($searchedTerm)
    {
        $searchedTerm = strtoupper($searchedTerm);
        $filePath = Common::getProjectRootDir().'/data/m25Postcodes.md';
        $fileContents = file_get_contents($filePath);
        if(!Common::isJson($fileContents)){
            throw new Error('File is not valid json');
        }
        $postCodesArr = json_decode($fileContents);
        
        $isValidPostcode = array_reduce($postCodesArr, function ($contains, $item) use ($searchedTerm) {
            return $contains = $contains || (strpos($searchedTerm, $item) === 0);
        }, false);
        
        return $isValidPostcode ?? false;   
    }
}
