<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Str;

use App\Models\Category;

class CategoriesController extends Controller
{
    public function __Construct() 
    {
        $this->middleware('auth');
        // $this->middleware('user.status');
        // $this->middleware('user.permissions');
        $this->middleware('isadmin');
    }

    public function getHome($module)
    {
        $cats = Category::where('module', $module)->orderBy('name', 'asc')->get();
        $data = ['cats' => $cats]; 
        return view('admin.categories.home', $data);
    }

    public function postCategoryAdd(Request $request) {
        $rules = [
            'name' => 'required',
            'icon' => 'required'
        ];

        $messages = [
            'name.required' => 'El campo nombre no puede estar vacio.',
            'icon.required' => 'Se requiere un icono para la catagoría.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) 
        {
            return back()
                    ->withErrors($validator)
                    ->with('message', 'Se ha producido un error')
                    ->with('typealert', 'danger');
        } else {
            $category = new Category();
            $category->module = $request->input('module');
            $category->name = e($request->input('name'));
            $category->slug = Str::slug($request->input('name'));
            $category->icon = e($request->input('icon')); 
            
            if ($category->save()) {
                return back()
                    ->with('message', 'Categoría guardada con exito')
                    ->with('typealert', 'success');
            }
        }
    }

    public function getCategoryEdit($id) 
    {
        $cat = Category::findOrfail($id);
        $data = ['cat' => $cat];
        return view('admin.categories.edit', $data);
    }

    public function postCategoryEdit(Request $request, $id) {
        $rules = [
            'name' => 'required',
            'icon' => 'required'
        ];

        $messages = [
            'name.required' => 'El campo nombre no puede estar vacio.',
            'icon.required' => 'Se requiere un icono para la catagoría.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) 
        {
            return back()
                    ->withErrors($validator)
                    ->with('message', 'Se ha producido un error')
                    ->with('typealert', 'danger');
        } else {
            $category = Category::findOrFail($id);
            $category->module = $request->input('module');
            $category->name = e($request->input('name'));
            $category->slug = Str::slug($request->input('name')); // Ojo con este campo
            $category->icon = e($request->input('icon')); 
            
            if ($category->save()) {
                return back()
                    ->with('message', 'Guardado con exito')
                    ->with('typealert', 'success');
            }
        }
    }

    public function getCategoryDelete($id) 
    {
        $category = Category::findOrFail($id);
        if ($category->delete()) {
            return back()
                ->with('message', 'Eliminado con exito')
                ->with('typealert', 'success');
        }
    }
}
