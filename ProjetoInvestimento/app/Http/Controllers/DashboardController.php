<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Exception;
use Auth;


class DashboardController extends Controller
{
    
    private $repository;
    private $validator;
    
    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }
    
    public function index(){
        return view('user.dashboard');
    }
    
    public function auth(Request $request){
        
        //array contendo a senha e email da request
        $data = [
            'email' => $request->get('username'),
            'password' => $request->get('password')
        ];
        
        /*  tratamento da request
            Verificando se é necessário ter criptografia de senha
        */
        try{
            if(env('PASSWORD_HASH')){
                //usando o namespace raiz do projeto com '\' para definir a classe
                Auth::attempt($data, false);    
            }
            else{
                //verificando se a senha e email são válidos, a partir do primeiro usuário encontrado
                $user = $this->repository->findWhere(['email' => $request->get('username')])->first();
                
                if(!$user)
                    throw new Exception("O email é inválido");

                if($user->password != $request->get('password'))
                    throw new Exception("A senha é inválida");
                
                Auth::login($user);
            }
            
            return redirect()->route('user.dashboard');
        }
        catch(Exception $e){
            return $e->getMessage();
        }
        
        
        
        //dump and die, trás o tipo e o valor de cada variável da request
        dd($request->all());
        
    }
}
