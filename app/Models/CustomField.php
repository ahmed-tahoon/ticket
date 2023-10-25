<?php

namespace App\Models;

use App\Enums\CustomFieldType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'title',
        'description',
        'type',
        'is_required',
    ];

    protected $casts = [
        'type' => CustomFieldType::class,
        'is_required' => 'boolean',
    ];

    public function responses()
    {
        return $this->hasMany(CustomFieldResponse::class);
    }
}
