<?php

namespace App\Http\Controllers;

use App\Models\Branches;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BranchesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $branches = Branches::where('provider_id', $id)->get();

        return response()->json($branches);
    }

    public function indexGet($id)
    {
        $branches = Branches::where('provider_id', $id)->get();

        return response()->json($branches);
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
        //return response()->json(['message' => 'Branch created successfully'], 201);
        $servicesArray = $request->input('services', '');
        // $servicesArray = array_filter(explode(',', $servicesString));
        // foreach ($servicesArray as $service) {
        //     if (mb_strlen($service) > 100) {
        //         return back()->withErrors(['services' => 'Service name too long.']);
        //     }
        // }
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255' ,
            'moderator_name' => 'nullable|string|max:255',
            // 'services' => 'nullable|array',
            // 'services.*' => 'string|max:100',
            'status' => 'required|in:active,inactive',

        ]);
        $branch = new Branches();
        $branch->name = $request->name;
        $branch->address = $request->address;
        $branch->phone = $request->phone;
        $branch->email = $request->email;
        $branch->provider_id = auth()->user()->providers()->first()->id;   
        $branch->moderator_name = $request->moderator_name;
        $branch->services = $servicesArray;
        $branch->status = 'active';
        $branch->meta = [
            'created_by' => auth()->user()->id,
        ];
        $branch->save();


        return response()->json(['message' => 'Branch created successfully', 'branch' => $branch], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $branches = Branches::where('provider_id', $id)->get();

        return response()->json($branches);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $branchEditor = Branches::findOrFail($id);

        return response()->json($branchEditor);
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id)
{
    $validated = $request->validate([
        'name'           => 'required|string|max:255',
        'address'        => 'required|string|max:500',
        'phone'          => 'nullable|string|max:20',
        'email'          => 'nullable|email|max:255',
        'moderator_name' => 'nullable|string|max:255',
        'status'         => 'required|in:active,inactive',
        'services'       => 'nullable|array',
        'services.*'     => 'string|max:100',
    ]);

    $branch = Branches::findOrFail($id);

    // لو عندك خدمات (checkBoxes) حولها Array
    $servicesArray = $request->services ?? [];

    $branch->update([
        'name'           => $validated['name'],
        'address'        => $validated['address'],
        'phone'          => $validated['phone'],
        'email'          => $validated['email'],
        'moderator_name' => $validated['moderator_name'],
        'status'         => $validated['status'], // مش شرط نخليها ثابتة active
        'services'       => $servicesArray,
        'provider_id'    => auth()->user()->providers()->first()->id,
        'meta'           => [
            'updated_by' => auth()->id(),
        ],
    ]);

    return response()->json([
        'success' => true,
        'message' => 'تم تحديث بيانات الفرع بنجاح',
        'data'    => $branch
    ]);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $branch = Branches::findOrFail($id);
        $branch->delete();
    
    }
}
