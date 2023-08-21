<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Messlist;
use Illuminate\Http\Request;

class MesslistController extends Controller
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
            $messlists = Messlist::where('title', 'LIKE', "%$keyword%")
                ->get();//->paginate($perPage);
        } else {
            $messlists = Messlist::get()->sortByDesc("id");//->paginate($perPage);
        }
        return view('admin.messlist.index', compact('messlists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.messlist.create');
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
			'title' => 'required|unique:messlist',
            'studentlimit' => 'required|integer',
            'email' => 'required|email',
		]);
        $requestData = $request->all();
        
        Messlist::create($requestData);

        return redirect('admin/messlist')->with('flash_message', 'Messlist added!');
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
        $Messlist = Messlist::findOrFail($id);

        return view('admin.Messlists.show', compact('Messlist'));
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
        $messlist = Messlist::findOrFail($id);

        return view('admin.messlist.edit', compact('messlist'));
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
        
        $Messlist = Messlist::findOrFail($id);
        $Messlist->update($requestData);

        return redirect('admin/messlist')->with('flash_message', 'Messlist updated!');
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
        //Messlist::destroy($id);
        $messdata = Messlist::find($id);
        $messdata->delete();

        return redirect('admin/messlist')->with('flash_message', 'Messlist deleted!');
    }
}
