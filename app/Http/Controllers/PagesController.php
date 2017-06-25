<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $title = 'Buddget - Manage your expenses';
        return view('pages.index')->with('title', $title);
    }

    public function aboutus()
    {
        $title = "About Us";
        return view('pages.aboutus')->with('title', $title);
    }

    public function contact()
    {
        $title = "Contact Us";
        return view('pages.contact')->with('title', $title);
    }
}
