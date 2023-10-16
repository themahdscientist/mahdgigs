<?php

namespace App\Http\Controllers;

use App\Models\Listing;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index', ['listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)]);
    }
}
