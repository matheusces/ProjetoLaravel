<?php 

namespace App\Services;

use Exception;
use Illuminate\Database\QueryException;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\GroupRepository;
use App\Validators\GroupValidator;
use Prettus\Validator\Contracts\ValidatorInterface;

class GroupService{
    private $repository;
    private $validator;

    public function __construct(GroupRepository $repository, GroupValidator $validator){
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    //php 7 permite usar tipagem de dados
    public function store(array $data){

        try{

            //dd($data) apresenta as exceções encontradas;
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $group = $this->repository->create($data);

            
            return [
                'success' => 'true',
                'message' => 'Grupo cadastrado',
                'data'    => $group,
                
            ];
        }
        catch(Exception $e){
            //tratamento de exceções

            switch(get_class($e)){
                case QueryException::class      : return['success' => false, 'message' => $e->getMessage()];   
                case ValidatorException::class  : return['success' => false, 'message' => $e->getMessageBag()];  
                case Exception::class           : return['success' => false, 'message' => $e->getMessage()];
                default                         : return['success' => false, 'message' => get_class($e)];
            }
        }
    }

    public function userStore($group_id, $data){
        try{

            
            $group = $this->repository->find($group_id);
            $user_id = $data['user_id'];

            //insere no relacionamento N pra N
            //sem parenteses retorna um objeto e com parentesis executa um método 
            $group->users()->attach($user_id);
            
            
            return [
                'success' => 'true',
                'message' => 'Usuario relacionado com sucesso',
                'data'    => $group,
                
            ];
        }
        catch(Exception $e){
            //tratamento de exceções

            switch(get_class($e)){
                case QueryException::class      : return['success' => false, 'message' => $e->getMessage()];   
                case ValidatorException::class  : return['success' => false, 'message' => $e->getMessageBag()];  
                case Exception::class           : return['success' => false, 'message' => $e->getMessage()];
                default                         : return['success' => false, 'message' => get_class($e)];
            }
        }
    }


    public function update($data, $id){
        try{

            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $group = $this->repository->update($data, $id);

            
            return [
                'success' => 'true',
                'message' => 'Grupo Atualizado',
                'data'    => $group,
                
            ];
        }
        catch(Exception $e){
            //tratamento de exceções

            switch(get_class($e)){
                case QueryException::class      : return['success' => false, 'message' => $e->getMessage()];   
                case ValidatorException::class  : return['success' => false, 'message' => $e->getMessageBag()];  
                case Exception::class           : return['success' => false, 'message' => $e->getMessage()];
                default                         : return['success' => false, 'message' => get_class($e)];
            }
        }            
    }

}