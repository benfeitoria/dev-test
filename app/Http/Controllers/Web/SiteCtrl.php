<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class SiteCtrl extends Controller
{
    
    public function index(){
        return view('web.index');
    }


    public function showPost($id = null){
        
        return view('web.post', ['id' => $id]);
    }

    
}
