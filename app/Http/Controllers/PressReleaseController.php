<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PR;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PressReleaseController extends Controller
{
    /**
     * Menampilkan semua data PR dalam bentuk view.
     */
    public function index()
    {
        $prs = PR::all();
        return view('pages.dashboard.admin.PR.index', compact('prs'));
    }

    /**
     * Menampilkan halaman form untuk membuat PR baru.
     */
    public function create()
    {
        $companies = DB::table('tb_company')->select('id', 'company')->get();
        return view('pages.dashboard.admin.PR.create', compact('companies'));
    }

    /**
     * Menyimpan data PR baru.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_company' => 'required|exists:tb_company,id',
            'title' => 'nullable|string|max:255',
            'URL' => 'nullable|url|max:255',
            'author' => 'nullable|string|max:255',
            'status' => 'in:On Progress,Completed,Pending,Canceled',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        PR::create($request->all());

        return redirect()->route('admin.pr.get')->with('success', 'PR successfully added!');
    }

    public function edit($id)
    {
        $pr = PR::find($id);
        if (!$pr) {
            return redirect()->route('admin.pr.get')->with('error', 'PR not found!');
        }

        $companies = DB::table('tb_company')->select('id', 'company')->get();
        
        return view('pages.dashboard.admin.PR.edit', compact('pr', 'companies'));
    }


    public function update(Request $request, $id)
    {
        $pr = PR::find($id);

        if (!$pr) {
            return redirect()->route('admin.pr.get')->with('error', 'PR not found!');
        }

        $validator = Validator::make($request->all(), [
            'id_company' => 'required|exists:tb_company,id',
            'title' => 'nullable|string|max:255',
            'URL' => 'nullable|url|max:255',
            'author' => 'nullable|string|max:255',
            'status' => 'in:On Progress,Completed,Pending,Canceled',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $pr->update($request->all());

        return redirect()->route('admin.pr.get')->with('success', 'PR updated successfully!');
    }


    /**
     * Menampilkan detail satu data PR berdasarkan ID.
     */
    public function show($id)
    {
        $pr = PR::find($id);

        if (!$pr) {
            return redirect()->route('admin.pr.get')->with('error', 'PR data not found!');
        }

        return view('pages.dashboard.admin.PR.show', compact('pr'));
    }

    /**
     * Menghapus data PR.
     */
    public function delete($id)
    {
        $pr = PR::find($id);

        if (!$pr) {
            return redirect()->route('admin.pr.get')->with('error', 'PR not found!');
        }

        $pr->delete();

        return redirect()->route('admin.pr.get')->with('success', 'PR deleted successfully!');
    }
}
