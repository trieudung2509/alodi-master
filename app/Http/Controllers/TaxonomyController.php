<?php

namespace App\Http\Controllers;

use App\Taxonomy;
use App\Term;
use DB;
use Illuminate\Http\Request;
use Throwable;

class TaxonomyController extends Controller
{
    public function index(Request $request)
    {
        $sort_search = null;
        $sort_slug = null;
        $show_on_header = null;

        $taxonomyQuery = Taxonomy::query();
        if ((!isset($request->search) || trim($request->search) === '') == false)
        {
            $taxonomyQuery = $taxonomyQuery->where('name', 'like', $request->search . '%');
            $sort_search = $request->search;
        }

        if ((!isset($request->slug) || trim($request->slug) === '') == false)
        {
            $taxonomyQuery = $taxonomyQuery->where('slug', 'like', $request->slug . '%');
        }

        if ($request->show_on_header != null) {
            $taxonomyQuery = $taxonomyQuery->where('show_on_header', $request->show_on_header);
            $show_on_header = $request->show_on_header;
        }

        $taxonomies = $taxonomyQuery->paginate(15)->withQueryString();

        return view('backend.blog_system.taxonomy.index', compact('taxonomies', 'sort_search',
            'sort_slug', 'show_on_header'));
    }

    public function create()
    {
        return view('backend.blog_system.taxonomy.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:200',
            'slug' => 'required|max:200'
        ]);

        $taxonomy = Taxonomy::onlyTrashed()
            ->where('name', '=', $request->name)
            ->first();

        if ($taxonomy != null)
        {
            $taxonomy->restore();
            Term::onlyTrashed()->where('taxonomy_id', $taxonomy->id)->restore();
        }
        else
        {
            $taxonomy = new Taxonomy();
            $taxonomy->name = $request->name;
        }

        $taxonomy->description = $request->description;
        $taxonomy->slug = $request->slug;
        $taxonomy->is_hierarchical = $request->is_hierarchical;
        $taxonomy->display_order = $request->display_order != null ? $request->display_order : 0;
        $taxonomy->meta_title = $request->meta_title;
        $taxonomy->meta_description = $request->meta_description;

        $taxonomy->is_hierarchical = $request->has('is_hierarchical') ? 1 : 0;
        $taxonomy->show_on_header = $request->has('show_on_header') ? 1 : 0;
        $taxonomy->meta_img = $request->meta_img;
        $taxonomy->save();

        flash(translate('Taxonomy has been created successfully'))->success();
        return redirect()->route('taxonomy.index');
    }

    public function edit($id)
    {
        $taxonomy = Taxonomy::find($id);
        if ($taxonomy == null)
            abort(404);

        return view('backend.blog_system.taxonomy.edit', compact('taxonomy'));
    }

    /**
     * @throws Throwable
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:200',
            'slug' => 'required|max:200'
        ]);

        $taxonomy = Taxonomy::find($id);

        if ($taxonomy == null)
            abort(404);

        DB::beginTransaction();
        try {
            $taxonomy->name = $request->name;
            $taxonomy->slug = $request->slug;
            $taxonomy->display_order = $request->display_order != null ? $request->display_order : 0;
            $taxonomy->meta_title = $request->meta_title;
            $taxonomy->meta_description = $request->meta_description;
            $taxonomy->is_hierarchical = $request->has('is_hierarchical') ? 1 : 0;
            $taxonomy->show_on_header = $request->has('show_on_header') ? 1 : 0;
            $taxonomy->meta_img = $request->meta_img;

            $taxonomy->save();
            Term::where('taxonomy_id', $taxonomy->id)->update(['taxonomy_name' => $taxonomy->name]);

            DB::commit();

            flash(translate('Taxonomy has been updated successfully'))->success();

        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return redirect()->route('taxonomy.index');
    }

    public function destroy($id)
    {
        $taxonomy = Taxonomy::find($id);
        if ($taxonomy == null)
            abort(404);

        $taxonomy->delete();

        flash(translate('Taxonomy has been deleted successfully'))->success();
        return redirect()->route('taxonomy.index');
    }
}
