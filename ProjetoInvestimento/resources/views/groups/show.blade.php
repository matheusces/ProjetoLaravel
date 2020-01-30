@extends('templates.master')

@section('conteudo-view')

    <header>
        <h2>Nome do grupo: {{ $group->name }}</h2>
        <h2>Instituição: {{ $group->instituition->name }}</h2>
        <h2>Responsável: {{ $group->user->name }}</h2>
    </header>

    {!! Form::open(['route' => ['group.user.store', $group->id], 'method' => 'POST', 'class' => 'form-padrao']) !!}
        @include('templates.formulario.select', ['label' => "Usuário",
            'select' =>'user_id',
            'data' => $user_list,
            'attributes' => ['placeholder' => "Usuário"],
        ])
        @include('templates.formulario.submit', ['input' => 'Relacionar ao Grupo: ' . $group->name])
    {!! Form::close() !!}

    @include('user.list', ['user_list' => $group->users])

@endsection