<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('assets/images/herocarlogo.png') }}">
    <title>Receipt</title>
</head>

<style type="text/css">
    @page {
        margin: 0;
    }

    body {
        width: 68mm;
        height: 100%;
        font-size: 12px;
    }

    .detail {
        display: flex;
        flex-direction: column;
    }
</style>
<body style="font-family:Verdana, Geneva, Tahoma, sans-serif;"
    @if ($auto_print) onload="window.print()" @endif>

    <table style="width: 100%" border="0">
        <tr>
            <td style="text-align: center">RECEIPT</td>
        </tr>

        <tr class="detail">
            <td style="text-align: center; font-weight: bold;">Hero Car Sale & Spa</td>
            {{-- <td style="text-align: center">Branded Fashion Collection</td> --}}
            <td style="text-align: center">

                ၃၈၇(ခ)၊အထက်ဗဟိုလမ်း ၊ အနောက်ကြို့ကုန်း <br> အင်းစိန်မြို့နယ် ၊ ရန်ကုန်
            </td>
            <td style="text-align: center">09267700616</td>
            <td style="text-align: center">09267700617</td>
            <td style="">
                <div style="display:flex; justify-content: space-between;">
                    <span>{{$invoice->invoice_number}}</span>
                    <span>{{ date('d-m-Y', strtotime($invoice->created_at)) }}</span>
                </div>
            </td>
        </tr>
    </table>
    <div style="border-top: 1px dashed; margin-top: 5px"></div>

    <table style="width: 100%" border="0">
        <tr>
            <td><b>Name</b></td>
            <td style="text-align:center"><b>Price</b></td>
            <td style="text-align:center"><b>QTY</b></td>
            <td style="text-align:right"><b>Ks</b></td>
        </tr>

        @foreach ($invoice->invoiceItems as $product)
            <tr>
                <td>
                    {{ $product->service->name ?? ' -- Deleted Service !! --' }}
                </td>
                <td style="text-align: center;">
                    {{ number_format($product->price) }}
                </td>
                <td style="text-align:center">
                    {{ $product->quantity }}
                </td>
                <td style="text-align:right">
                    {{ number_format($product->total_price) }}
                </td>
            </tr>
        @endforeach

        @if ($invoice->discount > 0)
            <tr>
                <td colspan="3" style="text-align: right">Discount : </td>
                <td style="text-align: right">
                    @if ($invoice->is_fixed)
                        {{ number_format($invoice->discount) }}
                    @else
                        {{ $invoice->discount }}%
                    @endif
                </td>
            </tr>
        @endif

    </table>

    <div style="border-top: 1px dashed; margin-top: 5px"></div>

    <table style="width: 100%" border="0">
        <tr>
            <td>Total</td>
            <td style="text-align:right">
                {{ number_format($invoice->grand_total, 0) }}
            </td>
        </tr>
    </table>

    <div style="border-top: 1px dashed; margin-top: 5px; margin-bottom: 6px"></div>
    <table style="width: 100%;" border="0">
        <tr>
            <td style="text-align: center">Trust Us We're Professional!</td>
        </tr>
        {{-- <tr>
            <td style="text-align: center">၀ယ်ပြီးပစ္စည်းပြန်မလဲပါ</td>
        </tr> --}}
    </table>
</body>

</html>
