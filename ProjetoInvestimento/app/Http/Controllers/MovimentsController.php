<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MovimentCreateRequest;
use App\Http\Requests\MovimentUpdateRequest;
use App\Repositories\MovimentRepository;
use App\Validators\MovimentValidator;
use App\Entities\{Group, Product, Moviment};
use Auth;

/**
 * Class MovimentsController.
 *
 * @package namespace App\Http\Controllers;
 */
class MovimentsController extends Controller
{
    /**
     * @var MovimentRepository
     */
    protected $repository;

    /**
     * @var MovimentValidator
     */
    protected $validator;

    /**
     * MovimentsController constructor.
     *
     * @param MovimentRepository $repository
     * @param MovimentValidator $validator
     */
    public function __construct(MovimentRepository $repository, MovimentValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function application(){
        return view('moviments.application', [
            'product_list' => Product::all(),
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        //class Auth pega o usuario logado, pegando assim apenas grupos que o usuario pertence
        $user = Auth::user();
       

        //pluck() retorna o array que contém a chave e o conteudo, exemplo chave 'id' e conteudo 'name'
        $group_list = $user->groups->pluck('name', 'id');
        $product_list = Product::all()->pluck('name', 'id');

        return view('moviments.index', [
            'group_list' => $group_list,
            'product_list' => $product_list,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MovimentCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Request $request){
        $movimento = Moviment::create([
            'user_id' => Auth::user()->id,
            'group_id' => $request->get('group_id'),
            'product_id' => $request->get('product_id'),
            'value' => $request->get('value'),
            'type' => 1, 
        ]);
        
        session()->flash('success', [
            'success' => true,
            'messages' => "Sua aplicação de " . $movimento->value . " no produto " . $movimento->product->name . " foi realizada com sucesso",
        ]);

        return redirect()->route('moviment.index');
    }

    public function getback(){

        //class Auth pega o usuario logado, pegando assim apenas os movimentos de investimento que o usuario realizou
        $moviment_list = Auth::user()->moviments;
        $group_list = [];

        //$group_list = $user->groups->pluck('name', 'id');
        for($i =0; $i<count($moviment_list); $i++){
            $aux = in_array($moviment_list[$i]->group->name, $group_list);
            
            if($moviment_list[$i]->type == 1 && !$aux){
                array_push($group_list, $moviment_list[$i]->group->name);
            }            
        }

        //pluck() retorna o array que contém a chave e o conteudo, exemplo chave 'id' e conteudo 'name'
        $product_list = Product::all()->pluck('name', 'id');

        return view('moviments.getback', [
            'group_list' => $group_list,
            'product_list' => $product_list,
        ]);
    } 

    public function storeGetBack(Request $request){
        $movimento = Moviment::create([
            'user_id' => Auth::user()->id,
            'group_id' => $request->get('group_id'),
            'product_id' => $request->get('product_id'),
            'value' => $request->get('value'),
            'type' => 2, 
        ]);
        
        session()->flash('success', [
            'success' => true,
            'messages' => "Sua resgate de " . $movimento->value . " no produto " . $movimento->product->name . " foi realizada com sucesso",
        ]);

        return redirect()->route('moviment.index');
    }

    public function all(){
        $moviment_list = Auth::user()->moviments;

        return view('moviments.all', [
            'moviment_list' => $moviment_list,
        ]);
    }
}
