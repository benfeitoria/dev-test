<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addCategory(){
        $userInfo['userID'] = Auth::id();
        return view('addCategory',$userInfo);
    }
}
