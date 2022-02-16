<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTemplatesRequest;
use App\Http\Requests\UpdateTemplatesRequest;
use App\Models\Templates;
use Illuminate\Http\Request;

class TemplatesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        return View('templates.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        //
        if ($request->all()) {
            $validator = \Validator::make($request->all(), [
                        'name' => ['required', 'string', 'max:255'],
                        'content' => ['required', 'string'],
            ]);

            if ($validator->fails()) {
                return response()->json([
                            'success' => false,
                            'message' => $validator->errors()->toArray()
                                ], 422);
            }
        }
        return View('templates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTemplatesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTemplatesRequest $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Templates  $templates
     * @return \Illuminate\Http\Response
     */
    public function show(Templates $templates) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Templates  $templates
     * @return \Illuminate\Http\Response
     */
    public function edit(Templates $templates) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTemplatesRequest  $request
     * @param  \App\Models\Templates  $templates
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTemplatesRequest $request, Templates $templates) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Templates  $templates
     * @return \Illuminate\Http\Response
     */
    public function destroy(Templates $templates) {
        //
    }

}
