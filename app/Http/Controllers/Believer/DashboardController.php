<?php

namespace App\Http\Controllers\Believer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return "this is the dashboard view for a BELIEVER - test";
    }
}
