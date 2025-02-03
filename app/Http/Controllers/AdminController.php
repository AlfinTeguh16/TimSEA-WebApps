<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\PR;
use App\Models\Project;

class AdminController extends Controller
{
    public function index()
    {
        $prs = PR::all();
        $projects = Project::all(); // Pastikan model Project ada

        $totalProjects = count($prs) + count($projects);

        $onProgressProjects = collect($prs)->where('status', 'On Progress')->count() + 
                          collect($projects)->where('status', 'On Progress')->count();

        $completedProjects = collect($prs)->where('status', 'Completed')->count() + 
                            collect($projects)->where('status', 'Completed')->count();

    return view('pages.dashboard.admin.dashboard', compact('prs', 'projects', 'totalProjects', 'onProgressProjects', 'completedProjects'));
    }


    
}
