<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SuperTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = DB::table('tb_project')
            ->leftJoin('tb_team', 'tb_project.id', '=', 'tb_team.id_projects')
            ->leftJoin('tb_talent', 'tb_team.id_talent', '=', 'tb_talent.id')
            ->leftJoin('tb_users as talents', 'tb_talent.id_users', '=', 'talents.id') // Untuk talent
            ->leftJoin('tb_users as pm', 'tb_project.id', '=', DB::raw('(SELECT id_project FROM tb_task WHERE tb_task.id_project = tb_project.id LIMIT 1)')) // Ambil PM dari tb_task
            ->select(
                'tb_project.id',
                'tb_project.project_name',
                'tb_project.description',
                'tb_project.status',
                DB::raw('GROUP_CONCAT(DISTINCT talents.profile_picture SEPARATOR ", ") as talents_pictures'), // Gabungkan foto talent
                'pm.profile_picture as project_manager_picture' // Ambil foto PM jika ada
            )
            ->groupBy('tb_project.id', 'tb_project.project_name', 'tb_project.description', 'tb_project.status', 'pm.profile_picture')
            ->get();

        return view('pages.dashboard.admin.super-team.index', compact('projects'));
    }

    public function searchProjects(Request $request)
    {
        $query = $request->input('q');

        $projects = DB::table('tb_project')
            ->leftJoin('tb_team', 'tb_project.id', '=', 'tb_team.id_projects')
            ->leftJoin('tb_talent', 'tb_team.id_talent', '=', 'tb_talent.id')
            ->leftJoin('tb_users as talents', 'tb_talent.id_users', '=', 'talents.id') 
            ->leftJoin('tb_users as pm', 'tb_project.id', '=', DB::raw('(SELECT id_project FROM tb_task WHERE tb_task.id_project = tb_project.id LIMIT 1)'))
            ->select(
                'tb_project.id',
                'tb_project.project_name',
                'tb_project.description',
                'tb_project.status',
                DB::raw('GROUP_CONCAT(DISTINCT talents.profile_picture SEPARATOR ", ") as talents_pictures'),
                'pm.profile_picture as project_manager_picture'
            )
            ->when($query, function ($q) use ($query) {
                return $q->where('tb_project.project_name', 'LIKE', "%{$query}%")
                        ->orWhere('tb_project.description', 'LIKE', "%{$query}%");
            })
            ->groupBy('tb_project.id', 'tb_project.project_name', 'tb_project.description', 'tb_project.status', 'pm.profile_picture')
            ->get();

        return response()->json(['data' => $projects]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companiesList = DB::table('tb_company')
            ->join('tb_users', 'tb_company.id_users', '=', 'tb_users.id') 
            ->where('tb_users.is_blocked', false) 
            ->where('tb_users.role', 'company')
            ->select('tb_company.id', 'tb_company.company')
            ->distinct()
            ->get();


        return view('pages.dashboard.admin.super-team.create', compact('companiesList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'company' => 'required|exists:tb_company,id',
                'project_name' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'field' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $project = Project::create([
                'id_company' => $request->input('company'),
                'project_name' => $request->input('project_name'),
                'category' => $request->input('category'),
                'description' => $request->input('field'),
            ]);

            return redirect()->route('admin.complete-project-super-team.get', ['id' => $project->id])
                ->with('success', 'Project created successfully!');
        } catch (\Exception $e) {
            \Log::error('Error storing project: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Something went wrong!')
                ->withInput();
        }
    }


    public function completeProject($id){
        
        $project = Project::findOrFail($id);

        return view('pages.dashboard.admin.super-team.complete-project-setup', compact('project'));
    }

   // SuperTeamController.php
   public function searchPM(Request $request)
   {
       $query = $request->input('q');
   
       $talentPM = User::join('tb_talent', 'tb_users.id', '=', 'tb_talent.id_users')
           ->select(
               'tb_talent.id as talent_id', // gunakan id dari tb_talent
               'tb_users.username',
               'tb_users.profile_picture',
               'tb_talent.token'
           )
           ->where('tb_talent.field', 'project_manager')
           ->whereNotIn('tb_users.role', ['admin', 'company'])
           ->when($query, function ($q) use ($query) {
               return $q->where('tb_users.username', 'LIKE', "%{$query}%");
           })
           ->paginate(6);
   
       return response()->json($talentPM);
   }
   
   public function searchTeam(Request $request)
   {
       $query = $request->input('q');
   
       $talents = User::join('tb_talent', 'tb_users.id', '=', 'tb_talent.id_users')
           ->select(
               'tb_talent.id as talent_id', // gunakan id dari tb_talent
               'tb_users.username',
               'tb_users.profile_picture',
               'tb_talent.field',
               'tb_talent.token'
           )
           ->whereNotIn('tb_users.role', ['admin', 'company'])
           ->whereNotIn('tb_talent.field', ['project_manager'])
           ->when($query, function ($q) use ($query) {
               return $q->where('tb_users.username', 'LIKE', "%{$query}%");
           })
           ->paginate(6);
   
       return response()->json($talents);
   }
   

    

   public function storeProjectTeam(Request $request)
    {
        $projectId = $request->input('project_id');
        $users = $request->input('users');

        if (!$projectId || empty($users)) {
            return response()->json(['message' => 'Invalid data received'], 400);
        }

        foreach ($users as $user) {
            if (!isset($user['user_id']) || !is_numeric($user['user_id'])) {
                return response()->json(['message' => 'Invalid user ID'], 400);
            }

            DB::table('tb_team')->insert([
                'id_projects' => $projectId,
                'id_talent'   => $user['user_id'],
                'created_at'  => now(),
                'updated_at'  => now()
            ]);
        }

        // Simpan session success
        session()->flash('success', 'Project team successfully saved!');

        return response()->json(['message' => 'Project team successfully saved!'], 200);
    }





    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
