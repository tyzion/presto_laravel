<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    public function index()
    {
        $announcement = Announcement::where('is_accepted', false)->where('is_rejected', false)->first();
        return view('admins.home', compact('announcement'));
    }

    public function setAccepted($id)
    {
        $a = Announcement::find($id);
        $a->is_accepted = true;
        $a->save();
        return redirect()->back();
    }

    public function setRejected($id)
    {
        $a = Announcement::find($id);
        $a->is_rejected = true;
        $a->is_accepted = false;
        $a->save();
        return redirect()->back();
    }

    public function rejected()
    {
        $announcements = Announcement::where('is_accepted', false)->where('is_rejected', true)->get();
        return view('admins.rejected', compact('announcements'));
    }

    public function delete($id)
    {
        Announcement::destroy($id);
        return redirect()->back();
    }
}
