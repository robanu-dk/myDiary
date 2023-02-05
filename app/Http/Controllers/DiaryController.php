<?php

namespace App\Http\Controllers;

use App\Models\Diary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.home',[
            'title'=>'HOME',
            'diaries'=> Diary::all()->where('id_user',Auth::user()->id),
        ]);
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
        // Change timezone
        date_default_timezone_set("Asia/Jakarta");

        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        // add id_user
        $validatedData['id_user'] = Auth::user()->id;

        Diary::create($validatedData);

        return redirect('/')->with('success','Diary Saved!!');
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
        // Set timezone
        date_default_timezone_set("Asia/Jakarta");

        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $validatedData['id_user'] = Auth::user()->id;

        Diary::where('id',$id)->update($validatedData);

        return redirect('/')->with('success','Diary has been Update!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Diary::destroy($id);

        return redirect('/')->with('success','Diary has been deleted');
    }
}
