<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceHistory;
use App\Models\InvoiceProduct;
use App\Models\Product;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $reportFor = $request->get('reportFor') ?? 'today';
        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');

        $query = InvoiceHistory::select();



        if ($startDate && $endDate) {
            if ($startDate && $endDate) {
                $query->whereDate('created_at', '>=', $startDate)
                    ->whereDate('created_at', '<=', $endDate);
            }
        } else {
            switch ($reportFor) {
                case 'today':
                    $query->whereDate('created_at', Carbon::today());
                    break;
                case 'week':
                    $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()]);
                    break;
                case 'month':
                    $query->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
                    break;
                case 'year':
                    $query->whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()]);
                    break;
                default:
                    $query->whereDate('created_at', Carbon::today());
            }
        }

        $total_sale = 0;
        $total_purchase = 0;
        $total_discount = 0;
        $total_profit = 0;


        $invoices = $query->get();
        foreach ($invoices as $invoice) {
            foreach ($invoice->invoiceItemHistories as $invoiceProduct) {
                $total_purchase += $invoiceProduct->price * $invoiceProduct->quantity;
            }

            if ($invoice->is_fixed == true) {
                $total_discount += $invoice->discount;
            } else {
                $total_discount += $invoice->total * $invoice->discount / 100;
            }

            $total_sale += $invoice->grand_total;
        }

        $total_profit = $total_sale - $total_purchase;
        $profit_percentage = $total_sale != 0 ? round(($total_profit / $total_sale) * 100, 2) : 0;

        // $top_products = $this->getTopProducts($reportFor, $startDate, $endDate);
        // $least_sale_products = $this->getLeastSaleProducts($reportFor, $startDate, $endDate);

        $top_products = 0;
        $least_sale_products = 0;
        $has_stock_alert = 0;


        return view('backend.dashboard.dashboard', compact('total_sale', 'total_profit', 'profit_percentage', 'total_discount', 'top_products', 'least_sale_products', 'has_stock_alert'));
    }





    private function getTopProducts($reportFor, $startDate, $endDate)
    {
        return $this->getProductsBySales($reportFor, $startDate, $endDate, 'desc', 5);
    }

    private function getLeastSaleProducts($reportFor, $startDate, $endDate)
    {
        return $this->getProductsBySales($reportFor, $startDate, $endDate, 'asc', 5);
    }

    private function getProductsBySales($reportFor, $startDate, $endDate, $order, $limit)
    {
        return Service::withCount(['invoiceItemHistories as sales_count' => function ($query) use ($reportFor, $startDate, $endDate) {
            $query->select(DB::raw("sum(quantity) as quantity_sold"))
                ->whereHas('invoice', function ($query) use ($reportFor, $startDate, $endDate) {
                    $this->applyTimeInterval($query, $reportFor, $startDate, $endDate);
                });
        }])->orderBy('sales_count', $order)->take($limit)->get();
    }


    //apply date filter
    function applyTimeInterval($query, $reportFor, $startDate, $endDate)
    {
        if ($startDate && $endDate) {
            $query->whereDate('invoices.created_at', '>=', $startDate)
                ->whereDate('invoices.created_at', '<=', $endDate);
        } else {
            switch ($reportFor) {
                case 'today':
                    $query->whereDate('invoices.created_at', Carbon::today());
                    break;
                case 'week':
                    $query->whereBetween('invoices.created_at', [Carbon::now()->startOfWeek(), Carbon::now()]);
                    break;
                case 'month':
                    $query->whereBetween('invoices.created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
                    break;
                case 'year':
                    $query->whereBetween('invoices.created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()]);
                    break;
                default:
                    $query->whereDate('invoices.created_at', Carbon::today());
            }
        }
    }
}
