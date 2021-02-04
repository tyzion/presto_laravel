<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $announcements = Announcement::where('is_accepted', true)->orderBy('created_at', 'desc')->get();
        return view('welcome', compact('announcements'));
    }

    public function announcementsByCategory($name, $category_id)
    {
        $category = Category::find($category_id);
        $announcements = $category->announcements()->paginate(5);
        return view('announcements.announcements', compact('category', 'announcements'));
    }

    public function locale($locale)
    {
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
