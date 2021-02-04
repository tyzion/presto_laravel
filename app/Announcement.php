<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = ['title', 'description', 'price', 'img', 'user_id', 'category_id', 'is_accepted'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function category()
    {
        return $this->belongsTo('\App\Category');
    }
    
    public function images()
    {
        return $this->hasMany('\App\AnnouncementImage');
    }

    static function toBeRevisionedCount()
    {
        return Announcement::where('is_accepted', false)->count();
    }

    static function RejectedCount()
    {
        return Announcement::where('is_accepted', false)->where('is_rejected', true)->count();
    }
}
