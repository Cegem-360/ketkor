<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccessToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'product_id',
        'token',
        'used',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }


}
