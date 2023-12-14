<?php

namespace App\Models;

use DateTime;
use App\Models\Tool;
use App\Models\Partial;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_name',
        'installer_name',
        'city',
        'street',
        'zip',
        'purchase_place',
        'serial_number',
        'purchase_date',
        'installation_date',
        'warrantee_date',
        'tool_id',
        'user_id',
        'comments',
        'mac',
        'access_to_wifi',
        'created_at',
    ];
    protected $dateFormat = 'Y-m-d';
    protected $casts = [
        'warrantee_date' => 'date:Y-m-d',
        'purchase_date' => 'date:Y-m-d',
        'installation_date' => 'date:Y-m-d',
    ];
    public function serializeDate($date): string
    {
        if (is_null($date)) {
            $date = new DateTime();
        } else {
            $date = new DateTime($date);
        }
        return $date->format('Y-m-d');
    }

    public function tool(): BelongsTo
    {
        return $this->belongsTo(Tool::class);
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
    public function product_logs(): HasMany
    {
        return $this->hasMany(ProductLog::class);
    }

    /**
     * Get all of the comments for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function partials(): HasMany
    {
        return $this->hasMany(Partial::class);
    }
    public function are_visible(): HasMany
    {
        return $this->hasMany(Visible::class);
    }
    public function organizations(): HasManyThrough
    {
        return $this->hasManyThrough(Organization::class, User::class);
    }

}
