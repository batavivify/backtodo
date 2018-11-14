<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'priority', 'is_completed', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
