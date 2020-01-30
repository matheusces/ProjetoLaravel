<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use Notifiable;

    public $timestamps = true;
    protected $table = 'user_groups';
    protected $fillable = ['user_id', 'group_id', 'permission'];
    protected $hidden = [];
}
