<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barcode</title>
</head>

<style>
    @page {
        margin: 0;
    }

    body {
        /* margin: 0px 0px 0px 0px; */
        margin: 0;
        font-size: 12px;
    }

    .barcode-container {
        display: flex;
        flex-direction: column;
        text-align: center;
    }

    .main-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .product-name {
        font-size: 10px;
        text-align: center;
    }

    .barcode {
        font-size: 10px;
    }

    .brand {
        font-size: 10px;
    }

    /* .barcode-img {
        height: 100px;
    } */
</style>
<script>
    function barcodePrint() {
        window.print();
        // setTimeout(() => {
        //     location.replace('/products')
        // }, 0);
    }
</script>

<body onload="barcodePrint()" style="font-family:Verdana, Geneva, Tahoma, sans-serif;">
    <div class="main-container">
        <span class="product-name">{{ $service['name'] }}</span>
        <div class="barcode-container">
            <span class="barcode-img">{!! $barcode !!}</span>
            {{-- <br> --}}
            <span class="barcode">{{ $service['barcode'] }}</span>
            {{-- <br> --}}
            <div>
                <span class="brand">{{ $service->category->category }} {{ $service->subCategory ? '| ' . $service->subCategory->name : '' }} | {{ number_format($service->price) }}Ks</span>
            </div>
        </div>
    </div>
</body>

</html>
