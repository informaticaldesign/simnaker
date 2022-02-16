<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roles;
use DataTables;
use Form;
use Illuminate\Http\Response;
use App\Models\Modules;
use DB;

class RolesController extends Controller {

    public $listing_cols = ['id', 'name', 'label', 'description'];

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return View('roles.index');
    }

    public function create(Request $request) {
        return View('roles.create');
    }

    public function fetch(Request $request) {
        if ($request->ajax()) {
            $data = Roles::select($this->listing_cols);
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($row) {
                                $btn = '<a href="' . url('roles/show/' . $row->id) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="action-view btn btn-primary btn-sm"><i class="fas fa-folder"></i> View</a> ';
                                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="action-edit btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a> ';
                                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="action-delete btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>';
                                return $btn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }
    }

    public function destroy($id) {
        Roles::find($id)->delete();
        return response()->json(['success' => true]);
    }

    public function edit($id) {
        $Roles = Roles::find($id);
        return response()->json($Roles);
    }

    public function update(Request $request) {
        Roles::find($request->role_id)->update([
            'name' => $request->name,
            'label' => $request->label,
            'description' => $request->description
                ], ['id' => $request->role_id]);
        return response()->json([
                    'success' => true,
                    'message' => 'Update module success'
        ]);
    }

    public function store(Request $request, Roles $modules) {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles', 'alpha_dash'],
            'label' => ['required', 'string', 'max:255'],
            'description' => ['max:1000'],
        ]);
        $dataId = $modules->storeData($request->all());
        if ($dataId) {
            return redirect()->route('roles.show', ['id' => $dataId->id]);
        }
    }

    public function show($id, Request $request) {
        $dataRole = Roles::find($id);
        $modules_access = Modules::getRoleAccess($id);
        return view('roles.detail', [
            'role' => $dataRole,
            'modules_access' => $modules_access,
            'request' => $request
        ]);
    }

    public function save(Request $request, $id) {
        $now = date("Y-m-d H:i:s");
        $modules_access = Modules::getRoleAccess($id);
        foreach ($modules_access as $module) {
            $module_name = 'module_' . $module->id;
            if (isset($request->$module_name)) {
                $view = 'module_view_' . $module->id;
                $create = 'module_create_' . $module->id;
                $edit = 'module_edit_' . $module->id;
                $delete = 'module_delete_' . $module->id;
                if (isset($request->$view)) {
                    $view = 1;
                } else {
                    $view = 0;
                }
                if (isset($request->$create)) {
                    $create = 1;
                } else {
                    $create = 0;
                }
                if (isset($request->$edit)) {
                    $edit = 1;
                } else {
                    $edit = 0;
                }
                if (isset($request->$delete)) {
                    $delete = 1;
                } else {
                    $delete = 0;
                }

                $query = DB::table('role_module')->where('role_id', $id)->where('module_id', $module->id);
                if ($query->count() == 0) {
                    DB::insert('insert into role_module (role_id, module_id, acc_view, acc_create, acc_edit, acc_delete, created_at, updated_at) values (?, ?, ?, ?, ?, ?, ?, ?)', [$id, $module->id, $view, $create, $edit, $delete, $now, $now]);
                } else {
                    DB:: table('role_module')->where('role_id', $id)->where('module_id', $module->id)->update(['acc_view' => $view, 'acc_create' => $create, 'acc_edit' => $edit, 'acc_delete' => $delete]);
                }
            } else {
                DB:: table('role_module')->where('role_id', $id)->where('module_id', $module->id)->update(['acc_view' => 0, 'acc_create' => 0, 'acc_edit' => 0, 'acc_delete' => 0]);
            }
        }
        return redirect()->route('roles.show', ['id' => 1, 'role' => 'module'])->with('message', 'Role update Successfully');
    }
}
