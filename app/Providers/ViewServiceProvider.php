<?php

namespace App\Providers;

use App\Blog;
use App\Category;
use App\Term;
use Cache;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\View;
use Illuminate\View\FileViewFinder;
use Illuminate\View\ViewServiceProvider as ConcreteViewServiceProvider;
use Spatie\Analytics\AnalyticsFacade as Analytics;
use Spatie\Analytics\Period;

class ViewServiceProvider extends ConcreteViewServiceProvider
{
    protected $analytics_cache_key = 'analytics_query';

    /**
     * Register the view finder implementation.
     *
     * @return void
     */
    public function registerViewFinder()
    {
        $this->app->bind('view.finder', function ($app) {
            $paths = config('view.paths');

            //change your paths here
            $app_name = env('APP_NAME');
            if ($app_name == 'ALODI') {
                array_push($paths, resource_path('themes/alodi'));
            }
            else if ($app_name == 'ONGCHAMCHI') {
                array_push($paths, resource_path('themes/ongchamchi'));
            }

            return new FileViewFinder($app['files'], $paths);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('frontend.layouts.sidebar', function ($view) {
            $response = Cache::remember($this->analytics_cache_key, now()->addHours(4), function() {
                $end = Carbon::now()->minute(0);
                $start = new DateTime(Carbon::createFromFormat('Y-m-d', '2021-11-01'));
                return Analytics::performQuery(
                    Period::create($start, $end),
                    'ga:users,ga:pageviews',
                    ['dimensions' => 'ga:pagePath']
                );
            });

            $analytics_data = collect($response['rows'] ?? [])
                ->map(function (array $dateRow) {
                    return [
                        'url' => substr($dateRow[0], 1),
                        'visitors' => (int) $dateRow[1],
                        'pageViews' => (int) $dateRow[2],
                    ];
                })
                ->sortByDesc('pageViews');

            $categories_query = Category::select('slug')->get();
            $all_categories_slugs= $categories_query->map(function ($item) {
                return $item['slug'];
            })->toArray();
            $terms_query = Term::select('slug')->get();
            $all_terms_slugs = $terms_query->map(function ($item) {
                return $item['slug'];
            })->toArray();
            $popular_urls = $analytics_data
                ->map(function ($item) {
                    return $item['url'];
                })
                ->filter(function ($url) use ($all_terms_slugs, $all_categories_slugs) {
                    return $url != ''
                        && !in_array($url, $all_categories_slugs)
                        && !in_array($url, $all_terms_slugs);
                })
                ->take(5)
                ->toArray();

            $popular_blogs = Blog::whereIn('slug', $popular_urls)->get();
            $view->with('popular_blogs', $popular_blogs);
        });
    }
}
