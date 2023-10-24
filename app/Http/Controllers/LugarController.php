<?php

namespace App\Http\Controllers;

use App\Models\Lugar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LugarController extends Controller
{

    public function index()
    {
        // Despliegue de informacion principal
        $datos['lugars'] = Lugar::paginate(1);
        //$lugars = Lugar::select('nombre', 'descripcion', 'foto')->get();
        //return view('lugar.index', compact('lugars'));
        return view('lugar.index', $datos);
    }

    public function create()
    {
        //
        return view('lugar.create');
    }

    public function store(Request $request)
    {
        $campos = [
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|max:500',
            'foto' => 'required|max:900|mimes:jpeg,png,jpg',
        ];
        $mensaje = [
            'required' => 'El :attribute es requerido',
            'descripcion.required' => 'La descripción es requerida',
            'foto.required' => 'La foto es requerida',
        ];

        $this->validate($request, $campos, $mensaje);
        //$datosLugar = request()->all();
        $datosLugar = request()->except('_token');

        if ($request->hasFile('foto')) {
            $datosLugar['foto'] = $request->file('foto')->store('uploads', 'public');
        }

        Lugar::insert($datosLugar);
        //return response()->json($datosLugar);
        return redirect('lugar')->with('mensaje', 'Sitio Agregado con éxito');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        // permite editar y ver la vista que corresponde
        $lugar = Lugar::findOrFail($id);
        return view('lugar.edit', compact('lugar'));
    }

    public function update(Request $request, $id)
    {
        // validacion de campos del form
        $campos = [
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|max:500',
        ];
        $mensaje = [
            'required' => 'El :attribute es requerido',
            'descripcion.required' => 'La descripción es requerida',
        ];

        if ($request->hasFile('foto')) {
            $campos = ['foto' => 'required|max:900|mimes:jpeg,png,jpg'];
            $mensaje = ['foto.required' => 'La foto es requerida'];
        }

        $this->validate($request, $campos, $mensaje);

        // para actualizar data y retornarla
        $datosLugar = request()->except(['_token', '_method']);
        if ($request->hasFile('foto')) {
            $lugar = Lugar::findOrFail($id);
            Storage::delete('public/' . $lugar->foto);
            $datosLugar['foto'] = $request->file('foto')->store('uploads', 'public');
        }

        Lugar::where('id', '=', $id)->update($datosLugar);
        //dd($request->all());

        $lugar = Lugar::findOrFail($id);
        //return view('lugar.edit', compact('lugar'));
        return redirect('lugar')->with('mensaje', 'Sitio Modificado');
    }


    public function destroy($id)
    {
        // permite eliminar registros
        $lugar = Lugar::findOrFail($id);
        if (Storage::delete('public/' . $lugar->foto)) {
            Lugar::destroy($id);
        }
        return redirect('lugar')->with('mensaje', 'Sitio borrado');
    }
}
