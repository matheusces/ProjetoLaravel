<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Instituition.
 *
 * @package namespace App\Entities;
 */
class Instituition extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
    public $timestamps = true;
    
    /*
        função que retorna os grupos contidos em uma instituição
        contém um relacionamendo de 1 pra N (hasMany).
    */
    public function groups(){
        return $this->hasMany(Group::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

}
