<?php

namespace App\DataTransferObjects;

class UploadDto
{
    public $width;
    public $height;
    public $url;
    public $alt;

    function __construct($width, $height, $url, $alt) {
        $this->width = $width;
        $this->height = $height;
        $this->url = $url;
        $this->alt= $alt;
    }
}
