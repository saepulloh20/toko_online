<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class DashboardValidationController extends Controller

{
    public function index()
    {
        return view('pages.admin.validation.index');
    }
}
