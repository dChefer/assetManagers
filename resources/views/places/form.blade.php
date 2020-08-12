@extends('adminlte::page')

@section('title', 'Locais')

@section('content_header')
<h1 class="m-0 text-dark">Novo Local</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form
                    action="{{ isset($place) ? route('place_update', ['place' => $place->id]) : route('place_store') }}?{{ request()->getQueryString() }}"
                    method="post">
                    @csrf
                    @method(isset($place) ? 'PUT' : 'POST')
                    <label>
                        Locais
                        <input type="text" name="name" required value="{{ $place->name ?? '' }}">
                    </label>
                    <br>
                    <button class="btn btn-sm btn-primary" type="submit">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
