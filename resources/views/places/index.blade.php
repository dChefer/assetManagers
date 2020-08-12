@extends('adminlte::page')

@section('title', 'Locais')

@section('content_header')
<div class="row">
    <div class="col-6">
        <h1 class="m-0 text-dark">Locais</h1>
    </div>
    <div class="col-6 text-right">
        <a href="{{ route('place_form') }}" class="btn btn-outline-dark btn-sm">
            <i class="fa fa-plus"></i>
            Adicionar local
        </a>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Listagem de locais</h3>
                <div class="card-tools">
                    <form action="{{ route('place') }}" method="GET" class="input-group input-group-sm"
                        style="width: 150px;">
                        <input type="text" name="name" class="form-control float-right" placeholder="Filtrar"
                            value="{{ request()->input('name') }}">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-outline-info"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-hover" >                    <thead>
                        <tr>
                            <tr>
                                <th style="width: 15%">#</th>
                                <th style="width: 50%">Nome Local</th>
                                <th style="width: 20%">Ações</th>
                            </tr>
                    </thead>
                    <tbody>
                        @forelse($places as $place)
                        <tr>
                            <td>{{ $place->id }}</td>
                            <td>{{ $place->name}}</td>
                            <td>
                                <a class="btn btn-outline-info btn-sm" href="{{ route('place_form_update', [
                                            'place' => $place->id
                                   ]) }}?{{ request()->getQueryString() }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Editar
                                </a>
                                <button type="button" class="btn btn-outline-danger btn-sm" onclick="placeDelete('{{ route('place_delete', ['place' => $place->id]) }}')">
                                    <i class="fas fa-trash">
                                    </i>
                                    Excluir
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan= "3">
                                <div class="text-center alert alert-warning" role="alert">Nenhum Local foi encontrado</div>
                            </td>
                        </tr> 
                        @endforelse
                    </tbody>
                </table>
                <ul class="pagination justify-content-center">
                    {{ $places->appends(request()->all())->links() }}
                </ul>    
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    function placeDelete(url) {
            swal({
                title: "Confirma a exclusão do local?",
                icon: "warning",
                buttons: true,
            })
                .then((confirm) => {
                    if (confirm) {
                        $.ajax({
                            url,
                            method: 'delete',
                            beforeSend: function () {
                                swal("Aguarde!", {
                                    icon: "info",
                                });
                            },
                            success: function () {
                                swal("Local excluído com sucesso!", {
                                    icon: "success"
                                }).then(() => {
                                    window.location.reload();
                                });
                            },
                            error: function () {
                                swal("Falha na exclusão!", {
                                    icon: "error",
                                });
                            }
                        })
                    }
                });
        }
</script>
@endsection
