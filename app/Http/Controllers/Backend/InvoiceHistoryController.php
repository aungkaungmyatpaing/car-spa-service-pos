<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\InvoiceHistory;
use Illuminate\Http\Request;

class InvoiceHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $invoices = InvoiceHistory::orderBy('created_at', 'desc')
        ->when($query, function ($q) use ($query) {
            $q->where('invoice_number', 'like', '%' . $query . '%');
        })
        ->paginate(10);

        return view('backend.history.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoice = InvoiceHistory::find($id);
        if (!$invoice) {
            return redirect()->route('invoiceHistories.index')->with('error', 'Invoice not found!');
        }

        return view('backend.history.detail', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function print(string $id)
    {
        $invoice = InvoiceHistory::find($id);

        $auto_print = true;
        return view('backend.history.print', compact('invoice', 'auto_print'));
    }
}
