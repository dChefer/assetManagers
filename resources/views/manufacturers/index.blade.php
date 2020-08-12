@extends('adminlte::page')

@section('title', 'Fabricantes')

@section('content_header')
<div class="row">
    <div class="col-6">
        <h1 class="m-0 text-dark">Fabricantes</h1>
    </div>
    <div class="col-6 text-right">
        <a href="{{ route('manufacturer_form') }}" class="btn btn-outline-dark btn-sm">
            <i class="fa fa-plus"></i>
            Adicionar Fabricante
        </a>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Listagem de Fabricantes</h3>
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
            <br>


            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="width: 15%">#</th>
                        <th style="width: 50%">Nome Fabricante</th>
                        <th style="width: 20%">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($manufacturers as $manufacturer)
                    <tr>
                        <td>{{ $manufacturer->id }}</td>
                        <td>{{ $manufacturer->name}}</td>
                        <td>
                            <a class="btn btn-outline-info btn-sm" href="{{ route('manufacturer_form_update', [
                                        'manufacturer' => $manufacturer->id]) }}?{{ request()->getQueryString() }}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Editar
                            </a>
                            <button type="button" class="btn btn-outline-danger btn-sm"
                                onClick="manufacturerDelete('{{ route('manufacturer_delete', ['manufacturer' => $manufacturer->id]) }}')">
                                <i class="fas fa-trash">
                                </i>
                                Excluir
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">
                            <div class="text-center alert alert-warning" role="alert">Nenhum Fabricante foi encontrado
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <ul class="pagination justify-content-center">
                {{ $manufacturers->appends(request()->all())->links() }}
            </ul>
            </p>
        </div>
    </div>
</div>

@stop

@section('js')
<script>
    function manufacturerDelete(url) {
            swal({
                title: "Confirma a exclusão do fabricante?",
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
                                swal("Fabricante excluído com sucesso!", {
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
