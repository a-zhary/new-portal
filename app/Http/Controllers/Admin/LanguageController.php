<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLanguageStoreRequest;
use App\Http\Requests\AdminLanguageUpdateRequest;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();
        return view('admin.languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = config('languages');
        return view('admin.languages.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminLanguageStoreRequest $request)
    {
        Language::create($request->all());
        toast(__('Created Successfully'),'success');
        return redirect()->route('admin.languages.index');
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
    public function edit(Language $language)
    {
        $languages = config('languages');
        return view('admin.languages.edit', compact('languages', 'language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminLanguageUpdateRequest $request, string $id)
    {
        $language = Language::findOrFail($id);
        $language->update($request->all());
        toast(__('Updated Successfully'),'success');
        return redirect()->route('admin.languages.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $language = Language::findOrFail($id);
            if ($language->lang === 'en') {
                return response(['status' => 'error', 'message' => __('Can\'t Delete default language!')]);
            }
            $language->delete();
            toast(__('Deleted Successfully'),'success');
            return response(['status' => 'success', 'message' => __('Deleted Successfully!')]);
        } catch (\Throwable $th) {
            return response(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
