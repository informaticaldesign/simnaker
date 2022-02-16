<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\Models\Roles;

class PerusahaanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    }
}
