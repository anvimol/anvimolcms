@extends('admin.master')

@section('title', "Productos")

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products') }}"><i class="fas fa-boxes"></i> Productos</a>
    </li>                                
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-boxes"></i> Productos</h2>
            <ul>
                {{-- @if (kvfj(Auth::user()->permissions, 'product_add')) --}}
                <li>
                    <a href="{{ url('admin/product/add') }}">
                        <i class="fas fa-plus"></i> Agregar producto
                    </a>
                </li>
                <li>
                    <a href="#">Filtrar <i class="fas fa-chevron-down"></i></a>
                    <ul class="shadow">
                        <li><a href="{{ url('/admin/products/1') }}"><i class="fas fa-globe-europe"></i> Públicos</a></li>
                        <li><a href="{{ url('/admin/products/0') }}"><i class="fas fa-eraser"></i> Borradores</a></li>
                        <li><a href="{{ url('/admin/products/trash') }}"><i class="fas fa-trash"></i> Papelera</a></li>
                        <li><a href="{{ url('/admin/products/all') }}"><i class="fas fa-list-ul"></i> Todos</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" id="btn_search">
                        <i class="fas fa-search"></i> Buscar
                    </a>
                </li>
                {{-- @endif --}}
            </ul>
        </div>
        <div class="inside">
            {{-- <div class="form_search" id="form_search"> --}}
                {!! Form::open(['url' => '/admin/product/search']) !!} 
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su busqueda']) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::select('filter', ['0' => 'Nombre del producto', '1' => 'Código'], 0, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-md-2">
                            {!! Form::select('status', ['0' => 'Borrador', '1' => 'Públicos'], 0, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-md-2">
                            {!! Form::submit('Buscar', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            {{-- </div> --}}
            <table class="table table-striped mtop16">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th></th>
                        <th>Nombre</th>
                        <th>Categoria</th>
                        <th>Precio</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td width="50">{{ $product->id }}</td>
                            <td width="64">
                                <a href="{{ url('/uploads/' . $product->file_path . '/' . $product->image) }}" class="single-image">
                                    <img src="{{ url('/uploads/' . $product->file_path . '/t_' . $product->image) }}" width="64">
                                </a>
                            </td>
                            <td>{{ $product->name }}  @if ($product->status == 0) <i class="fas fa-eraser"  data-toggle="tooltip" data-placement="top" title="Estado: borrador"></i>
                            @endif</td>
                            <td>{{ $product->cat->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                                <div class="opts">
                                    {{-- @if (kvfj(Auth::user()->permissions, 'product_edit')) --}}
                                    <a href="{{ url('/admin/product/'.$product->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar">
                                        <i class="far fa-edit"></i>
                                    </a>
                                   {{--  @endif
                                    @if (kvfj(Auth::user()->permissions, 'product_delete')) --}}
                                        @if (is_null($product->deleted_at))
                                        <a href="#" data-path="admin/product" data-action="delete" data-object="{{ $product->id }}" data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn_delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        @else
                                        <a href="{{ url('/admin/product/'.$product->id.'/restore') }}" data-action="restore" data-path="admin/product" data-object="{{ $product->id }}" data-toggle="tooltip" data-placement="top" title="Restaurar" class="btn_delete">
                                            <i class="fas fa-trash-restore"></i>
                                        </a>
                                        @endif
                                    {{-- @endif --}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="6">{!! $products->render() !!}</td>
                    </tr>
                </tbody>
            </table> 
        </div>
    </div>
</div>
@endsection