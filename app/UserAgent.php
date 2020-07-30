<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAgent extends Model
{
    protected $fillable = [
        'token_id',
        'user_id',
        'agent',
        'ip'
    ];

    public function token()
    {
        return $this->belongsTo('App\Token');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
