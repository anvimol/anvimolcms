@extends('admin.master')

@section('title', "Editar producto")

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('/admin/products') }}"><i class="fas fa-boxes"></i> Productos</a>
</li>    
                             
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="far fa-edit"></i> Editar producto</h2>
                </div>
                <div class="inside">
                    {!! Form::open(['url' => '/admin/product/'. $product->id .'/edit', 'method'=>'POST', 'files' => true, 'role' => 'form']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">Nombre del producto</label> 
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::text('name',$product->name,['class'=>'form-control', 'placeholder'=>'Nombre']) !!}
                            </div>
                        </div>
        
                        <div class="col-md-3">
                            {!! Form::label('category', 'Categoría:', array('class' => 'negrita')) !!}
                            <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                {!! Form::select("category", $cats, $product->category_id, ["class" => "form-select"]) !!}
                            </div>
                        </div>
        
                        <div class="col-md-3">
                            <label for="img">Imagen destacada</label>
                            <div class="form-file">
                                {!! Form::file('img', ['class' => "form-file-input", 'id' => "customFile", 'accept' => 'image/*']) !!}
                                <label class="form-file-label" for="customFile">
                                    <span class="form-file-text">Choose file...</span>
                                    <span class="form-file-button">Browse</span>
                                </label>
                            </div>

                            
                        </div>
                    </div>
        
                    <div class="row mtop16">
                        <div class="col-md-3">
                            <label for="price">Precio</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="far fa-money-bill-alt"></i></span>
                                {!! Form::number('price',$product->price,['class'=>'form-control', 'min'=>'0.00', 'step' => 'any']) !!}
                            </div>
                        </div>  

                        <div class="col-md-3">
                            <label for="indiscount">¿En descuento?</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-money-bill-alt"></i>
                                </span>
                                {!! Form::select("indiscount",['0' => 'No', '1' => 'Si'], $product->in_discount, ["class" => "form-select"]) !!}
                            </div>
                        </div>   

                        <div class="col-md-3">
                            <label for="discount">Descuento</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-money-bill-alt"></i>
                                </span>
                                {!! Form::number('discount',$product->discount,['class'=>'form-control', 'min'=>'0.00', 'step' => 'any']) !!}
                            </div>
                        </div> 

                        <div class="col-md-3">
                            <label for="status">Estado</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-money-bill-alt"></i>
                                </span>
                                {!! Form::select("status",['0' => 'Borrador', '1' => 'Publico'], $product->status, ["class" => "form-select"]) !!}
                            </div>
                        </div> 
                    </div>

                    <div class="row mtop16">
                        <div class="col-md-3">
                            <label for="inventory">Inventario</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-money-bill-alt"></i>
                                </span>
                                {!! Form::number('inventory', $product->inventory, ['class'=>'form-control', 'min'=>'0']) !!}
                            </div>
                        </div> 
        
                        <div class="col-md-3">
                            <label for="code">Código de sistema</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-money-bill-alt"></i>
                                </span>
                                {!! Form::text('code', $product->code, ['class'=>'form-control']) !!}
                            </div>
                        </div> 
                    </div>

                    <div class="row mtop16">
                        <div class="col-md-12">
                            <label for="content">Descripción</label>
                            {{ Form::textarea('content', $product->content, ['class'=>'form-control', 'id' => 'editor']) }}
                        </div>
                    </div>
        
                    <div class="row mtop16">
                        <div class="col-md-12">
                            {{ Form::submit('Guardar', ['class' => 'btn btn-success']) }}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="far fa-image"></i> Imagen destacada</h2>
                    <div class="inside">
                        <img src="{{ url('/uploads/' . $product->file_path . '/' . $product->image) }}" width="220" class="img-fluid">
                    </div>
                </div>
            </div>

            <div class="panel shadow mtop16">
                <div class="header">
                    <h2 class="title"><i class="far fa-images"></i> Galeria</h2>
                </div>
                <div class="inside product_gallery">
                    {{-- @if (kvfj(Auth::user()->permissions, 'product_gallery_add')) --}}
                        {!! Form::open(['url' => '/admin/product/' . $product->id . '/gallery/add', 'files' => true, 'id' => 'form_product_gallery']) !!}
                            {!! Form::file('file_image', ['id' => 'product_file_image', 'accept' => 'image/*', 'style' => 'display: none;', 'required']) !!}
                        {!! Form::close() !!}
                        <div class="btn-submit">
                            <a href="#" id="btn_product_file_image"><i class="fas fa-plus"></i></a>
                        </div>
                    {{-- @endif --}}

                    <div class="tumbs">
                        @foreach ($product->getGallery as $img)
                            <div class="tumb">
                                <a href="{{ url('/admin/product/'. $product->id .'/gallery/'.$img->id.'/delete') }}" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <img src="{{ url('/uploads/'.$img->file_path.'/t_'.$img->file_name) }}" width="200">
                            </div>
                        @endforeach
                    </div>
                </div>
                
            </div>
        </div>
    </div>   
</div>
@endsection
