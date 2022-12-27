<?php

declare(strict_types=1);

namespace App\Services\Scraping\DTO;

class Ad
{
    public function __construct(
        private string $title,
        private string $description,
        private string $price,
        private string $image
    ) {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function getImage(): string
    {
        return $this->image;
    }
}
