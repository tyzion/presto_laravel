<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function announcements()
    {
        return $this->hasMany('\App\Announcement');
    }
}
