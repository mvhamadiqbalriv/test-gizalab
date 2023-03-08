<?php

namespace App\Http\Controllers;

use App\Models\Webinar;
use App\Models\WebinarCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WebinarController extends Controller
{
 
    public function index()
    {
        $categories = WebinarCategory::get();
        $webinars = Webinar::get();

        return view('webinar.index', compact(
            'categories', 'webinars',
        ));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'item' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'amount' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'data' => $validator->errors()
            ], 400);
        }
        
        if ($request->category_id) {
            $categories = explode(',', $request->category_id);
        }

        $data = new Expense([
            'item' => $request->item,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'amount' => $request->amount,
            'description' => $request->description
        ]);

        if($data->save()){
            if ($request->category_id) {
                $data->categories()->sync($categories);
            }
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
        $expense = Webinar::with('categories')->find($id);

        if($expense){
            $expense->categoriesSelected = $expense->categories->pluck('id')->toArray();
            return response()->json([
                'status' => true,
                'data' => $expense
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
            'id' => 'required',
            'category_id' => 'required',
            'item' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'amount' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'data' => $validator->errors()
            ], 400);
        }

        $data = Webinar::find($request->id);

        if ($request->category_id) {
            $categories = explode(',', $request->category_id);
        }

        $data->item = $request->item ?: $data->item;
        $data->price = $request->price ?: $data->price;
        $data->quantity = $request->quantity ?: $data->quantity;
        $data->amount = $request->amount ?: $data->amount;
        $data->description = $request->description ?: $data->description;

        if($data->save()){
            if ($request->category_id) {
                $data->categories()->sync($categories);
            }
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
        $data = Webinar::find($id);

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

    public function categoriesIndex()
    {
        $categories = WebinarCategory::get();

        return view('webinar.category.index', compact(
            'categories'
        ));
    }

    public function categoriesSlug($slug)
    {
        $categories = WebinarCategory::where('slug', $slug)->first();

        if ($categories) {
            return response()->json([
                'status' => true,
                'data' => $categories
            ]);
        }else{
            return response()->json([
                'status' => false
            ], 404);
        }
    }

    public function categoriesStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'data' => $validator->errors()
            ], 400);
        }

        $data = new WebinarCategory([
            'name' => $request->name,
            'slug' => $request->slug
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

    public function categoriesDetail($id)
    {
        $categories = WebinarCategory::find($id);

        if($categories){
            return response()->json([
                'status' => true,
                'data' => $categories
            ]);
        }else{
            return response()->json([
                'status' => false
            ], 404);
        }
    }

    public function categoriesUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'data' => $validator->errors()
            ], 400);
        }

        $data = WebinarCategory::find($request->id);

        $data->name = $request->name ?: $data->name;

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

    public function categoriesDelete($id)
    {
        $data = WebinarCategory::find($id);

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
