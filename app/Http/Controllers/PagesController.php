<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function index(){
        return view('pages.index');
    }
    
    public function about(){
        return view('pages.about');
    }

    public function services(){
        $data['title'] = 'services page';
        $data['services'] = ['web devlopment','web desing','android devlopment','android design'];

        return view('pages.services')->with($data);
    }
}
