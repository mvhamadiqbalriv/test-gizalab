<?php

namespace App\Http\Controllers;

use App\Models\Webinar;
use App\Models\WebinarCategory;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(Request $request)
    {

        $webinar_category = $request->webinar_category ?: null;
        $search = $request->search ?: null;

        $webinar_categories = WebinarCategory::get();
        $webinars = Webinar::with('mentors')->when($webinar_category, function($q) use ($webinar_category){
            $q->whereHas('categories', function($q) use ($webinar_category) {
                return $q->where('slug', $webinar_category);
            });
        })->when($search, function($q) use ($search){
            return $q->where('title', 'like', '%'.$search.'%');
        })->get();

        return view('landingpage', compact(
            'webinar_categories', 'webinars'
        ));
    }
}
