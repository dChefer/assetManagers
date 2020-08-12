@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
<div class="row">
    <div class="col-6">
        <h1 class="m-0 text-dark">Categorias</h1>
    </div>
    <div class="col-6 text-right">
        <a href="{{ route('category_form') }}" class="btn btn-outline-dark btn-sm">
            <i class="fa fa-plus"></i>
            Adicionar categoria
        </a>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Listagem de Categorias</h3>
                <div class="card-tools">
                    <form action="{{ route('category') }}" method="GET" class="input-group input-group-sm"
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
                            <th style="width: 30%">Nome Categoria</th>
                            <th style="width: 20%">Posição</th>
                            <th style="width: 20%">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name}}</td>
                            <td>{{ $category->position}}</td>
                            <td>
                                <a class="btn btn-outline-info btn-sm" href="{{ route('category_form_update', [
                                            'category' => $category->id
                                   ]) }}?{{ request()->getQueryString() }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Editar
                                </a>
                                <button type="button" class="btn btn-outline-danger btn-sm"
                                    onclick="categoryDelete('{{ route('category_delete', ['category' => $category->id]) }}')">
                                    <i class="fas fa-trash">
                                    </i>
                                    Excluir
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan= "6">
                                <div class="text-center alert alert-warning" role="alert">Nenhuma Categoria foi encontrada</div>
                            </td>
                        </tr> 
                        @endforelse
                    </tbody>
                </table>
                <ul class="pagination justify-content-center">
                    {{ $categories->appends(request()->all())->links() }}
                </ul>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    function categoryDelete(url) {
            swal({
                title: "Confirma a exclusão da categoria?",
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
                                swal("Categoria excluído com sucesso!", {
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
