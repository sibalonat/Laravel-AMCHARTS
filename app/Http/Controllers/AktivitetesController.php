<?php

namespace App\Http\Controllers;

use App\Models\Aktivitete;
use App\Models\Project;
use Illuminate\Http\Request;

class AktivitetesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $aktivitete = Aktivitete::query()->get();
        // dd($categories);
        return view('admin.aktivitete.index', compact('aktivitete'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Aktivitete $aktivitet)
    {
        $projektet = Project::query()->get();
        return view('admin.aktivitete.create', compact('projektet', 'aktivitet'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $aktivitet_data = [
        //     'name'=> $request->input('name'),
        //     'kuratori'=> $request->input('kuratori'),
        //     'location'=> $request->input('location'),
        //     'production_date'=> $request->input('production_date'),
        //     'fixed'=> $request->input('fixed'),
        //     'xvalue'=> $request->input('xvalue'),
        //     'yvalue'=> $request->input('yvalue'),
        //     'en' => [
        //         'description' => $request->input('en_description')
        //     ],
        //     'al' => [
        //         'description' => $request->input('al_description')
        //     ],
        //  ];

         $aktivitet_data = [
            'name'=> $request->input('name'),
            'kuratori'=> $request->input('kuratori'),
            'location'=> $request->input('location'),
            'production_date'=> $request->input('production_date'),
            'fixed'=> $request->input('fixed'),
            'xvalue'=> $request->input('xvalue'),
            'yvalue'=> $request->input('yvalue'),
            'en' => [
                'description' => $request->input('en_description')
            ],
            'al' => [
                'description' => $request->input('al_description')
            ],
         ];

        Aktivitete::create($aktivitet_data);
        // $aktivitet->projects()->sync($request->input('projects'));
        return redirect()->route('aktivitet.index')->with('status', 'category added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aktivitete  $aktivitete
     * @return \Illuminate\Http\Response
     */
    public function show(Aktivitete $aktivitete)
    {
        //
        return response()->json($aktivitete);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aktivitete  $aktivitete
     * @return \Illuminate\Http\Response
     */
    public function edit(Aktivitete $aktivitete)
    {
        //
        $en = $aktivitete->translations[1]->description;
        $al = $aktivitete->translations[0]->description;
        $projektet = Project::get();

        return view('admin.aktivitete.edit', compact('aktivitete', 'projektet', 'en', 'al'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aktivitete  $aktivitete
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aktivitete $aktivitete)
    {

        Aktivitete::where('id', $aktivitete->id)->update([
            'name' => $request->input('name'),
            'kuratori' => $request->input('kuratori'),
            'description' => $request->input('description'),
            'production_date' => $request->input('production_date'),
            'location' => $request->input('location'),
            'fixed' => $request->input('fixed'),
            'xvalue' => $request->input('xvalue'),
            'yvalue' => $request->input('yvalue'),
        ]);
        $aktivitete->projects()->sync($request->input('projects'));
        return redirect()->route('aktivitet.index')->with('status', 'category added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aktivitete  $aktivitete
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aktivitete $aktivitete)
    {
        $aktivitete->delete();
        return redirect()->route('aktivitet.index');
    }
}
