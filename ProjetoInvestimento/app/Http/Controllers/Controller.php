<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    /*Métodos de cada rota*/
    
    public function homePage(){
        return view('welcome');
    }
    
    public function cadastro(){
        echo "Tela de Cadastro";
    }
    
    // método de chamada da view de login de usuário
    public function telaLogin(){
        
        return view('user.login');
    }
}
