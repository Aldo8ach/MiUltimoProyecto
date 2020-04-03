<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Vino;
use Hash;

class VinoController extends Controller
{
    public function index(){
        
        $vinos =\DB::table('vinos')
                ->select('vinos.*')
                ->orderBy('id')
                ->get();

        return view('vinos')->with('vinos',$vinos);
    }


    public function store(Request $request){
        $validator=Validator::make($request->all(),[
            'categoria'=>'required|min:3|max:50',
            'nombre'=>'required|min:3|max:50',
            'descripcion'=>'required|min:3|max:110',
            'demora'=>'required|min:3|max:200'
           
    
            ]);
            if($validator->fails()){
                return back()
                ->withInput()
                ->with('ErrorInsert','Favor de llenar todos los campos')
                ->withErrors($validator);
            }else{
                $vino=Vino::create([
                    'categoria'=>$request->categoria,
                    'nombre'=>$request->nombre,
                    'descripcion'=>$request->descripcion,
                    'demora'=>$request->demora,
                    'img'=>'default.jpg'
                ]);
                return back()->with('Listo','Se inserto el dato correctamente');
            }
    }

    public function destroy($id)
    {
        $vino=Vino::find($id);
        if($vino->img != 'default.jpg'){
            if(files_exists(public_path('users/'.$vino->img))){
                unlink(public_path('users/'.$vino->img));
            }
        }
        $vino->delete();
        return back()->with('Listo','El registro se eliminó correctamente');
    }
}
