@extends('adminlte::page')

@section('title', 'Equipamentos')

@section('content_header')
    <h1 class="m-0 text-dark">Novo Equipamento</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form
                        action="{{ isset($equipment) ? route('equipment_update', ['equipment' => $equipment->id]) : route('equipment_store') }}?{{ request()->getQueryString() }}"
                        method="post"
                        class="row"
                    >
                        @csrf
                        @method(isset($equipment) ? 'PUT' : 'POST')
                        <label class="col-sm-4">
                            Modelo
                            <input type="text" name="model" class="form-control" required value="{{ $equipment->model ?? '' }}">
                        </label>
                        <label class="col-sm-4">
                            Situação
                            <select name="state" required class="form-control">
                                <option value="">Selecione</option>
                                @foreach(\App\Models\Equipment::STATES as $state)
                                    <option value="{{ $state }}" {{ ($equipment->state ?? null) === $state ? 'selected' : '' }}>
                                        {{ $state }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                        <label class="col-sm-4">
                            Patrimônio
                            <input type="text" name="patrimony" class="form-control" required value="{{ $equipment->patrimony ?? '' }}">
                        </label>
                        <label class="col-sm-4">
                            Valor de aquisição
                            <input type="number" step="0.1" name="acquisition_value" class="form-control" required value="{{ $equipment->acquisition_value ?? '' }}">
                        </label>
                        <label class="col-12">
                            Descrição
                            <textarea
                                name="description"
                                class="form-control"
                                rows="4"
                            >{{ $equipment->description ?? '' }}</textarea>
                        </label>
                        <label class="col-sm-4">
                            Local
                            <select name="place_id" required class="form-control">
                                <option value="">Selecione</option>
                                @foreach($places as $place)
                                    <option value="{{ $place->id }}" {{ ($equipment->place_id ?? null) === $place->id ? 'selected' : '' }}>
                                        {{ $place->name }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                        <label class="col-sm-4">
                            Fabricante
                            <select name="manufacturer_id" required class="form-control">
                                <option value="">Selecione</option>
                                @foreach($manufacturers as $manufacturer)
                                    <option value="{{ $manufacturer->id }}" {{ ($equipment->manufacturer_id ?? null) === $manufacturer->id ? 'selected' : '' }}>
                                        {{ $manufacturer->name }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                        <label class="col-sm-4">
                            Categoria
                            <select name="category_id" required class="form-control">
                                <option value="">Selecione</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ ($equipment->category_id ?? null) === $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                        <div class="col-12 text-right">
                            <button class="btn btn-primary" type="submit">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @if (isset($equipment))
            <div class="modal fade" id="new-occurrence-modal" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Nova ocorrência</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="occurrence-form" action="#" method="post" class="row">
                                <input type="hidden" name="equipment_id" value="{{ $equipment->id }}">

                                <label class="col-sm-6">
                                    Data da ocorrência
                                    <input type="date" name="occurred_at" class="form-control" required>
                                </label>
                                <label class="col-12">
                                    Descrição
                                    <textarea
                                        name="description"
                                        class="form-control"
                                        rows="4"
                                        required
                                    ></textarea>
                                </label>
                            </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-primary" onclick="createOccurrence()">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Ocorrências</h4>

                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#new-occurrence-modal">
                            Nova ocorrência
                        </button>

                        <hr>
                        @forelse($equipment->occurrences as $occurrence)
                            {{ $occurrence->description }}
                        @empty
                            <div class="alert alert-info">Nenhuma ocorrência!</div>
                        @endforelse
                    </div>
                </div>
            </div>
        @endif
    </div>
@stop

@section('js')
    <script>
        function createOccurrence() {
            const form = $('#occurrence-form');
            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                beforeSend: function () {
                    //
                },
                success: function () {
                    alert('criado')
                },
                error: function () {
                    swal("Falha na criação!", {
                        icon: "error",
                    });
                }
            })
        }
    </script>
@endsection
