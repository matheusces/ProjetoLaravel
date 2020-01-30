@extends('templates.master')

@section('css-view')
@endsection

@section('js-view')
@endsection

@section('conteudo-view')
    
    @if(session('success'))
        <h3> {{session('success')['message'] }} </h3>
    @endif

    {!! Form::open(['route' => 'user.store', 'method' => 'post', 'class' => 'form-padrao']) !!}

        @include('user.formField')
        @include('templates.formulario.submit', ['label' => 'Cadastrar', 'input' => 'cadastrar'])

    {!! Form::close() !!}

    @include('user.list', ['user_list' => $users])

@endsection 