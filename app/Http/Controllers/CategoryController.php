<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Upload;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $categories = Category::with('posts')->orderBy('name', 'asc');

        if ($request->has('search')){
            $sort_search = $request->search;
            $categories = $categories->where('name', 'like', '%'.$sort_search.'%');
        }

        $categories = $categories->paginate(15);
        return view('backend.blog_system.category.index', compact('categories', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_categories =  Category::where('parent_id', null)
            ->with('childrenCategories')
            ->get();

        return view('backend.blog_system.category.create', compact('all_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255',
        ]);

        $category = new Category;

        $category->name = $request->name;

        if($request->display_order != null) {
            $category->display_order = $request->display_order;
        }
        $category->meta_description = $request->meta_description;
        $category->meta_title = $request->meta_title;
        $category->description = $request->description;

        if ($request->parent_id != "0" && $request->parent_id != null) {
            $category->parent_id = $request->parent_id;

            $parent = Category::find($request->parent_id);
            $category->level = $parent->level + 1 ;
        }
        else {
            $category->parent_id = null;
        }

        $category->slug = Str::of($request->slug)->slug('-');
        $category->meta_img = $request->meta_img;
        $category->show_on_home_page = $request->has('show_on_home_page') ? 1 : 0;
        $category->show_on_header = $request->has('show_on_header') ? 1 : 0;

        $category->save();


        flash(translate('Blog category has been created successfully'))->success();
        return redirect()->route('category.index');
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
        $category = Category::find($id);
        if ($category == null)
            abort(404);

        $all_categories = Category::all();

        return view('backend.blog_system.category.edit',  compact('category','all_categories'));
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
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $category = Category::find($id);

        $category->name = $request->name;

        if($request->display_order != null) {
            $category->display_order = $request->display_order;
        }
        $category->meta_description = $request->meta_description;
        $category->meta_title = $request->meta_title;
        $category->description = $request->description;

        if ($request->parent_id != "0" && $request->parent_id != null) {
            $category->parent_id = $request->parent_id;

            $parent = Category::find($request->parent_id);
            $category->level = $parent->level + 1 ;
        }

        $category->slug = Str::of($request->slug)->slug('-');
        $category->meta_img = $request->meta_img;
        $category->show_on_home_page = $request->has('show_on_home_page') ? 1 : 0;
        $category->show_on_header = $request->has('show_on_header') ? 1 : 0;

        $category->save();


        flash(translate('Blog category has been updated successfully'))->success();
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();

        return redirect('admin/category');
    }

    public function blog_listing($slug)
    {
        return redirect()->action('PageController@show_custom_page', [$slug]);
    }
}
