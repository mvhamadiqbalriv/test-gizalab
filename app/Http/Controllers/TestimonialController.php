<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
   
    public function index()
    {
        $testimonials = Testimonial::get();

        return view('testimonial.index', compact(
            'testimonials'
        ));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'photo' => 'required|mimes:svg,png,jpg,jpeg',
            'company' => 'required',
            'position' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'data' => $validator->errors()
            ], 400);
        }
        
        $photo = ($request->photo)
        ? $request->file('photo')->store("/public/testimonial")
        : null;

        $data = new Testimonial([
            'name' => $request->name,
            'description' => $request->description,
            'photo' => $photo,
            'company' => $request->company,
            'position' => $request->position,
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
        $testimonial = Testimonial::find($id);

        if($testimonial){
            return response()->json([
                'status' => true,
                'data' => $testimonial
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
            'description' => 'required',
            'photo' => 'nullable|mimes:svg,png,jpg,jpeg',
            'company' => 'required',
            'position' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'data' => $validator->errors()
            ], 400);
        }

        $data = Testimonial::find($request->id);

        $photo = ($request->photo)
        ? $request->file('photo')->store("/public/testimonial")
        : $data->photo;

        if($request->photo){
            if (Storage::exists($data->photo)) {
                Storage::delete($data->photo);
            }
        }

        $data->name = $request->name ?: $data->name;
        $data->description = $request->description ?: $data->description;
        $data->photo = $photo;
        $data->company = $request->company ?: $data->company;
        $data->position = $request->position ?: $data->company;

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
        $data = Testimonial::find($id);
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
