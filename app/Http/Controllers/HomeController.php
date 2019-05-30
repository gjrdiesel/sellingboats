<?php

namespace App\Http\Controllers;

use App\Boat;
use App\Sale;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $boats = Boat::latest()
            ->searchable(request('search'))
            ->filterMake(request('make'))
            ->filterModel(request('model'))
            ->withCount('sales')
            ->with('sales')
            ->paginate();

        $makes = Boat::groupBy('make')
            ->limit(100)
            ->pluck('make');

        $models = Boat::groupBy('model')
            ->limit(100)
            ->filterMake(request('make'))
            ->pluck('model');

        $sales = Sale::latest()->limit(3)->orderBy('updated_at')->get();

        return view('home', compact('boats', 'makes', 'models', 'sales'));
    }
}
