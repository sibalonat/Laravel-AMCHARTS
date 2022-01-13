<?php

namespace App\Http\Controllers;

use App\Models\Aktivitete;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    private $mediaCollection = 'photo';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::query()->orderBy('id', 'DESC')->paginate(5);
        // dd($projects);
        return view('admin.projects.index', [
            'projects' => $projects,
            'mediaCollection' => $this->mediaCollection
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        $category = Category::get();
        $aktivitete = Aktivitete::query()->get();
        // dd($aktivitete);
        // dd($category);
        return view('admin.projects.create', compact('category', 'project', 'aktivitete'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project_data = [
            'name'=> $request->input('name'),
            'category_id'=> $request->input('category_id'),
            'authorname'=> $request->input('authorname'),
            'mediumi'=> $request->input('mediumi'),
            'shortdescription'=> $request->input('shortdescription'),
            'location'=> $request->input('location'),
            'production_date'=> $request->input('production_date'),
            'fixed'=> $request->input('fixed'),
            'xvalue'=> $request->input('xvalue'),
            'yvalue'=> $request->input('yvalue'),
            'lat'=> $request->input('lat'),
            'lon'=> $request->input('lon'),
            'en' => [
                'description' => $request->input('en_description')
            ],
            'al' => [
                'description' => $request->input('al_description')
            ],
         ];

        $project = Project::create($project_data);

        $project->aktivitete()->sync($request->input('aktivitete'));

        if($request->hasFile('featured') && $request->file('featured')->isValid()){
            $project->addMediaFromRequest('featured')->toMediaCollection('featured');
        }

        foreach ($request->input('photo', []) as $file) {
            $project->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
        }

        // dd($project->aktivitete);

        return redirect()->route('project.index')->with('status', 'category added successfully');
    }


    public function storeMedia(Request $request)
    {
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        dd(\Carbon\Carbon::parse($project->production_date)->format('Y'));
        dd($project->production_date);
        // dd(\Carbon\Carbon::parse($project->production_date)->format('d/m/Y'));
        // dd($project->production_date);
        // $project->getFirstMediaUrl('featured', 'thumb')
        return response()->json($project->getFirstMediaUrl('featured', 'thumb'));
        return response()->json($project->getFirstMediaPath('featured', 'thumb'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $en = $project->translations[1]->description;
        $al = $project->translations[0]->description;
        $category = Category::get();

        $dateOfPr = \Carbon\Carbon::parse($project->production_date)->format('d/m/Y');


        $thumba = $project->getFirstMediaUrl('featured', 'thumb');
        $aktivitete = Aktivitete::get();
        // dd($project);
        return view('admin.projects.edit', [
            'project' => $project,
            'category' => $category,
            'photos' => $project->getMedia($this->mediaCollection),
            'en' => $en,
            'al' => $al,
            'thumba' => $thumba,
            'aktivitete' => $aktivitete,
            'dateOfPr' => $dateOfPr
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $project = Project::with('photos')->where('id', $project->id)->first();
        $project->update([
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'authorname' => $request->input('authorname'),
            'mediumi' => $request->input('mediumi'),
            // 'description' => $request->input('description'),
            'shortdescription' => $request->input('shortdescription'),
            'production_date' => $request->input('production_date'),
            'lat' => $request->input('lat'),
            'lon' => $request->input('lon'),
            'location' => $request->input('location'),
            'fixed' => $request->input('fixed'),
            'xvalue' => $request->input('xvalue'),
            'yvalue' => $request->input('yvalue'),
            'en' => [
                'description' => $request->input('en_description')
            ],
            'al' => [
                'description' => $request->input('al_description')
            ],
        ]);
        $project->aktivitete()->sync($request->input('aktivitete'));

        if($request->hasFile('featured') && $request->file('featured')->isValid()){
            $project->addMediaFromRequest('featured')->toMediaCollection('featured');
        }

        if (count($project->photos) > 0) {
            foreach ($project->photos as $media) {
                if (!in_array($media->file_name, $request->input('photo', []))) {
                    $media->delete();
                }
            }
        }

        $media = $project->photos->pluck('file_name')->toArray();

        foreach ($request->input('photo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $project->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
            }
        }
        return redirect()->route('project.index')->with('status', 'project added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('project.index');
    }
}
