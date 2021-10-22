<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Proveedor;

class ProveedorController extends Controller
{

    protected $table = 'proveedors';

    public function __construct(){
        $this->middleware('auth:api');
    }


    public function getProveedores(){
        return response()->json(Proveedor::all());
    }

    public function getDistribuidores(){
        return response()->json(Proveedor::where('distribuidor', 1)->get());
    }

    public function updateProveedorIsDistribuidor(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'value' => 'required|boolean',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422); 
        }else{
            $proveedor = Proveedor::find($request->id);
            $proveedor->distribuidor = $request->value;
            $proveedor->save();
        }
    }
}
