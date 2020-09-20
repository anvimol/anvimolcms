@extends('admin.master')

@section('title', "Categorias")

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('/admin/categories') }}"><i class="fas fa-folder-open"></i> Categorias</a>
</li>    
                           
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-folder-open"></i>Agregar categoria</h2>
                    </div>

                    <div class="inside">
                        {{-- @if (kvfj(Auth::user()->permissions, 'category_add')) --}}
                        {!! Form::open(['url' => '/admin/category/add', 'method'=>'POST', 'files' => true, 'role' => 'form']) !!}
                        <label for="name">Nombre:</label> 
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            
                            {!! Form::text('name',null,['class'=>'form-control', 'placeholder'=>'Nombre', 'required' => 'required']) !!}
                        </div>

                        <label for="module" class="mtop16">Módulo:</label> 
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            
                            {!! Form::select("module", getModulesArray(), 0, ["class" => "form-select"]) !!}
                        </div>

                        <label for="icon" class="mtop16">Ícono:</label> 
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fas fa-keyboard"></i>
                            </span>
                            {!! Form::text('icon',null,['class'=>'form-control']) !!}
                        </div>

                        {!! Form::submit('Guardar', ['class' => 'btn btn-success mtop16']) !!}
                        {!! Form::close() !!}
                        {{-- @endif --}}
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-folder-open"></i> Categorias</h2>
                    </div>

                    <div class="inside">
                        <nav class="nav nav-pills nav-fill">
                            @foreach (getModulesArray() as $item => $k)
                                <a class="nav-link" href="{{ url('/admin/categories/' . $item) }}"><i class="fas fa-list"></i> {{ $k }}</a>
                            @endforeach
                        </nav>
                        <table class="table mtop16">
                            <thead>
                                <tr>
                                    <th width="32"></th>
                                    <th>Nombre</th>
                                    <th width="140"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cats as $cat)
                                    <tr>
                                        <td>{!! htmlspecialchars_decode($cat->icon) !!}</td>
                                        <td>{{ $cat->name }}</td>
                                        <td>
                                            <div class="opts">
                                                {{-- @if (kvfj(Auth::user()->permissions, 'category_edit')) --}}
                                                <a href="{{ url('/admin/category/'.$cat->id.'/edit') }}" data-toggle="tooltip" data-placement="top" title="Editar">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                {{-- @endif --}}
                                                {{-- @if (kvfj(Auth::user()->permissions, 'category_delete')) --}}
                                                <a href="{{ url('/admin/category/'.$cat->id.'/delete') }}" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                                {{-- @endif --}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
        </div>
    </div>
@endsection 