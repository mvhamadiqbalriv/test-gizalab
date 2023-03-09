<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Models\Webinar;
use App\Models\WebinarCategory;
use App\Models\WebinarParticipant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WebinarController extends Controller
{
 
    public function index()
    {
        $categories = WebinarCategory::get();
        $webinars = Webinar::get();
        $mentors = Mentor::get();

        return view('webinar.index', compact(
            'categories', 'webinars', 'mentors'
        ));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mentors_id' => 'required',
            'categories_id' => 'required',
            'title' => 'required',
            'thumbnail' => 'required|mimes:jpg,jpeg,png,svg',
            'class_type' => 'required',
            'date' => 'required',
            'quota' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'data' => $validator->errors()
            ], 400);
        }

        $thumbnail = ($request->thumbnail)
        ? $request->file('thumbnail')->store("/public/webinar")
        : null;
        
        if ($request->mentors_id) {
            $mentors = explode(',', $request->mentors_id);
        }
        
        if ($request->categories_id) {
            $categories = explode(',', $request->categories_id);
        }

        $data = new Webinar([
            'title' => $request->title,
            'thumbnail' => $thumbnail,
            'class_type' => $request->class_type,
            'date' => $request->date,
            'quota' => $request->quota,
            'description' => $request->description,
        ]);

        if($data->save()){
            if ($request->mentors_id) {
                $data->mentors()->sync($mentors);
            }
            if ($request->categories_id) {
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
        $webinar = Webinar::with('mentors')->find($id);

        if($webinar){
            $webinar->mentorsSelected = $webinar->mentors->pluck('id')->toArray();
            $webinar->categoriesSelected = $webinar->categories->pluck('id')->toArray();
            return response()->json([
                'status' => true,
                'data' => $webinar
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
            'mentors_id' => 'required',
            'categories_id' => 'required',
            'title' => 'required',
            'thumbnail' => 'nullable|mimes:jpg,jpeg,png,svg',
            'class_type' => 'required',
            'date' => 'required',
            'quota' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'data' => $validator->errors()
            ], 400);
        }

        $data = Webinar::find($request->id);

        $thumbnail = ($request->thumbnail)
        ? $request->file('thumbnail')->store("/public/webinar")
        : $data->thumbnail;

        if ($request->categories_id) {
            $categories = explode(',', $request->categories_id);
        }

        if ($request->mentors_id) {
            $mentors = explode(',', $request->mentors_id);
        }

        $data->title = $request->title ?: $data->title;
        $data->quota = $request->quota ?: $data->quota;
        $data->description = $request->description ?: $data->description;
        $data->class_type = $request->class_type ?: $data->class_type;
        $data->thumbnail = $thumbnail ?: $data->thumbnail;
        $data->date = $request->date ?: $data->date;

        if($data->save()){
            if ($request->mentors_id) {
                $data->mentors()->sync($mentors);
            }
            if ($request->categories_id) {
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

        if($data){
            if(Storage::exists($data->thumbnail)){
                Storage::delete($data->thumbnail);
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
            'name' => 'required',
            'slug' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'data' => $validator->errors()
            ], 400);
        }

        $data = WebinarCategory::find($request->id);

        $data->name = $request->name ?: $data->name;
        $data->slug = $request->slug ?: $data->slug;

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

    public function participantsIndex()
    {
        $participants = WebinarParticipant::get();
        $webinars = Webinar::selectRaw('webinars.*, 
            ROUND((COUNT(webinar_has_participants.id) / webinars.quota) * 100) AS quota_percentage')
        ->leftJoin('webinar_has_participants', 'webinars.id', '=', 'webinar_has_participants.webinar_id')
        ->groupBy('webinars.id')
        ->havingRaw('COUNT(webinar_has_participants.id) < webinars.quota')
        ->get();

        return view('webinar.participant.index', compact(
            'participants', 'webinars'
        ));
    }

    public function participantsStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'webinar_id' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'data' => $validator->errors()
            ], 400);
        }

        $data = new WebinarParticipant([
            'name' => $request->name,
            'webinar_id' => $request->webinar_id
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

    public function participantsDetail($id)
    {
        $participants = WebinarParticipant::with('webinar')->find($id);

        if($participants){
            return response()->json([
                'status' => true,
                'data' => $participants
            ]);
        }else{
            return response()->json([
                'status' => false
            ], 404);
        }
    }

    public function participantsUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'webinar_id' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'data' => $validator->errors()
            ], 400);
        }

        $data = WebinarParticipant::find($request->id);

        $data->name = $request->name ?: $data->name;
        $data->webinar_id = $request->webinar_id ?: $data->webinar_id;

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

    public function participantsDelete($id)
    {
        $data = WebinarParticipant::find($id);

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
