<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Providers;
use App\Models\ProvidersJobs;

class Workplace extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = ProvidersJobs::where("user_id",Auth::id())->get();
        $providers = Providers::where("owner_id",Auth::id())->get();
        return view('user.dashboard.workplace.index',compact("jobs","providers"));
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
        //
    }
}
