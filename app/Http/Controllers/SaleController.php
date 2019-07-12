<?php

namespace App\Http\Controllers;

use App\Boat;
use App\Http\Requests\SaleRequest;
use App\Sale;

class SaleController extends Controller
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
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $boat = Boat::find(request('boat'));

        abort_if($boat == null, 404, __('Could not find that boat in our inventory to sell it.'));

        return view('sales.create', compact('boat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SaleRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SaleRequest $request)
    {
        $sale = Sale::create($request->all());
        $sale->customers()->sync($request->customers);

        return redirect()->home();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Sale $sale
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        return view('sales.view', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Sale $sale
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        return view('sales.edit', compact('sale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SaleRequest $request
     * @param \App\Sale   $sale
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SaleRequest $request, Sale $sale)
    {
        $sale->update($request->all());
        $sale->customers()->sync($request->customers);

        return redirect()->route('sale.show', $sale);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Sale $sale
     *
     * @return void
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
