<?php

namespace App\Models;

class Rating 
{
    public static string $table = 'ratings';
    public string $id = '';
    public string $contentType;
    public string $contentId;
    public int $stars;

    public function __construct(array $data)
    {
        if (isset($data['id']) && $data['id']) 
            $this->id = $data['id'];   
        $this->contentType = $data['contentType'];
        $this->contentId = $data['contentId'];
        $this->stars = $data['stars'];
    }
}