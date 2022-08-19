<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $table = 'profiles';
    protected $fillable = ['user_id','address','image'];

    public function user()
    {
        return $this->BelongsTo(User::class);
    }

    //The inverse of HasOne is BelongsTo
}
