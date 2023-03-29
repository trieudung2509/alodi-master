<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Category;
use App\Taxonomy;
use App\Term;
use App\Upload;
use Illuminate\Http\Request;
use App\Page;
use App\PageTranslation;


class PageController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.website_settings.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $page = new Page;
        $page->title = $request->title;
        if (Page::where('slug', preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug)))->first() == null)
        {
            $page->slug             = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
            $page->type             = "custom_page";
            $page->content          = $request->content;
            $page->meta_title       = $request->meta_title;
            $page->meta_description = $request->meta_description;
            $page->keywords         = $request->keywords;
            $page->meta_image       = $request->meta_image;
            $page->system_name      = $request->system_name;
            $page->save();

            $page_translation           = PageTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'page_id' => $page->id]);
            $page_translation->title    = $request->title;
            $page_translation->content  = $request->content;
            $page_translation->save();

            flash(translate('New page has been created successfully'))->success();
            return redirect()->route('website.pages');
        }

        flash(translate('Slug has been used already'))->warning();
        return back();
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
   public function edit(Request $request, $id)
   {
        $lang = $request->lang;
        $page_name = $request->page;
        $page = Page::where('slug', $id)->first();
        if($page != null){
          if ($page_name == 'home') {
            return view('backend.website_settings.pages.home_page_edit', compact('page','lang'));
          }
          else{
            return view('backend.website_settings.pages.edit', compact('page','lang'));
          }
        }
        abort(404);
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
        $page = Page::findOrFail($id);
        if (Page::where('id','!=', $id)->where('slug', preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug)))->first() == null) {
            if($page->type == 'custom_page'){
              $page->slug           = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
            }
            if($request->lang == env("DEFAULT_LANGUAGE")){
              $page->title          = $request->title;
              $page->content        = $request->content;
            }
            $page->meta_title       = $request->meta_title;
            $page->meta_description = $request->meta_description;
            $page->keywords         = $request->keywords;
            $page->meta_image       = $request->meta_image;
            $page->system_name      = $request->system_name;
            $page->save();

            $page_translation           = PageTranslation::firstOrNew(['lang' => $request->lang, 'page_id' => $page->id]);
            $page_translation->title    = $request->title;
            $page_translation->content  = $request->content;
            $page_translation->save();

            flash(translate('Page has been updated successfully'))->success();
            return redirect()->route('website.pages');
        }

      flash(translate('Slug has been used already'))->warning();
      return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        foreach ($page->page_translations as $key => $page_translation) {
            $page_translation->delete();
        }
        if(Page::destroy($id)){
            flash(translate('Page has been deleted successfully'))->success();
            return redirect()->back();
        }
        return back();
    }

    public function show_custom_page($slug)
    {
        $page = Page::where('slug', $slug)->first();
        if ($page != null)
        {
            return view('frontend.custom_page', compact('page'));
        }

        $blog = Blog::with('categories', 'comments', 'author', 'editor')
            ->where('status', '!=', 0)
            ->where('slug', $slug)->first();
        if ($blog != null)
        {
            return view("frontend.blog.details", compact('blog'));
        }

        $category = Category::with('posts')->where('slug', $slug)->first() ;
        if ($category != null)
        {
            $category->posts = $category->posts
                ->where('status', '!=', 0)
                ->sortByDesc('display_date')
                ->simplePaginate();
            return view('frontend.category.blogs', compact('category'));
        }

        $term = Term::with('blogs')->where('slug', $slug)->first();
        if ($term != null)
        {
            $term->blogs = $term->blogs
                ->where('status', '!=', 0)
                ->sortByDesc('display_date')
                ->simplePaginate();

            return view('frontend.term.blogs', compact('term'));
        }


        return redirect()->action('HomeController@index');
    }

    public function mobile_custom_page($slug)
    {
        $page = Page::where('slug', $slug)->first();
        if ($page != null)
        {
            return view('frontend.m_custom_page', compact('page'));
        }

        $blog = Blog::where('slug', $slug)
            ->where('status', '!=', 0)
            ->first();
        if ($blog != null)
        {
            return view("frontend.blog.details", compact('blog'));
        }

        $category = Category::with('posts')->where('slug', $slug)->first();
        if ($category != null)
        {
            $category->posts = $category->posts
                ->where('status', '!=', 0)
                ->sortByDesc('display_date');
            return view('frontend.category.blogs', compact('category'));
        }

        $term = Term::with('blogs')->where('slug', $slug)->first();
        if ($term != null)
        {
            $term->blogs = $term->blogs
                ->where('status', '!=', 0)
                ->sortByDesc('display_date');
            return view('frontend.term.blogs', compact('term'));
        }

        return redirect()->action('HomeController@index');
    }
}
