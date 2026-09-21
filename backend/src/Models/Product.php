<?php

namespace App\Models;

class Product
{
    public string $id;
    public string $name;
    public ?string $description;
    public ?string $imageUrl;
    public ?string $category;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->description = $data['description'] ?? null;
        $this->imageUrl = $data['image_url'] ?? null;
        $this->category = $data['category'] ?? null;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'imageUrl' => $this->imageUrl,
            'category' => $this->category,
        ];
    }
}
