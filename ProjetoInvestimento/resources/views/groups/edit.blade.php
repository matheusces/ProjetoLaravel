@extends('templates.master')

@section('conteudo-view')
    {!! Form::model($group, ['route' => ['group.update', $group->id], 'method' => 'PUT', 'class' => 'form-padrao']) !!}
        @include('templates.formulario.input', ['label' => "Nome do Grupo", 'input' => 'name', 'attributes' => ['placeholder' => "Nome do Grupo"]])
        @include('templates.formulario.select', ['label' => "Usuario", 'select' => 'user_id', 'data' => $user_list])
        @include('templates.formulario.select', ['label' => "Instituição", 'select' => 'instituition_id', 'data' => $instituition_list])
        @include('templates.formulario.submit', ['label' => 'Atualizar', 'input' => "Atualizar"])
    {!! Form::close() !!}

@endsection()