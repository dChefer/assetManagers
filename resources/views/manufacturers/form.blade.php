@extends('adminlte::page')

@section('title', 'Fabricantes')

@section('content_header')
<h1 class="m-0 text-dark">Novo Fabricante</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form
                    action="{{ isset($manufacturer) ? route('manufacturer_update', ['manufacturer' => $manufacturer->id]) : route('manufacturer_store') }}?{{ request()->getQueryString() }}"
                    method="post">
                    @csrf
                    @method(isset($manufacturer) ? 'PUT' : 'POST')
                    <label>
                        Fabricante
                        <input type="text" name="name" required value="{{ $manufacturer->name ?? '' }}">
                    </label>
                    <br>
                    <button class="btn btn-sm btn-primary" type="submit">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
