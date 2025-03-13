<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('invoices.create');
    }

    public function store(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'invoice_date' => 'required|date',
            'items.*.item_name' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0.01',
            'discount' => 'nullable|numeric|min:0',
        ]);

        $grossTotal = 0;
        foreach ($request->items as $item) {
            $grossTotal += $item['quantity'] * $item['unit_price'];
        }

        $discount = $request->discount ?? 0;
        $totalAmount = $grossTotal - $discount;

        $invoice = Invoice::create([
            'invoice_number' => 'INV-' . time(),
            'invoice_date' => $request->invoice_date,
            'gross_total' => $grossTotal,
            'discount' => $discount,
            'total_amount' => $totalAmount,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
        ]);

        foreach ($request->items as $item) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'item_name' => $item['item_name'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
            ]);
        }

        return redirect()->route('invoices.create')->with('success', 'Invoice created successfully');
        // return response()->json(['message' => 'Invoice created successfully', 'invoice' => $invoice]);
    }
}