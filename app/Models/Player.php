<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Player extends Model
{
    use HasFactory;
    protected $table = 'player';
    protected $fillable = [
        'posisi',
        'nama',
        'nomer_punggung',
    ];

    public function createdDetail(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
