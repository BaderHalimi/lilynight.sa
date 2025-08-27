<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;
// use App\Models\Providers;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($provider_id)
    {
        $services = Services::where('provider_id', $provider_id)->get();
        // dd($services);
        return response()->json($services);
    }
    public function GetServices($provider_id)
    {
        $services = Services::where('provider_id', $provider_id)->get();
        return response()->json($services);
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
        $provider = auth()->user()->providers()->findOrFail($request->provider_id);

        $request->validate([
            'service_name' => 'required|string|max:255',
            'service_price' => 'required|numeric|min:0',
            'service_category' => 'nullable|string|max:100',
            'service_description' => 'nullable|string',
            'service_features' => 'nullable|string',
            'options' => 'nullable|array',
            'addons' => 'nullable|array',
            'days' => 'nullable|array',
            'on_demand' => 'nullable|boolean',
            'service_gallery.*' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
            'service_main_image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
            'provider_id' => 'required|exists:providers,id',
        ]);

        $mainImagePath = null;
        if ($request->hasFile('service_main_image')) {
            $mainImagePath = $request->file('service_main_image')->store('services', 'public');
        }

        $galleryFiles = [];
        if ($request->hasFile('service_gallery')) {
            foreach ($request->file('service_gallery') as $file) {
                $path = $file->store('services', 'public');
                $galleryFiles[] = $path;
            }
        }

        $service = new Services();
        $service->name = $request->service_name;
        $service->price = $request->service_price;
        $service->type = $request->service_category;
        $service->description = $request->service_description;
        $service->provider_id = $provider->id;
        $service->features = json_encode([
            'features' => $request->service_features,
            'options' => $request->options ?? [],
            'addons' => $request->addons ?? [],
            'days' => $request->days ?? [],
            'on_demand' => $request->on_demand ?? false,
            'gallery' => $galleryFiles,
        ]);

        $service->save();

        return response()->json([
            'success' => true,
            'message' => 'Service has been created successfully',
            'data' => $service,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($services) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($service)
    {
        $service = Services::findOrFail($service);
        return response()->json($service);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $serviceID)
    {
        $service = Services::findOrFail($serviceID);

        $request->validate([
            'service_name' => 'required|string|max:255',
            'service_price' => 'required|numeric|min:0',
            'service_category' => 'nullable|string|max:100',
            'service_description' => 'nullable|string',
            'service_features' => 'nullable|string',
            'options' => 'nullable|array',
            'addons' => 'nullable|array',
            'days' => 'nullable|array',
            'on_demand' => 'nullable|boolean',
            'service_gallery.*' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
            'service_main_image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
        ]);

        // معالجة الصورة الرئيسية إذا تم رفعها
        if ($request->hasFile('service_main_image')) {
            $service->main_image = $request->file('service_main_image')->store('services', 'public');
        }

        if ($request->hasFile('service_gallery')) {
            $galleryFiles = [];
            foreach ($request->file('service_gallery') as $file) {
                $galleryFiles[] = $file->store('services', 'public');
            }

            $existingGallery = json_decode($service->features, true)['gallery'] ?? [];
            $service->features = json_encode(array_merge(json_decode($service->features, true) ?? [], ['gallery' => array_merge($existingGallery, $galleryFiles)]));
        }

        $service->name = $request->service_name ?? $service->name;
        $service->price = $request->service_price ?? $service->price;
        $service->type = $request->service_category ?? $service->type;
        $service->description = $request->service_description ?? $service->description;

        $featuresData = json_decode($service->features, true) ?? [];
        $featuresData['features'] = $request->service_features ?? ($featuresData['features'] ?? '');
        $featuresData['options'] = $request->options ?? ($featuresData['options'] ?? []);
        $featuresData['addons'] = $request->addons ?? ($featuresData['addons'] ?? []);
        $featuresData['days'] = $request->days ?? ($featuresData['days'] ?? []);
        $featuresData['on_demand'] = $request->on_demand ?? ($featuresData['on_demand'] ?? false);

        $service->features = json_encode($featuresData);

        $service->save();

        return response()->json([
            'success' => true,
            'message' => 'Service has been updated successfully',
            'data' => $service,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($serviceID)
    {
        $service = Services::findOrFail($serviceID);
        $service->delete();

        return response()->json('the service has been deleted Succesfully');
    }
}
