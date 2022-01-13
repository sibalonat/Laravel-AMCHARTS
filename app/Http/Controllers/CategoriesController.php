<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    public function index()
    {


        $categories = Category::query()->get();
        // $categories = Category::translatedIn('al')->get();
        // $categories = Category::listsTranslations('description')->get()->toArray();
        // $categories = Category::query()->translatedIn(app()->getLocale())->get();

        // return response()->json($categories);

        return view('admin.categories.index', compact('categories'));
    }


    public function create(Category $category)
    {
        $about = About::get();
        return view('admin.categories.create', compact('category', 'about'));
    }



    public function store(Request $request)
    {
        $category_data = [
            'name'=> $request->input('name'),
            'about_id'=> $request->input('about_id'),
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

        //  dd($category_data);

        $category = Category::create($category_data);

        // return response()->json($category);
        return redirect()->route('category.index');

    }


    public function show(Category $category)
    {
        // foreach ($category->translations as $key => $trs) {
        //     # code...
        //      dd($trs->description);
        // }
        // $cat = $category->translations;
        // $cat = $category->listsTranslations('description')->get()->toArray();
        $cat = $category->listsTranslations('description')->get();
        // foreach ($cat as $key => $ct) {
        //     return $ct[$key];
        //     # code...
        // }
        dd($cat);

        return response()->json($category->translations);
    }


    public function edit(Category $category)
    {
        $about = About::get();
        $en = $category->translations[1]->description;
        $al = $category->translations[0]->description;


        return view('admin.categories.edit', compact('category', 'about', 'en', 'al'));
    }


    public function update(Request $request, Category $category)
    {
        //

        $category = Category::where('id', $category->id)->first();
        // dd($category);

        $category->update([
            'name' => $request->input('name'),
            'about_id' => $request->input('about_id'),
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
        // if ($request->hasFile('category_img')) {
        //     $category->addMedia($request->file('category_img'))->toMediaCollection('catimg');
        // }
        return redirect()->route('category.index')->with('status', 'category added successfully');
    }


    public function destroy(Category $category)
    {
        //
        $category->delete();
        return redirect()->route('category.index');
    }
}
