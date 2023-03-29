<?php

namespace App\Http\Controllers;

use App\Taxonomy;
use App\Term;
use App\TermRelationship;
use Illuminate\Http\Request;

class TermController extends Controller
{
    public function index(Request $request)
    {
        $sort_search = null;
        $sort_slug = null;
        $sort_taxonomy = null;
        $show_on_home_page = null;

        $termQuery = Term::query()->with('blogs');
        if ((!isset($request->search) || trim($request->search) === '') == false)
        {
            $termQuery = $termQuery->where('name', 'like', $request->search . '%');
            $sort_search = $request->search;
        }

        if ((!isset($request->slug) || trim($request->slug) === '') == false)
        {
            $termQuery = $termQuery->where('slug', 'like', $request->slug . '%');
        }

        if ((!isset($request->taxonomy_name) || trim($request->taxonomy_name) === '') == false)
        {
            $termQuery = $termQuery->where('taxonomy_name', 'like', $request->taxonomy_name . '%');
        }

        if ($request->show_on_home_page != null) {
            $termQuery = $termQuery->where('show_on_home_page', $request->show_on_home_page);
            $show_on_home_page = $request->show_on_home_page;
        }

        $terms = $termQuery->paginate(15)->withQueryString();

        return view('backend.blog_system.term.index', compact('terms', 'sort_search', 'sort_slug',
            'sort_taxonomy', 'show_on_home_page'));
    }

    public function create()
    {
        $taxonomies = Taxonomy::all();
        return view('backend.blog_system.term.create', compact('taxonomies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:200',
            'slug' => 'required|max:200',
            'taxonomy_id' => 'required'
        ]);


        $term = new Term();
        $term->name = $request->name;
        $term->taxonomy_id = $request->taxonomy_id;
        $term->taxonomy_name = Taxonomy::find($request->taxonomy_id)->name;

        $term->description = $request->description;
        $term->slug = $request->slug;
        $term->display_order = $request->display_order != null ? $request->display_order : 0;
        $term->meta_description = $request->meta_description;
        $term->meta_title = $request->meta_title;
        $term->show_on_header = $request->has('show_on_header') != null ? 1 : 0;
        $term->show_on_home_page = $request->has('show_on_home_page') != null ? 1 : 0;
        $term->meta_img = $request->meta_img;
        $term->small_img = $request->small_img;

        if ($request->parent_id != "0" && $request->parent_id != null) {
            $term->parent_id = $request->parent_id;

            $parent = Term::find($request->parent_id);
            $term->level = $parent->level + 1 ;
        }
        else {
            $term->parent_id = null;
        }

        $term->save();

        flash(translate('Term has been created successfully'))->success();
        return redirect()->route('term.index');
    }

    public function edit($id)
    {
        $term = Term::find($id);
        if ($term == null)
            abort(404);

        $taxonomies = Taxonomy::all();
        return view('backend.blog_system.term.edit', compact('term', 'taxonomies'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:200',
            'slug' => 'required|max:200'
        ]);

        $term = Term::find($id);

        $term->name = $request->name;
        $term->slug = $request->slug;
        $term->description = $request->description;
        $term->display_order = $request->display_order != null ? $request->display_order : 0;
        $term->show_on_header = $request->has('show_on_header') != null ? 1 : 0;
        $term->show_on_home_page = $request->has('show_on_home_page') != null ? 1 : 0;
        $term->meta_description = $request->meta_description;
        $term->meta_title = $request->meta_title;
        $term->meta_img = $request->meta_img;
        $term->small_img = $request->small_img;

        if ($request->parent_id != "0" && $request->parent_id != null) {
            $term->parent_id = $request->parent_id;

            $parent = Term::find($request->parent_id);
            $term->level = $parent->level + 1 ;
        }

        $term->save();

        flash(translate('Term has been updated successfully'))->success();
        return redirect()->route('term.index');
    }

    public function destroy($id)
    {
        $term = Term::find($id);
        if ($term == null)
            abort(404);

        $term->delete();

        flash(translate('Term has been deleted successfully'))->success();
        return redirect()->route('term.index');
    }

    public function blog_listing($slug)
    {
        return redirect()->action('PageController@show_custom_page', [$slug]);
    }

    public function change_show_on_home_page(Request $request)
    {
        $term = Term::find($request->id);
        $term->show_on_home_page = $request->show_on_home_page;

        $term->save();
        return 1;
    }

    public function change_show_on_header(Request $request)
    {
        $term = Term::find($request->id);
        $term->show_on_header = $request->show_on_header;

        $term->save();
        return 1;
    }
}
