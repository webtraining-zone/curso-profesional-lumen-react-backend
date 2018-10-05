<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 10/5/18
 * Time: 9:35 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'user_id'
    ];

    public function issues()
    {
        return $this->hasMany('App\Issue');
    }

}