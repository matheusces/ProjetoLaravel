<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Group.
 *
 * @package namespace App\Entities;
 */
class Group extends Model implements Transformable
{
    use TransformableTrait;

    
    protected $fillable = ['name', 'user_id', 'instituition_id'];

    public function getTotalValueAttribute(){
      
      $applications = $this->moviments()->applications()->sum('value');
      $outflows = $this->moviments()->outflows()->sum('value'); 
      return  $applications - $outflows; 
    }

    public function user(){
        /*O grupo pertence a classe User através desse método e tem acesso aos usuarios.
          O laravel identifica o usuario através do id passado com o mesmo nome.
        */
        return $this->belongsTo(User::class);
    }

    public function users(){
      //Relacionamento de N pra N
      return $this->belongsToMany(User::class, 'user_groups');
    }

    public function instituition(){
        /*O grupo pertence a classe Instituition através desse método e tem acesso as instituições
          O laravel identifica a instituição através do id passado com o mesmo nome.
        */
        return $this->belongsTo(Instituition::class); 
    }

    public function moviments(){
      return $this->hasMany(Moviment::class);
    }
}
