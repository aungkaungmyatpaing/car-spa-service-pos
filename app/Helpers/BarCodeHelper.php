<?php

namespace App\Helpers;

use App\Models\Product;
use App\Models\Service;

class BarCodeHelper
{

    /**
     * Generate a barcode that is not used by any product.
     *
     * @return string
     */
    public static function generateUniqueBarcode()
    {
        $barcode = '';

        do {
            $barcode = rand(1000000000000, 9999999999999);
        } while (Service::where('barcode', $barcode)->exists());

        return $barcode;
    }
}
