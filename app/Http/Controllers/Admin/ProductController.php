<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

class ProductController extends Controller
{
    public function __Construct() 
    {
        $this->middleware('auth');
        // $this->middleware('user.status');
        // $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    public function getHome()
    { // with(['cat']) solo llama una vez a la tabla categorias
        /* switch ($status) {
            case '0':
                $products = Product::with(['cat'])->where('status', '0')->orderBy('id', 'desc')->paginate(8);
                break;
            case '1':
                $products = Product::with(['cat'])->where('status', '1')->orderBy('id', 'desc')->paginate(8);
                break;
            case 'all':
                $products = Product::with(['cat'])->orderBy('id', 'desc')->paginate(8);
                break;
            case 'trash':
                $products = Product::with(['cat'])->onlyTrashed()->orderBy('id', 'desc')->paginate(8);
                break;
        }
        
        $data = ['products' => $products]; */
        return view('admin.products.home');
    }

    public function getProductAdd()
    {
        return view('admin.products.add');
    }

    public function postProductAdd(Request $request)
    {
        $rules = [
            'name' => 'required',
            'img' => 'required|image',
            'price' => 'required',
            'content' => 'required'
        ];

        $messages = [
            'name.required' => 'El nombre del producto es requerido',
            'img.required' => 'Debe seleccionar una imagen destacada',
            'img.image' => 'El archivo no es una imagen',
            'price.required' => 'Ingrese el precio del producto',
            'content.required' => 'Debe ingresar una descripción para el producto'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) 
        {
            return back()
                    ->withErrors($validator)
                    ->with('message', 'Se ha producido un error')
                    ->with('typealert', 'danger')
                    ->withInput();
        } else {
            $path = '/'.date('Y-m-d');
            $fileExt = trim($request->file('img')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads.root');
            $name = Str::slug(str_replace($fileExt, '', $request->file('img')->getClientOriginalName()));
            $filename = rand(1,999).'-'.$name.'.'.$fileExt;

            $file_file = $upload_path . '/' . $path . '/' . $filename;

            $product = new Product();
            $product->status = '0';
            $product->code = e($request->input('code'));
            $product->name = e($request->input('name'));
            $product->slug = Str::slug($request->input('name'));
            $product->category_id = $request->input('category');
            $product->file_path = date('Y-m-d');
            $product->image = $filename;
            $product->price = $request->input('price');
            $product->inventory = $request->input('inventory');
            $product->in_discount = $request->input('indiscount');
            $product->discount = $request->input('discount');
            $product->content = e($request->input('content'));

            // Para las miniaturas instalar el paquete intervention/image (composer require intervention/image)
            if ($product->save()) {
                if($request->hasFile('img')) {
                    $fl = $request->img->storeAs($path, $filename, 'uploads');
                    $img = Image::make($file_file);
                    $img->resize(256, 256, function($constraint) {
                        $constraint->upsize();
                    }); 
                    /* $img->fit(256, 256, function($constraint) {
                        $constraint->upsize();
                    });  */
                    $img->save($upload_path. '/' . $path . '/t_' . $filename);
                }
                return redirect('/admin/products')
                    ->with('message', 'Guardado con exito')
                    ->with('typealert', 'success');
            }
        }
    }
}
