<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MentorController extends Controller
{
    
    public function index()
    {
        $mentors = Mentor::get();

        return view('mentor.index', compact(
            'mentors'
        ));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'photo' => 'required|mimes:svg,png,jpg,jpeg'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'data' => $validator->errors()
            ], 400);
        }
        
        $photo = ($request->photo)
        ? $request->file('photo')->store("/public/mentor")
        : null;

        $data = new Mentor([
            'name' => $request->name,
            'photo' => $photo
        ]);

        if($data->save()){
            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        }else{
            return response()->json([
                'status' => false
            ], 404);
        }
    }
    
    public function detail($id)
    {
        $mentor = Mentor::find($id);

        if($mentor){
            return response()->json([
                'status' => true,
                'data' => $mentor
            ]);
        }else{
            return response()->json([
                'status' => false
            ], 404);
        }
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'photo' => 'nullable|mimes:svg,png,jpg,jpeg'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'data' => $validator->errors()
            ], 400);
        }

        $data = Mentor::find($request->id);

        $photo = ($request->photo)
        ? $request->file('photo')->store("/public/mentor")
        : $data->photo;

        if($request->photo){
            if (Storage::exists($data->photo)) {
                Storage::delete($data->photo);
            }
        }

        $data->name = $request->name ?: $data->name;
        $data->photo = $photo;

        if($data->save()){
            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        }else{
            return response()->json([
                'status' => false
            ], 404);
        }
    }
    
    public function delete($id)
    {
        $data = Mentor::find($id);
        if (Storage::exists($data->photo)) {
            Storage::delete($data->photo);
        }

        if($data->delete()){
            
            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        }else{
            return response()->json([
                'status' => false
            ], 404);
        }
    }

}
