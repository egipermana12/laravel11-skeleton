<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Menu extends Model
{
    use HasFactory;

    public function parent(): HasOne
    {
        return $this->hasOne(Menu::class, 'id', 'parent_id')->orderBy('sort_order');
    }

    public function childern(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id')->orderBy('sort_order');
    }

    public function tree()
    {
        return static::with(implode('.', array_fill(0, 100, 'childern')))
            ->where('parent_id', '=', 0)
            ->orderBy('sort_order')->get();
    }
}
