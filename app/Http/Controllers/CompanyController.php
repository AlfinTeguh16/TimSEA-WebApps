<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\PR;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{

    public function index()
    {
        $userId = auth()->id(); // Dapatkan ID user yang sedang login

        // Ambil hanya PR milik user yang sedang login
        $prs = PR::where('id_company', function($query) use ($userId) {
            $query->select('id')
                ->from('tb_company')
                ->where('id_users', $userId);
        })->get();

        // Ambil hanya Projects milik user yang sedang login
        $projects = Project::where('id_company', function($query) use ($userId) {
            $query->select('id')
                ->from('tb_company')
                ->where('id_users', $userId);
        })->get();

        // Hitung total semua PR dan Projects
        $totalProjects = count($prs) + count($projects);

        // Hitung total yang berstatus "On Progress"
        $onProgressProjects = collect($prs)->where('status', 'On Progress')->count() + 
                            collect($projects)->where('status', 'On Progress')->count();

        // Hitung total yang berstatus "Completed"
        $completedProjects = collect($prs)->where('status', 'Completed')->count() + 
                            collect($projects)->where('status', 'Completed')->count();

        return view('pages.dashboard.client.index', compact('prs', 'projects', 'totalProjects', 'onProgressProjects', 'completedProjects'));
    }

    public function show(string $id)
    {
        $project = Project::findOrFail($id);

        // Ambil semua task dari project tertentu
        $tasks = Task::where('id_project', $id)
            ->where('status', '!=', 'completed') // Ambil task yang belum selesai
            ->get();

        $doneTasks = Task::where('id_project', $id)
            ->where('status', 'completed') // Ambil task yang sudah selesai
            ->get();

        // Hitung persentase penyelesaian
        $totalTasks = $tasks->count() + $doneTasks->count();
        $completedTasks = $doneTasks->count();
        $completionRate = ($totalTasks > 0) ? round(($completedTasks / $totalTasks) * 100) : 0;


        // **Ambil talent yang merupakan Project Manager**
        $projectManager = User::join('tb_talent', 'tb_users.id', '=', 'tb_talent.id_users')
            ->join('tb_team', 'tb_talent.id', '=', 'tb_team.id_talent')
            ->where('tb_team.id_projects', $id)
            ->where('tb_talent.field', 'project_manager') // Hanya Project Manager
            ->select(
                'tb_users.id as user_id',
                'tb_users.username',
                'tb_users.profile_picture',
                'tb_talent.field'
            )
            ->first(); // Karena hanya ada satu PM

        // **Ambil talent yang bukan Project Manager**
        $teamMembers = User::join('tb_talent', 'tb_users.id', '=', 'tb_talent.id_users')
            ->join('tb_team', 'tb_talent.id', '=', 'tb_team.id_talent')
            ->where('tb_team.id_projects', $id)
            ->where('tb_talent.field', '!=', 'project_manager') // Hanya Team Members biasa
            ->select(
                'tb_users.id as user_id',
                'tb_users.username',
                'tb_users.profile_picture',
                'tb_talent.field'
            )
            ->get();

        return view('pages.dashboard.client.super-team.show', compact('project', 'tasks', 'doneTasks', 'completionRate', 'projectManager', 'teamMembers'));
        }

}
