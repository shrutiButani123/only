<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buyer;
use App\Exports\BuyersExport;
use Maatwebsite\Excel\Facades\Excel;

class BuyerController extends Controller
{
    public function index()
    {
        $buyers = Buyer::all();
        return view('buyers.index', compact('buyers'));
    }

    public function create()
    {
        return view('buyers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:buyers',
            'address' => 'required',
            'mobile_no' => 'required|digits:10',
            'buyer_type' => 'required',
            'cut_quality' => 'required',
            'color' => 'required',
            'clarity' => 'required',
            'carat_weight' => 'required|numeric',
            'amount' => 'required|numeric',
        ]);

        Buyer::create($request->all());

        return redirect()->route('buyers.index')->with('success', 'Buyer added successfully.');
    }

    public function edit(Buyer $buyer)
    {
        return view('buyers.edit', compact('buyer'));
    }

    public function update(Request $request, Buyer $buyer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:buyers,email,' . $buyer->id,
            'address' => 'required',
            'mobile_no' => 'required|digits:10',
            'buyer_type' => 'required',
            'cut_quality' => 'required',
            'color' => 'required',
            'clarity' => 'required',
            'carat_weight' => 'required|numeric',
            'amount' => 'required|numeric',
        ]);

        $buyer->update($request->all());

        return redirect()->route('buyers.index')->with('success', 'Buyer updated successfully.');
    }

    public function destroy(Buyer $buyer)
    {
        $buyer->delete();
        return redirect()->route('buyers.index')->with('success', 'Buyer deleted successfully.');
    }

    public function export(Request $request)
    {
        $exportType = $request->input('type');

        if ($exportType === 'all') {
            $buyers = Buyer::all(); // Fetch all buyers
        } else {
            $buyers = Buyer::paginate(10); // Fetch only the current page buyers
        }

        return Excel::download(new BuyersExport($buyers), 'buyers.xlsx');
    }

}

