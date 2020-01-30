<?php

namespace App\Entities;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;
    
    
    public $timestamps = true;
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cpf', 'name', 'phone', 'birth', 'gender', 'notes', 'email', 'password', 'status', 'permission' 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function moviments(){
        return $this->hasMany(Moviment::class);
    }

    public function groups(){
        //Relacionamento de N pra N
        return $this->belongsToMany(Group::class, 'user_groups');
      }

    public function setPasswordAttribute($value){
        $this->attributes['password'] = env('PASSWORD_HASH') ? bcrypt($value) : $value;
        
    }
    /* ===========================================
        Se as strings formatadas tiverem o mesmo nome do campo de cada entidade, os dados
        enviados serão sobrescritos, então se usa o prefixo Formatted  
       ===========================================
    */
    /*
        formatação da string cpf
    */

    public function getFormattedCpfAttribute(){
        $cpf = $this->attributes['cpf'];
        return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, -2);
    }

    /*
        formatação do telefone
    */

    public function getFormattedPhoneAttribute(){
        $phone = $this->attributes['phone'];
        return '(' . substr($phone, 0, 2) . ')' . substr($phone, 2, 4) . '-' . substr($phone, -4);
    }

    /*
        formatação da data
    */
    
    public function getFormattedBirthAttribute(){
        //explode() serara a string de acordo com o parametro colocado
        $birth = explode('-', $this->attributes['birth']);

        if(count($birth) != 3){
            return "";
        }
        return $birth[2] . '/' . $birth[1] . '/' . $birth[0];
    }
}