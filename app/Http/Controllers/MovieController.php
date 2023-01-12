<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{


    public function index(){
        return Movie::get();
    }

    public function create(Request $request){
        try{
            $request->validate([
                'title' => 'required|string',
                'premier' => 'required|date',
                'director' => 'required|string',
                'description' => 'required|string'
            ]);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()],400);
        }

        Movie::create([
            'title' => $request->title,
            'premier' => $request->premier,
            'director' => $request->director,
            'description' => $request->description
        ]);

        return 'Creado con exito';
    }    

    public function update(Request $request, Int $id){
        try{
        $request->validate([
            'title' => 'string',
            'premier' => 'date',
            'director' => 'string',
            'description' => 'string'
        ]);
        }catch(\Throwable $th){
            return response()->json(['error' => $th->getMessage()],400);
        }

        $movie = Movie::find($id);
        $movie->update([
            'title' => $request->title,
            'premier' => $request->premier,
            'director' => $request->director,
            'description' => $request->description
        ]);
        
        return $movie;
    }

    public function show($id){
        return Movie::find();
    }

    public function destroy($id){
      Movie::where('id', $id)->delete();
      return 'Eliminado con exito';  
    }
}
