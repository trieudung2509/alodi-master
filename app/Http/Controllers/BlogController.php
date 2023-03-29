<?php

namespace App\Http\Controllers;

use App\BlogHistory;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Term;
use App\User;
use Cache;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\Category;
use App\Blog;
use Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Analytics\AnalyticsFacade as Analytics;
use Spatie\Analytics\Period;
use DateTime;
use Str;

class BlogController extends Controller
{
    protected $blogs_cache_key = 'blogs_admin';
    protected $analytics_cache_key = 'analytics_query';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $sort_search = null;
        $sort_status = null;
        $sort_category_ids = null;
        $sort_published_date_range = null;
        $sort_display_date_range = null;
        $sort_author = null;
        $sort_editor = null;
        $sort_featured = null;

        $blogs = Blog::with(['blogHistories', 'author', 'editor', 'categories', 'terms'])->orderBy('created_at', 'desc');
        if ($request->status != null) {
            $blogs = $blogs->where('status',$request->status);
            $sort_status = $request->status;
        }

        if ($request->published_date_range != null) {
            $date_range_array = explode(' to ', $request->published_date_range);
            $start_time = Carbon::parse($date_range_array[0], app_timezone())->setTimezone('UTC');
            $end_time = Carbon::parse($date_range_array[1], app_timezone())->setTimezone('UTC');
            $blogs = $blogs->where('published_date', '>=', $start_time)->where('published_date', '<=', $end_time);
            $sort_published_date_range = $request->published_date_range;
        }

        if ($request->display_date_range != null) {
            $date_range_array = explode(' to ', $request->display_date_range);
            $start_time = Carbon::parse($date_range_array[0], app_timezone())->setTimezone('UTC');
            $end_time = Carbon::parse($date_range_array[1], app_timezone())->setTimezone('UTC');
            $blogs = $blogs->where('published_date', '>=', $start_time)->where('published_date', '<=', $end_time);
            $sort_published_date_range = $request->display_date_range;
        }

        if ($request->search != null) {
            $blogs = $blogs->where('title', 'like', '%' . $request->search . '%');
            $sort_search = $request->search;
        }

        if ($request->category_ids != null) {
            $sort_category_ids = $request->category_ids;
            $blogs = $blogs->whereHas('categories', function($query) use ($request) {
                return $query->whereIn('id', $request->category_ids);
            });
        }

        if ((!isset($request->author) || trim($request->author) === '') == false) {
            $blogs = $blogs->whereHas('author', function($query) use ($request) {
                return $query->where('name', 'LIKE', '%'.$request->author.'%');
            });
            $sort_author = $request->author;
        }

        if ((!isset($request->editor) || trim($request->editor) === '') == false) {
            $blogs = $blogs->whereHas('editor', function($query) use ($request) {
                return $query->where('name', 'LIKE', '%'.$request->editor.'%');
            });
            $sort_editor = $request->editor;
        }

        if ($request->featured != null) {
            $blogs = $blogs->where('featured', $request->featured);
            $sort_featured = $request->featured;
        }

        $blogs = $blogs->paginate(15)->withQueryString();

        $response = Cache::remember($this->analytics_cache_key, now()->addHours(4), function() {
            $end = Carbon::now()->minute(0);
            $start = new DateTime(Carbon::createFromFormat('Y-m-d', '2021-11-01'));
            return Analytics::performQuery(
                Period::create($start, $end),
                'ga:users,ga:pageviews',
                ['dimensions' => 'ga:pagePath']
            );
        });

        $analytics_data = collect($response['rows'] ?? [])->map(function (array $dateRow) {
            return [
                'url' => $dateRow[0],
                'visitors' => (int) $dateRow[1],
                'pageViews' => (int) $dateRow[2],
            ];
        });

        return view('backend.blog_system.blog.index',
            compact('blogs', 'sort_search', 'sort_category_ids', 'sort_published_date_range',
                'sort_display_date_range', 'sort_author', 'sort_editor', 'sort_status', 'analytics_data', 'sort_featured'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $terms = Term::all();
        return view('backend.blog_system.blog.create', compact('categories', 'terms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'sub_title' => 'required|max:255'
        ]);

        $blog = new Blog;

        $blog->title = $request->title;
        $blog->sub_title = $request->sub_title;
        $blog->slug = Str::of($request->slug)->slug('-');
        $blog->version = $request->version;
        $blog->small_img = $request->small_img;
        $blog->meta_img = $request->meta_img;
        $blog->meta_keywords = $request->meta_keywords;
        $blog->meta_title = $request->meta_title;
        $blog->source_url = $request->source_url;
        $blog->short_description = $request->short_description;
        $blog->meta_description = $request->meta_description;
        $blog->description = $request->description;
        $blog->published_date = Carbon::parse($request->published_date, 'Asia/Bangkok')->setTimezone('UTC');
        $blog->display_date = Carbon::now('UTC');
        $blog->priority_type = $request->priority_type;
        $blog->author_id = Auth::user()->id;
        $blog->status = 0;
        $blog->featured = $request->has('featured') ? 1 : 0;
        $blog->description_word_count = $request->description_word_count;


        $blog->save();
        $blog->categories()->sync($request->category_ids);
        $blog->terms()->sync($request->term_ids);


        Cache::forget($this->blogs_cache_key);
        flash(translate('Blog post has been created successfully'))->success();
        return redirect()->route('blog.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::with('categories', 'terms')->find($id);
        if ($blog == null)
            abort(404);

        $categories = Category::all();
        $terms = Term::all();

        return view('backend.blog_system.blog.edit', compact('blog', 'categories', 'terms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'sub_title' => 'required|max:255',
            'slug' => 'required'
        ]);

        $blog = Blog::find($id);

        $featured = (isset($request->featured) ? '1' : '0');

        $blogHistory = new BlogHistory();
        $blogHistory->blog_id = $blog->id;
        $blogHistory->title = $blog->title;
        $blogHistory->sub_title = $blog->sub_title;
        $blogHistory->slug = $blog->slug;
        $blogHistory->version = $blog->version;
        $blogHistory->small_img = $blog->small_img;
        $blogHistory->meta_img = $blog->meta_img;
        $blogHistory->meta_keywords = $blog->meta_keywords;
        $blogHistory->meta_title = $blog->meta_title;
        $blogHistory->source_url = $blog->source_url;
        $blogHistory->short_description = $blog->short_description;
        $blogHistory->meta_description = $blog->meta_description;
        $blogHistory->description = $blog->description;
        $blogHistory->status = $blog->status;
        $blogHistory->priority_type = $blog->priority_type;
        $blogHistory->replaced_at = Carbon::now('UTC');
        $blogHistory->editor_id = $blog->editor_id;
        $blogHistory->category_names = json_encode($blog->categories->map(function($item) {return $item->name;}));
        $blogHistory->featured = $blog->featured;
        $blogHistory->description_word_count = $blog->description_word_count;


        $blog->title = $request->title;
        $blog->sub_title = $request->sub_title;
        $blog->slug = Str::of($request->slug)->slug('-');
        $blog->version = $request->version;
        $blog->small_img = $request->small_img;
        $blog->meta_img = $request->meta_img;
        $blog->meta_keywords = $request->meta_keywords;
        $blog->meta_title = $request->meta_title;
        $blog->source_url = $request->source_url;
        $blog->short_description = $request->short_description;
        $blog->meta_description = $request->meta_description;
        $blog->description = $request->description;
        $blog->display_date = Carbon::now('UTC');
        $blog->priority_type = $request->priority_type;
        $blog->editor_id = Auth::user()->id;
        $blog->featured = $request->has('featured') ? 1 : 0;
        $blog->description_word_count = $request->description_word_count;
        $blog->published_date = Carbon::parse($request->published_date, 'Asia/Bangkok')->setTimezone('UTC');

        $blogHistory->save();
        $blog->save();
        $blog->categories()->sync($request->category_ids);
        $blog->terms()->sync($request->term_ids);

        Cache::forget($this->blogs_cache_key);
        flash(translate('Blog post has been updated successfully'))->success();
        return redirect()->route('blog.index');
    }

    public function change_status(Request $request)
    {
        $blog = Blog::find($request->id);
        $blog->status = $request->status;

        $blog->save();

        Cache::forget($this->blogs_cache_key);
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Blog::find($id)->delete();
        Cache::forget($this->blogs_cache_key);
        return redirect('admin/blog');
    }


    public function all_blog()
    {
        $blogs = Blog::where('status', 1)->orderBy('created_at', 'desc')->paginate(12);
        return view("frontend.blog.listing", compact('blogs'));
    }

    public function blog_details($slug)
    {
        return redirect()->action('PageController@show_custom_page', [$slug]);
    }
}
