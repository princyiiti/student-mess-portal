<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\StudnetCurrentSubcription;

class SubcriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 10;

        if(!empty($keyword))
        {
            $StudnetCurrentSubcription = StudnetCurrentSubcription::where('student_name', 'LIKE', "%$keyword%")
            ->orwhere('student_email','LIKE', "%$keyword%")->latest()->paginate($perPage);   
        }else{
            $StudnetCurrentSubcription = StudnetCurrentSubcription::latest()->paginate($perPage);   

        }
         

        return view('admin.StudnetCurrentSubcription.index', compact('StudnetCurrentSubcription'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        StudnetCurrentSubcription::destroy($id);

        return redirect('admin/subcription')->with('flash_message', 'subcription deleted!');
    }
}
