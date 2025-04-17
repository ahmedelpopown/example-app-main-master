<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Authority extends Model
{
    public function soldiers()
{
    return $this->hasMany(Soldier::class);
}

}
