<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
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

        return view('pages.dashboard.admin.super-team.show', compact('project', 'tasks', 'doneTasks', 'completionRate', 'projectManager', 'teamMembers'));
        }


        public function addTask(Request $request, $id_project)
        {
            $request->validate([
                'task' => 'required|string|max:255',
                'deadline' => 'required|date'
            ]);

            // Simpan task ke database
            DB::table('tb_task')->insert([
                'task_title' => $request->input('task'),
                'id_project_manager' => Auth::id(), // Ambil ID user yang sedang login
                'id_project' => $id_project, // Ambil dari URL tanpa input hidden
                'deadline' => $request->input('deadline'),
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return redirect()->back()->with('success', 'Task successfully added!');
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