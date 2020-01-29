<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function get()
    {
        return Category::all();
    }
    
    public function save(Request $request, $id = 0)
    {

        if($id){
            $categories = Category::find($id);
        }else{
            $categories = new Category;
        }
        
        $categories->nome   = $request->nome;
        $categories->save();

        return "true";
    }
  
    public function destroy(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->delete();
        return 'true';
    }
}
