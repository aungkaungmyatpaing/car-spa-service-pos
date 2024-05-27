<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $user = auth()->user();
        // if ($user->role == 'cashier') {
        //     $invoices = Invoice::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);

        // }else{
        //     $invoices = Invoice::orderBy('created_at', 'desc')->paginate(10);
        // }

        $user = auth()->user();
        $query = $request->input('query');

        if ($user->role == 'cashier') {
            $invoices = Invoice::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->when($query, function ($q) use ($query) {
                    $q->where('invoice_number', 'like', '%' . $query . '%');
                })
                ->paginate(10);
        } else {
            $invoices = Invoice::orderBy('created_at', 'desc')
                ->when($query, function ($q) use ($query) {
                    $q->where('invoice_number', 'like', '%' . $query . '%');
                })
                ->paginate(10);
        }

        return view('backend.invoice.invoices', compact('invoices'));
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
        $invoice = Invoice::find($id);
        if (!$invoice) {
            return redirect()->route('invoices.index')->with('error', 'Invoice not found!');
        }

        return view('backend.invoice.invoice-detail', compact('invoice'));
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
        $invoice = Invoice::find($id);

        $auto_print = true;
        return view('backend.invoice.invoice-print', compact('invoice', 'auto_print'));
    }
}
