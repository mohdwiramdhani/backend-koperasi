<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    protected $table = "profiles";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'fullname',
        'nik',
        'email',
        'phone',
        'address',
        'birthdate',
        'gender',
        'religion'
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id", "id");
    } 
}
