<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Classroom;
use App\Http\Requests\CreateClassRequest;
use App\Http\Requests\UpdateClassRequest;
use Illuminate\Http\Request;



class ClassController extends Controller {

	/**
	 * Display a listing of class
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        $class = Classroom::all();

		return view('admin.class.index', compact('class'));
	}

	/**
	 * Show the form for creating a new class
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.class.create');
	}

	/**
	 * Store a newly created class in storage.
	 *
     * @param CreateClassRequest|Request $request
	 */
	public function store(CreateClassRequest $request)
	{
	    
		Classroom::create($request->all());

		return redirect()->route(config('quickadmin.route').'.class.index');
	}

	/**
	 * Show the form for editing the specified class.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$class = Classroom::find($id);
	    
	    
		return view('admin.class.edit', compact('class'));
	}

	/**
	 * Update the specified class in storage.
     * @param UpdateClassRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateClassRequest $request)
	{
		$class = Classroom::findOrFail($id);

        

		$class->update($request->all());

		return redirect()->route(config('quickadmin.route').'.class.index');
	}

	/**
	 * Remove the specified class from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Classroom::destroy($id);

		return redirect()->route(config('quickadmin.route').'.class.index');
	}

    /**
     * Mass delete function from index page
     * @param Request $request
     *
     * @return mixed
     */
    public function massDelete(Request $request)
    {
        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
            Classroom::destroy($toDelete);
        } else {
            Classroom::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.class.index');
    }

}
