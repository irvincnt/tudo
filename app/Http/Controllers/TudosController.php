<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Tudo;

use Validator;

class TudosController extends Controller
{
    public function index()
    {
    	$tudos = Tudo::all();
    	return response()
    		->json($tudos);
    }

    public function store(Request $request)
    {
    	//$data = $request->all();
    	$validator = Validator::make($request->all(), [
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
            	'error' => true, 
            ], 400);
        }
        	
        $tudos = new Tudo;
        $tudos->description = $request->get('description');
        $tudos->save();

        return response()->json($tudos);
    }

    public function update(Request $request, $id){

    	$tudo = Tudo::findOrFail($id);
    	$tudo->complete = $request->get('complete');
    	$tudo->save();

    	return response()->json($tudo);
    }
}










