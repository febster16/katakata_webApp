<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id','category_id','title','post_image','body','status',
    ];

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'in-active';

    public static $status = [
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_INACTIVE => 'In Active',
    ];

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

//    public function setPostImageAttribute($value){
//
//        $this->attributes['post_image'] = asset($value);
//
//    }
//
//
    public function getPostImageAttribute($value){
        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
        }
        return asset('storage/' . $value);
    }






}
