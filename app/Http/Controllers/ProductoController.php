<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datosProducto['productos']=Producto::paginate(3);
        return view('producto.index', $datosProducto);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('producto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validar=[
            'nombre'=>'required|string|max:50',
            'precio'=>'required|integer',
            'cantidad'=>'required|number',
            'costo'=>'required|integer',
            'cantidad'=>'required|integer',
            'estado'=>'required|integer',
            'imagen'=>'required|mimes:png,jpg,jpeg,tif,tiff|max:5000',
        ];
        $alerta=[
            'required'=>'El campo :attribute es obligatorio',
        ];
        $this->validate($request, $validar, $alerta);

        $datosProducto = request()->Except('_token');
        if ($request->hasfile('imagen')){
            $datosProducto['imagen']=$request->file('imagen')->store('uploads','public');
        }
        Producto::insert($datosProducto);
        //return response()->json($datosProducto);
        return redirect('producto')->with('mensaje', 'El nuevo producto ha sido creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $producto=Producto::findorfail($id);
        return view('producto.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validar=[
            'nombre'=>'required|string|max:50',
            'precio'=>'required|integer',
            'cantidad'=>'required|number',
            'costo'=>'required|integer',
            'cantidad'=>'required|integer',
            'estado'=>'required',
        ];
        $alerta=[
            'required'=>'El campo :attribute es obligatorio',
        ];
        if ($request->hasFile('imagen')){
            $info=['imagen'=>'required|mimes:jpg,jpeg,png|max:5000'];
            $alerta=['imagen.required'=>'Debe adjuntar la imagen del producto'];
        }
        $this->validate($request, $validar, $alerta);

        $datosProducto = request()->Except(['_token', '_method']);

        if($request->hasfile('imagen')){            
            $producto=Producto::findorfail($id);
            Storage::delete(['public/'.$producto->imagen]);
            $datosProducto['imagen']=$request->file('imagen')->store('uploads', 'public');
    }
        Producto::where('id','=',$id)->update($datosProducto);
        $producto=Producto::findorfail($id);
        //return view('producto.edit', compact('producto'));
        return redirect('producto')->with('mensaje', 'El registro ha sido actualizado');

}
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $producto=Producto::findorfail($id);
        if (Storage::delete('public/'.$producto->imagen));{
            Producto::destroy($id);
        }
        return redirect('producto')->with('mensaje', 'El producto ha sido eliminado');;
       
    }
}
