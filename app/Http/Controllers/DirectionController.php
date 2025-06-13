<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use Illuminate\Http\Request;

class DirectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $directions = Direction::all();
    return view('directions.index', compact('directions'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('directions.create');
        // -> resources/views/directions/create.blade.php }
    }

    /**
     * Store a newly created resource in storage.
     */
      // Créer une nouvelle direction
      public function store(Request $request)
      {
          $request->validate([
              'nom' => 'required|unique:directions,nom',
          ], [
              'nom.unique' => 'La direction existe déjà. Veuillez choisir un autre nom.',
          ]);
      
          Direction::create([
              'nom' => $request->name
          ]);
      
          return redirect()->back()->with('success', 'Direction ajoutée avec succès.');
      }
  
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $client = Direction::find($id);
        return view('directions.show', compact('direction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Direction $direction)
    {
        return view('directions.edit', compact('direction'));
    }
    
    public function destroy(Direction $direction)
    {
        $direction->delete();
        return redirect()->route('directions.index')->with('success', 'Direction supprimée.');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
   
}
