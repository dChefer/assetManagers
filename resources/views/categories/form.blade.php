@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
<h1 class="m-0 text-dark">Nova Categoria</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form
                    action="{{ isset($category) ? route('category_update', ['category' => $category->id]) : route('category_store') }}?{{ request()->getQueryString() }}"
                    method="post" class="row">
                    @csrf
                    @method(isset($category) ? 'PUT' : 'POST')
                    <label class="col-sm-4">
                        Nome
                        <input type="text" name="name" class="form-control" required
                            value="{{ $category->name ?? '' }}">
                    </label>
                    <label class="col-sm-4">
                        Posição
                        <input type="text" name="position" class="form-control" required
                            value="{{ $category->position ?? '' }}">
                    </label>
                    <label class="col-sm-4">
                        Descrição
                        <input type="text" name="description" class="form-control" required
                            value="{{ $category->description ?? '' }}">
                    </label>
                    <div class="col-12 text-right">
                        <button class="btn btn-primary" type="submit">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
