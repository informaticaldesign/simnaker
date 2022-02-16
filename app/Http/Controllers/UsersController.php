<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersController extends Controller {

    public $show_action = false;
    public $view_col = 'name';
    public $listing_cols = ['id', 'name', 'email'];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    //
    public function index() {
        $roles = \App\Models\Roles::pluck('name', 'id');
        return View('users.index', [
            'show_actions' => $this->show_action,
            'listing_cols' => $this->listing_cols,
            'roles' => $roles
        ]);
    }

    public function fetch(Request $request) {
        if ($request->ajax()) {
            $data = User::select(['users.id', 'users.name', 'users.email', 'roles.name AS role_name'])
                    ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
                    ->whereNull('deleted_at');
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($row) {
                                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="action-view btn btn-primary btn-sm"><i class="fas fa-folder"></i> View</a> ';
                                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="action-edit btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a> ';
                                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="action-delete btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>';
                                return $btn;
                            })
                            ->filter(function ($instance) use ($request) {
                                if (!empty($request->get('search'))) {
                                    $instance->where(function($w) use($request) {
                                        $search = $request->get('search');
                                        $w->orWhere('users.name', 'LIKE', "%" . Str::lower($search['value']) . "%")
                                        ->orWhere('users.email', 'LIKE', "%" . Str::lower($search['value']) . "%")
                                        ->orWhere('roles.name', 'LIKE', "%" . Str::lower($search['value']) . "%");
                                    });
                                }
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }
    }

    public function destroy($id) {
        User::find($id)->delete();
        return response()->json(['success' => true]);
    }

    public function edit($id) {
        $Users = User::find($id);
        return response()->json($Users);
    }

    public function update(Request $request) {
        User::where('id', $request->user_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id
        ]);
        return response()->json([
                    'success' => true,
                    'message' => 'Update user success'
        ]);
    }

    public function store(Request $request, User $user) {
        $validator = \Validator::make($request->all(), [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                    'role_id' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                        'success' => false,
                        'message' => $validator->errors()->toArray()
                            ], 422);
        }
        $data = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role_id' => $request->role_id,
                    'company_id' => null
        ]);
        if ($data->id) {
            return response()->json([
                        'success' => true,
                        'message' => 'Add user success'
            ]);
        } else {
            return response()->json([
                        'success' => false,
                        'message' => 'Add user failure'
            ]);
        }
    }

}
