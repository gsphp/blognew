<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Noticia;

class ControladorNoticias extends Controller
{
    //retorno de view basica, requisições json tratadas na propria view.
    public function indexView()
    {
        return view('noticias');
    }
    /*retorna a view da noticia junto com o id para que possa ser passado
      para o scrippt json. */  
    public function vermais($id)
    {          
        return view('noticiap')->with('id', $id);   
    }
    
    
    
}


















