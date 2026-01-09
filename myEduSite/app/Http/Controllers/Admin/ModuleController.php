<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Teacher;
class ModuleController extends Controller
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
    $teachers = Teacher::all();
    $modules = Module::withCount('students')->get();

    return view('admin.modules.create', compact('teachers', 'modules'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Module::create([
            'name' => $request->name,
            'is_available' => true,
        ]);

        return back()->with('success', 'Module created');
    }

    public function archive(Module $module)
    {
        $module->update(['is_available' => false]);

        return back()->with('success', 'Module archived');
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
