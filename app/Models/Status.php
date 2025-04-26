<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    use HasFactory;

    protected $table = 'estados';

    protected $fillable = ['nombre'];

    public function guests(): HasMany
    {
        return $this->hasMany(Guest::class);
    }
}
