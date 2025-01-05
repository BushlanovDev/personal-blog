<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return 'home';
    }

    public function about(Request $request)
    {
        return 'about';
    }
}
