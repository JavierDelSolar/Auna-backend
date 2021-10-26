<?php

namespace App\Http\Controllers;

use DB;
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

    public function getProveedor(Request $request){
        $validator = Validator::make($request->all(), [
        ]);
        $where = array();
        $proveedor = DB::table($this->table);
        if(isset($request->razon_social) || $request->razon_social != '') $proveedor->where('razon_social', 'like', '%'.$request->razon_social.'%');
        return response()->json($proveedor->get());
    }


    public function createProveedor(Request $request){
        $validator = Validator::make($request->all(), [
            'razon_social'  => 'required|string',
            'ruc'           => 'required|string|min:11|max:11',
            'direccion'     => 'required|string',
            'preferido'     => 'required|boolean',
            'distribuidor'  => 'required|boolean'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422); 
        }else{
            try{
                $proveedor = new Proveedor;
                $proveedor->razon_social = $request->razon_social;
                $proveedor->ruc = $request->ruc;
                $proveedor->direccion = $request->direccion;
                $proveedor->preferido = $request->preferido;
                $proveedor->distribuidor = $request->distribuidor;
                $proveedor->save();
                return $proveedor;
            }catch(\Exception $e){
                return response()->json(array('error_code'=> $e->errorInfo[1]), 422);
            }
            
        }
    }

    public function updateProveedor(Request $request){
        $validator = Validator::make($request->all(), [
            'id'                    => 'required|integer',
            'razon_social'          => 'required|string',
            'ruc'                   => 'required|string|min:11|max:11',
            'direccion'             => 'string',
            'preferido'             => 'required|boolean',
            'distribuidor'          => 'required|boolean',
            'enabled'               => 'required|boolean',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422); 
        }else{
            try{
                $proveedor = Proveedor::find($request->id);
                $proveedor->razon_social = $request->razon_social;
                $proveedor->ruc = $request->ruc;
                $proveedor->direccion = $request->direccion;
                $proveedor->representante_nombre = $request->representante_nombre;
                $proveedor->representante_dni = $request->representante_dni;
                $proveedor->nro_partida = $request->nro_partida;
                $proveedor->preferido = $request->preferido;
                $proveedor->distribuidor = $request->distribuidor;
                $proveedor->enabled = $request->enabled;
                $proveedor->save();
                return $proveedor;
            }catch(\Exception $e){
                return response()->json(array('error_code'=> $e->errorInfo[1]), 422);
            }
        }
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
        return $proveedor;
    }
}
