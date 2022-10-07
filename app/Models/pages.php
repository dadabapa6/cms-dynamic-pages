<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pages extends Model
{
    use HasFactory;
    protected $table = 'pages';
    protected $primarykey = 'id';
    protected $fillable = [
        'parent_id', 'title', 'content', 'slug'
    ];

    public function page()
    {
        return $this->hasOne('App\Models\pages', 'id','parent_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\pages', 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\pages', 'id','parent_id');
    }

    public function descendants()
    {
        return $this->children()->with('descendants');
    }
}
