<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'city',
        'address',
        'tax_number',
        'zip',
    ];
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
    public function products()
    {
        return $this->hasManyThrough(Product::class, User::class);
    }
}
