<?php

namespace App\Http\Controllers;

use App\Models\Gcash;
use Illuminate\Http\Request;

class GcashController extends Controller
{
        public function create(Request $req){
            $val = $req->validate([
                'name' => 'required',
                'lastname' => 'required',
                'age' => 'required|numeric',
                'country' => 'required'
            ]);
            try {
                $gcash = Gcash::create($val);
                return response()->json(['success' => true, 'message' => 'Record added successfully']);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => 'Failed to add record']);
            }
        }
        public function update(Request $req, $id)
        {
            $val = Gcash::find($id);
            $val->name = $req->input('name');
            $val->lastname = $req->input('lastname');
            $val->age = $req->input('age');
            $val->country = $req->input('country');
            $val->update();
        }
        
}

