<?php


namespace App;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {
    protected $fillable = [
        'title', 'image'
    ];
public function user()
{
    return $this->belongsTo('App\user');
}

}