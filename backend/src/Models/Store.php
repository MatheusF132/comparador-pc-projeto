<?php

namespace App\Models;

class Store
{
    public string $id;
    public string $name;
    public ?string $logoUrl;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->logoUrl = $data['logo_url'] ?? null;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'logoUrl' => $this->logoUrl,
        ];
    }
}
