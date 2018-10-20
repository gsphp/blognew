<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Noticia;

class ControladorNoticias extends Controller
{
    public function indexView()
    {
        return view('noticias');
    }
    public function vermais($id)
    {          
        return view('noticiap')->with('id', $id);   
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
}


















