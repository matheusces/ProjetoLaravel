@extends('templates.master')

@section('css-view')
@endsection

@section('js-view')
@endsection

@section('conteudo-view')
    
    @if(session('success'))
        <h3> {{session('success')['message'] }} </h3>
    @endif

    {!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'PUT', 'class' => 'form-padrao']) !!}

        @include('user.formField')
        @include('templates.formulario.submit', ['label' => 'Cadastrar', 'input' => 'Atualizar'])

    {!! Form::close() !!}

@endsection 