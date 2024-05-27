<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\CheckoutRequest;
use App\Http\Requests\UpdateQuantityRequest;
use App\Models\Cart;
use App\Models\Invoice;
use App\Models\InvoiceHistory;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    //getTotalPrice
    public function getTotalPrice()
    {
        $carts = Cart::where('user_id', Auth::id())->get();
        $total_price = 0;

        foreach ($carts as $cart) {
            $total_price += $cart->total_price;
        }

        return response()->json([
            'success' => true,
            'total_price' => $total_price,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddToCartRequest $request)
    {
        $barcode = $request->validated()['barcode'];
        $service = Service::where('barcode', $barcode)->first();

        if ($service) {


        $old_cart = Cart::where('service_id', $service->id)->first();

        if ($old_cart) {
            $old_cart->quantity += 1;
            $old_cart->total_price += $service->price;
            $old_cart->update();
        } else {
            $new_cart = new Cart();
            $new_cart->user_id = Auth::id();
            $new_cart->service_id = $service->id;
            $new_cart->quantity = 1;
            $new_cart->total_price = $service->price;
            $new_cart->save();
        }

        return redirect()->back()->with('success', 'Service added to cart successfully');
        }else{
            return redirect()->back()->with('error', 'Service not found');
        }
    }

    //updateQuantity
    public function updateQuantity(UpdateQuantityRequest $request, int $cartId)
    {
        $cart = Cart::find($cartId);
        $new_quantity = $request->validated()['quantity'];

        $cart->quantity = $new_quantity;
        $cart->total_price = $cart->service->price * $new_quantity;
        $cart->update();

        return response()->json([
            'success' => true,
        ]);
    }

    //checkout
    public function checkout(CheckoutRequest $request)
    {
        $checkoutData = $request->validated();
        $carts = Cart::where('user_id', Auth::id())->get();
        if ($carts->count() == 0) {
            return redirect()->back()->with('error', 'Cart is empty');
        }

        $total_price = 0;

        try {
            DB::beginTransaction();

            $newInvoice = Invoice::create([
                'user_id' => Auth::id(),
                'invoice_number' => 'INV' . time(),
                'total_pirce' => 0,
                'discount' => $checkoutData['discount'],
                'is_fixed' => $checkoutData['discount_type'] == '1' ? true : false,
                'grand_total' => 0,
                'paid' => 0,
                'change' => 0,
            ]);

            foreach ($carts as $cart) {
                $newInvoice->invoiceItems()->create([
                    'user_id' => Auth::id(),
                    'service_id' => $cart->service_id,
                    'price' => $cart->service->price,
                    'quantity' => $cart->quantity,
                    'total_price' => round($cart->service->price * $cart->quantity),
                ]);

                $total_price += $cart->service->price * $cart->quantity;

                // Delete cart after checkout
                $cart->delete();
            }

            $newInvoice->total_price = $total_price;
            if ($checkoutData['discount_type'] == '1') {
                $newInvoice->grand_total = round($total_price - $checkoutData['discount']);
            } else {
                $newInvoice->grand_total = round($total_price - ($total_price * $checkoutData['discount'] / 100));
            }

            $newInvoice->paid = $checkoutData['paid'];
            $newInvoice->change = round($checkoutData['paid'] - $newInvoice->grand_total);
            $newInvoice->update();

            $invoiceHistory = InvoiceHistory::create([
                'user_id' => $newInvoice->user_id,
                'invoice_number' => $newInvoice->invoice_number,
                'total_price' => $newInvoice->total_price,
                'discount' => $newInvoice->discount,
                'is_fixed' => $newInvoice->is_fixed,
                'grand_total' => $newInvoice->grand_total,
                'paid' => $newInvoice->paid,
                'change' => $newInvoice->change,
            ]);

            foreach ($newInvoice->invoiceItems as $value) {
                $invoiceHistory->invoiceItemHistories()->create([
                    'user_id' => $value->user_id,
                    'service_name' => $value->service->name,
                    'price' => $value->service->price,
                    'quantity' => $value->quantity,
                    'total_price' => round($value->service->price * $value->quantity),
                ]);
            }

            DB::commit();

            $invoice = $newInvoice;
            return view('backend.invoice.invoice-detail', compact('invoice'));
            // return redirect()->back()->with('success', 'Checkout successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
            return redirect()->back()->with('error', 'An error occurred during checkout');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        try {
            $cart = Cart::find($id);
            $cart->delete();

            return redirect()->back()->with('success', 'Successfully delete item from cart');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred during delete item');
        }
    }
}
