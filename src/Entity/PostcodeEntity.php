<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
class PostcodeEntity
{
    /**
     * @Assert\NotBlank
     */
    protected $searchedText;

    /**
     * Getter
     */
    public function getSearchedText()
    {
        return $this->searchedText;
    }

    /**
     * Setter
     */
    public function setSearchedText($searchedText)
    {
        $this->searchedText = $searchedText;
    }
}
