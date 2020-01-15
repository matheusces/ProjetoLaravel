<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUsersTable.
 */
class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
            $table->increments('id');
            
            //dados de pessoas referentes a tabela user
            $table->char('cpf', 11)->unique()->nullable();
            $table->string('name', 50);
            $table->char('phone', 11);
            $table->date('birth')->nullable();
            $table->char('gender', 1)->nullable();
            $table->text('notes')->nullable();
            
            //dados de autenticação
            $table->string('email', 80)->unique();
            $table->string('password', 254)->nullable();
            
            //dados de permissão
            $table->string('status')->default('active');
            $table->string('permission')->default('app.user');
            
            //cria na tabela um campo de redefinição de senha
            $table->rememberToken();
            
            //armazena a data e hora da criação ou atualização de um registro
            $table->timestamps();
            
            //armazena a data e hora de exclusão
            $table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{  
        Schema::table('users', function(Blueprint $table) {
        
        });
        
		Schema::drop('users');
	}
}
