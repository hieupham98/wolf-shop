<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $fillable = ['name', 'sellIn', 'quality', 'imgUrl'];

    protected $casts = [
        'sellIn' => 'integer',
        'quality' => 'integer',
    ];

    public function __toString(): string
    {
        return "{$this->name}, {$this->sellIn}, {$this->quality}";
    }

    public function getImgUrl(): string
    {
        return $this->imgUrl ?? '';
    }

    public function setImgUrl(string $imgUrl): self
    {
        $this->imgUrl = $imgUrl;
        return $this;
    }
}
