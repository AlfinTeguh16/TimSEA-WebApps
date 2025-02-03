<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Task;
use App\Models\Project;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
class TalentController extends Controller
{
    public function index()
    {
        $userId = auth()->id(); // Dapatkan ID user yang sedang login

        // Ambil hanya Projects yang diikuti oleh user yang sedang login dari tb_team
        $teams = DB::table('tb_team')
            ->join('tb_project', 'tb_team.id_projects', '=', 'tb_project.id')
            ->join('tb_talent', 'tb_team.id_talent', '=', 'tb_talent.id')
            ->join('tb_users', 'tb_talent.id_users', '=', 'tb_users.id') // Ambil data user dari talent
            ->leftJoin('tb_task', 'tb_project.id', '=', 'tb_task.id_project') // Ambil project manager dari task
            ->leftJoin('tb_users as pm', 'tb_task.id_project_manager', '=', 'pm.id') // Ambil profile picture PM
            ->where('tb_team.id_talent', function ($query) use ($userId) {
                $query->select('id')
                    ->from('tb_talent')
                    ->where('id_users', $userId);
            })
            ->select(
                'tb_project.id',
                'tb_project.project_name',
                'tb_project.description',
                'tb_project.category',
                'tb_project.status',
                'tb_project.created_at',
                'tb_project.updated_at',
                DB::raw('GROUP_CONCAT(DISTINCT tb_users.profile_picture ORDER BY tb_users.id SEPARATOR ",") as talents_pictures'),
                'pm.profile_picture as project_manager_picture'
            )
            ->groupBy(
                'tb_project.id',
                'tb_project.project_name',
                'tb_project.description',
                'tb_project.category',
                'tb_project.status',
                'tb_project.created_at',
                'tb_project.updated_at',
                'pm.profile_picture'
            )
            ->get();

        // Hitung total project yang diikuti oleh user
        $totalProjects = count($teams);

        // Hitung total yang berstatus "On Progress"
        $onProgressProjects = collect($teams)->where('status', 'On Progress')->count();

        // Hitung total yang berstatus "Complete"
        $completedProjects = collect($teams)->where('status', 'Complete')->count();

        return view('pages.dashboard.talent.index', compact('teams', 'totalProjects', 'onProgressProjects', 'completedProjects'));
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

        return view('pages.dashboard.talent.project.show', compact('project', 'tasks', 'doneTasks', 'completionRate', 'projectManager', 'teamMembers'));
        }


        public function updateStatus(Request $request, $id)
        {
            $task = Task::findOrFail($id);

            // Validasi input status
            $request->validate([
                'status' => 'required|in:completed,in progress,unfinish'
            ]);

            // Update status task
            $task->update(['status' => $request->input('status')]);

            // Hitung ulang persentase setelah update sukses
            $totalTasks = Task::where('id_project', $task->id_project)->count();
            $completedTasks = Task::where('id_project', $task->id_project)->where('status', 'completed')->count();
            $completionRate = ($totalTasks > 0) ? round(($completedTasks / $totalTasks) * 100) : 0;

            return response()->json([
                'success' => true,
                'message' => 'Task status updated successfully',
                'completionRate' => $completionRate ?? 0 // Pastikan tidak mengembalikan null
            ]);
        }
}
