<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Models\MaterialRubro;
use App\Models\MaterialDci;

class MaterialController extends Controller
{
    protected $table_rubro = 'material_rubros';
    protected $table_dci = 'material_dcis';

    public function __construct(){
        $this->middleware('auth:api');
    }

    public function getRubro(Request $request){
        $validator = Validator::make($request->all(), [
        ]);
        $where = array();
        $rubro = DB::table($this->table_rubro);
        if(isset($request->rubro) || $request->rubro != '') $rubro->where('rubro', 'like', '%'.$request->rubro.'%');
        return response()->json($rubro->get());
    }

    public function createRubro(Request $request){
        $validator = Validator::make($request->all(), [
            'rubro'  => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422); 
        }else{
            try{
                $rubro = new MaterialRubro;
                $rubro->rubro = $request->rubro;
                $rubro->save();
                return $rubro;
            }catch(\Exception $e){
                //return response()->json(array('error_code'=> $e->errorInfo[1]), 422);
                return response()->json($e,422);
            }
        }
    }

    public function updateRubro(Request $request){
        $validator = Validator::make($request->all(), [
            'id'        => 'required|integer',
            'rubro'     => 'required|string',
            'enabled'   => 'required|boolean',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422); 
        }else{
            try{
                $rubro = MaterialRubro::find($request->id);
                $rubro->rubro = $request->rubro;
                $rubro->enabled = $request->enabled;
                $rubro->save();
                return $rubro;
            }catch(\Exception $e){
                return response()->json(array('error_code'=> $e->errorInfo[1]), 422);
            }
        }
    }

    public function getDCI(Request $request){
        $validator = Validator::make($request->all(), [
        ]);
        $where = array();
        $dci = DB::table($this->table_dci);
        if(isset($request->dci) || $request->dci != '') $dci->where('dci', 'like', '%'.$request->dci.'%');
        return response()->json($dci->get());
    }

    public function createDCI(Request $request){
        $validator = Validator::make($request->all(), [
            'principio_activo'  => 'required',
            'concentracion'     => 'required',
            'forma_farmaceutica'=> 'required',
            'dci'               => 'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422); 
        }else{
            try{
                $dci = new MaterialDci;
                $dci->principio_activo = $request->principio_activo;
                $dci->concentracion = $request->concentracion;
                $dci->forma_farmaceutica = $request->forma_farmaceutica;
                $dci->dci = $request->dci;
                $dci->save();
                return $dci;
            }catch(\Exception $e){
                return response()->json(array('error_code'=> $e->errorInfo[1]), 422);
            }
        }
    }

    public function updateDCI(Request $request){
        $validator = Validator::make($request->all(), [
            'id'        => 'required|integer',
            'principio_activo'     => 'required|string',
            'concentracion'     => 'required|string',
            'forma_farmaceutica'     => 'required|string',
            'dci'     => 'required|string',
            'enabled'   => 'required|boolean',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422); 
        }else{
            try{
                $dci = MaterialDci::find($request->id);
                $dci->principio_activo = $request->principio_activo;
                $dci->concentracion = $request->concentracion;
                $dci->forma_farmaceutica = $request->forma_farmaceutica;
                $dci->dci = $request->dci;
                $dci->enabled = $request->enabled;
                $dci->save();
                return $dci;
            }catch(\Exception $e){
                return response()->json(array('error_code'=> $e->errorInfo[1]), 422);
            }
        }
    }
}
