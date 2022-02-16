<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modules;
use DataTables;
use Form;
use Illuminate\Http\Response;

class ModulesController extends Controller {

    public $listing_cols = ['id', 'name', 'label', 'fa_icon', 'url'];

    //
    public function __construct() {
        $this->middleware('auth');
    }

    //
    public function index() {
        return View('modules.index');
    }

    public function fetch(Request $request) {
        if ($request->ajax()) {
            $data = Modules::select($this->listing_cols)->whereNull('deleted_at');
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($row) {
                                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="action-view btn btn-primary btn-sm"><i class="fas fa-folder"></i> View</a> ';
                                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="action-edit btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a> ';
                                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="action-delete btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>';
                                return $btn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }
    }

    public function destroy($id) {
        Modules::find($id)->delete();
        return response()->json(['success' => true]);
    }

    public function edit($id) {
        $Modules = Modules::find($id);
        return response()->json($Modules);
    }

    public function update(Request $request) {
        Modules::find($request->module_id)->update([
            'name' => $request->name,
            'label' => $request->label,
            'url' => $request->url,
            'fa_icon' => $request->fa_icon
                ], ['id' => $request->module_id]);
        return response()->json([
                    'success' => true,
                    'message' => 'Update module success'
        ]);
    }

    public function store(Request $request, Modules $modules) {
        $validator = \Validator::make($request->all(), [
                    'name' => ['required', 'string', 'max:255', 'unique:modules'],
                    'label' => ['required', 'string', 'max:255'],
                    'fa_icon' => ['required', 'string'],
                    'url' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                        'success' => false,
                        'message' => $validator->errors()->toArray()
                            ], 422);
        }
        $modules->storeData($request->all());
        return response()->json([
                    'success' => true,
                    'message' => 'Add module success'
        ]);
    }

}
