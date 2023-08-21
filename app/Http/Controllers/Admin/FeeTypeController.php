<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\FeeType;
use Illuminate\Http\Request;
use Validator;
use Redirect;
class FeeTypeController extends Controller
{
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
            $FeeType = FeeType::where('title', 'ilike', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $FeeType = FeeType::latest()->paginate($perPage);
        }

        return view('admin.FeeType.index', compact('FeeType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.FeeType.create');
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
        
        $requestData = $request->all();
        $validator = Validator::make($request->all(), [
            'title' => 'required',
           
        ]);
 
        if ($validator->fails()) {
            // return redirect('admin/FeeType/create')->withErrors($validator)->withInput();
            return Redirect::back()->withErrors($validator);
        }
        
        FeeType::create($requestData);
   

        return redirect('admin/feetype')->with('flash_message', 'FeeType added!');
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
        $FeeType = FeeType::findOrFail($id);

        return view('admin.FeeType.show', compact('FeeType'));
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

        $FeeType = FeeType::findOrFail($id);

        return view('admin.FeeType.edit', compact('FeeType'));
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
        
        $requestData = $request->all();
        
        $FeeType = FeeType::findOrFail($id);
        $FeeType->update($requestData);

        return redirect('admin/feetype')->with('flash_message', 'FeeType updated!');
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
        FeeType::destroy($id);

        return redirect('admin/feetype')->with('flash_message', 'FeeType deleted!');
    }
}
