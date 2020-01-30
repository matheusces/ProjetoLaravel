@extends('templates.master') 

@section('conteudo-view')
    
    @if(session('success'))
        <h3> {{session('success')['message'] }} </h3>
    @endif

    {!! Form::model($instituition, ['route' => ['instituition.update', $instituition->id], 'method' => 'PUT', 'class' => 'form-padrao']) !!}
        @include('templates.formulario.input', ['label' => 'Nome', 'input' => 'name', 'attributes' => ['placeholder' => 'Nome']])
        @include('templates.formulario.submit', ['label' => 'Cadastrar', 'input' => 'Atualizar'])
    {!! Form::close() !!}

    
@endsection