<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Policy;
use Illuminate\Http\Request;

class PoliciesController extends Controller
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
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $policies = Policy::where('policy', 'LIKE', "%$keyword%")
                ->orWhere('section_id', 'LIKE', "%$keyword%")
                ->orWhere('role1', 'LIKE', "%$keyword%")
                ->orWhere('role2', 'LIKE', "%$keyword%")
                ->orWhere('role3', 'LIKE', "%$keyword%")
                ->orWhere('role4', 'LIKE', "%$keyword%")
                ->orWhere('role5', 'LIKE', "%$keyword%")
                ->orWhere('role6', 'LIKE', "%$keyword%")
                ->orWhere('role7', 'LIKE', "%$keyword%")
                ->orWhere('role8', 'LIKE', "%$keyword%")
                ->orWhere('role9', 'LIKE', "%$keyword%")
                ->orWhere('role10', 'LIKE', "%$keyword%")
                ->orWhere('role11', 'LIKE', "%$keyword%")
                ->orWhere('role12', 'LIKE', "%$keyword%")
                ->orWhere('role13', 'LIKE', "%$keyword%")
                ->orWhere('role14', 'LIKE', "%$keyword%")
                ->orWhere('role15', 'LIKE', "%$keyword%")
                ->orWhere('role16', 'LIKE', "%$keyword%")
                ->orWhere('role17', 'LIKE', "%$keyword%")
                ->orWhere('role18', 'LIKE', "%$keyword%")
                ->orWhere('role19', 'LIKE', "%$keyword%")
                ->orWhere('role20', 'LIKE', "%$keyword%")
                ->orWhere('role21', 'LIKE', "%$keyword%")
                ->orWhere('role22', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $policies = Policy::paginate($perPage);
        }

        return view('admin.policies.index', compact('policies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.policies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'policy' => 'required',
			'section_id' => 'required'
		]);
        $requestData = $request->all();
        
        Policy::create($requestData);

        return redirect('admin/policies')->with('flash_message', 'Policy added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $policy = Policy::findOrFail($id);

        return view('admin.policies.show', compact('policy'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $policy = Policy::findOrFail($id);

        return view('admin.policies.edit', compact('policy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'policy' => 'required',
			'section_id' => 'required'
		]);
        $requestData = $request->all();
        
        $policy = Policy::findOrFail($id);
        $policy->update($requestData);

        return redirect('admin/policies')->with('flash_message', 'Policy updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Policy::destroy($id);

        return redirect('admin/policies')->with('flash_message', 'Policy deleted!');
    }
}
