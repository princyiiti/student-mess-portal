<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Excel;
use App\Program;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $program = Program::all();
        //
        return view('admin.program.index',compact('program'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.program.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $requestData = $request->all();
        
        // Category::create($requestData);

        // return redirect('admin/category')->with('flash_message', 'category added!');

        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'program'       => 'required',
        );
        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('program/create')
                ->withErrors($validator);
        } else {
            // store
            $program = new Program;
            $program->program       = $request->get('program');
            $program->save();

            // redirect
            // Session::flash('message', 'Successfully created shark!');
            // return Redirect::to('sharks');
            return redirect('admin/program')->with('flash_message', 'program added!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          // delete
          $Program = Program::find($id);
          $Program->delete();
  
          // redirect
          return redirect('admin/Program')->with('flash_message', 'Delete Program Sucessfully!');
    }
}
