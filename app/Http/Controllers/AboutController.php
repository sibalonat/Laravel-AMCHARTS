<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Category;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $onestart = About::get();
        return view('admin.about.index', compact('onestart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(About $about)
    {
        //
        return view('admin.about.create', compact('about'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $about_data = [
            'en' => [
                'description' => $request->input('en_description')
            ],
            'al' => [
                'description' => $request->input('al_description')
            ],
            'fixed'=> $request->input('fixed'),
            'xvalue'=> $request->input('xvalue'),
            'yvalue'=> $request->input('yvalue'),
         ];


        $about = About::create($about_data);
        return redirect()->route('about.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
        return response()->json($about);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        //
        $en = $about->translations[1]->description;
        $al = $about->translations[0]->description;
        return view('admin.about.edit', compact('about', 'en', 'al'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {
        //
        $about->update([
            // 'description' => $request->input('description'),
            'en' => [
                'description' => $request->input('en_description')
            ],
            'al' => [
                'description' => $request->input('al_description')
            ],
            'fixed' => $request->input('fixed'),
            'xvalue' => $request->input('xvalue'),
            'yvalue' => $request->input('yvalue'),
        ]);
        return redirect()->route('about.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        //
        $about->delete();
        return redirect()->route('about.index');
    }
}
