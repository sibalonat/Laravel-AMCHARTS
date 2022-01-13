<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\About;
use App\Models\Category;


class HomeController extends Controller
{

    private $mediaCollection = 'photo';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $categories = Category::with('projects')->get();
        if (request()->ajax()) {
            return Category::all();
        }
        return view('home', compact('categories'));
    }


    public function forceDirected()
    {
        $abouts = About::all();
        // $categories = Category::all();
        $data = array();
        $dataFin = array();
        $categories = array();
        $projects = array();
        $aktivitete = array();
        foreach ($abouts as $key => $about) {
            $categories = $about->categories()->get();
            foreach ($categories as $key => $category) {
                $projektet = $category->projects()->get();
                foreach ($projektet as $child) {
                    $aktivitetet = $child->aktivitete()->get();
                    foreach ($aktivitetet as $key => $chil) {
                        $en = $chil->translations[1]->description;
                        $al = $chil->translations[0]->description;
                        $aktivitete[] = ['name' => $chil->name, 'id' => $chil->name, 'link' => $chil->projects()->pluck('name'), 'content_en' => $en, 'content_al' => $al, 'fixed' => $chil->fixed, 'x' => $chil->xvalue, 'y' => $chil->yvalue];
                        // $aktivitete[] = ['name' => $chil->name, 'id' => $chil->name, 'link' => $chil->projects()->pluck('name'), 'content_en' => $en, 'content_al' => $al, 'kuratori' => $chil->kuratori, 'vendi' => $chil->location, 'fixed' => $chil->fixed, 'x' => $chil->xvalue, 'y' => $chil->yvalue];
                    }
                    // cordinates
                    $cordinates = ['lat' => $child->lat, 'lon' => $child->lon];
                    // yearextract
                    $date = \Carbon\Carbon::parse($child->production_date)->format('Y');
                    // $date = $child->production_date->format('Y');
                    // $date = $child->select('production_date')->first();
                    // $year = Carbon::parse($date->production_date)->year;

                    $en = $child->translations[1]->description;
                    $al = $child->translations[0]->description;

                    $projects[] = ['name' => $child->name, 'id' => $child->name, 'zhvillohet' => $child->location, 'mediumi' => $child->mediumi, 'pershkrimi' => $child->shortdescription, 'autori' => $child->authorname, 'content_en' => $en,  'content_al' => $al,'fixed' => $child->fixed, 'x' => $child->xvalue, 'y' => $child->yvalue, 'photos' => $child->getMedia($this->mediaCollection)->pluck('original_url'), 'viti' => $date, 'featured' => $child->getFirstMediaUrl('featured', 'thumb'), 'cordinates' => $cordinates,  'children' => $aktivitete];
                    $aktivitete = array();
                }
                $en = $category->translations[1]->description;
                $al = $category->translations[0]->description;

                $data[] = ['name' => $category->name, 'id' => $category->name,  'fixed' => $category->fixed, 'x' => $category->xvalue, 'y' => $category->yvalue, 'children' => $projects, 'content_en' => $en, 'content_al' => $al];
                $projects = array();
            }
            $en = $about->translations[1]->description;
            $al = $about->translations[0]->description;
            $dataFin[] = ['name' => $about->name, 'id' => $about->name, 'content_en' => $en, 'content_al' => $al, 'fixed' => $about->fixed, 'x' => $about->xvalue, 'y' => $about->yvalue, 'children' => $data];
            $data = array();
        }

        return response()->json($dataFin);
    }
}
