<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSizeRequest;
use App\Models\Category;
use App\Models\Duration;
use App\Models\Service;
use App\Models\Size;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Helpers\BarCodeHelper;
use App\Http\Requests\CreateServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use Illuminate\Support\Facades\DB;
use Picqer\Barcode\BarcodeGeneratorPNG;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Service::query();

        if ($request->has('sub_category_id') && $request->input('sub_category_id') !== null) {
            $sub_category_id = $request->input('sub_category_id');
            $query->where('sub_category_id', $sub_category_id);
        }

        if ($request->has('category_id') && $request->input('category_id') !== null) {
            $categoryId = $request->input('category_id');
            $query->where('category_id', $categoryId);
        }
        $query->orderBy('created_at', 'desc');
        $services = $query->paginate(10)->appends($request->except('page'));

        foreach ($services as $service) {
            $generator = new BarcodeGeneratorPNG();
            $barcode = $generator->getBarcode(
                $service->barcode,
                $generator::TYPE_CODE_128,
                1
            );
            $service->barcode_base64 = base64_encode($barcode);
        }

        $subCategories = SubCategory::all();
        $categories = Category::all();

        return view('backend.service.index', compact('services', 'subCategories', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::with('subCategories')->get();
        $durations = Duration::all();
        $sizes = Size::all();
        return view('backend.service.create', compact( 'categories','sizes','durations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateServiceRequest $request)
    {
        try {
            DB::beginTransaction();

            $serviceData = $request->validated();
            $serviceData['barcode'] = BarCodeHelper::generateUniqueBarcode();

            $newService = Service::create($serviceData);
            DB::commit();
            return redirect()->route('services.index')->with('success', 'Service created successfully');
        } catch (\Throwable $th) {
            return $th;
            DB::rollback();
            return redirect()->route('services.index')->with('error', 'Service creation failed');
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
        $service = Service::find($id);
        $categories = Category::with('subCategories')->get();
        $durations = Duration::all();
        $sizes = Size::all();
        return view('backend.service.edit', compact( 'categories','sizes','durations','service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, string $id)
    {
        try {
            DB::beginTransaction();

            $service = Service::find($id);
            $serviceData = $request->validated();

            $service->update($serviceData);

            DB::commit();
            return redirect()->route('services.index')->with('success', 'Service updated successfully');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('services.index')->with('error', 'Service update failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $service = Service::find($id);
            $carts = $service->carts;
            if ($carts->count() > 0) {
                return redirect()->back()->with('error', 'Service has carts, cannot delete');
            }

            $service->delete();
            return redirect()->back()->with('success', 'Successfully delete service');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Error deleting service');
        }
    }

    public function print($id)
    {
        $service   = Service::with('category','subCategory','duration','size')->where('id', $id)->first();
        $generator = new BarcodeGeneratorPNG();
        $barcode   = $generator->getBarcode(
            $service->barcode,
            $generator::TYPE_CODE_128,
            1
        );
        $barcode = '<img style="scale: 0.8;" src="data:image/png;base64,' . base64_encode($barcode) . '" />';

        return view('backend.service.print-barcode', compact('service', 'barcode'));
    }
}
