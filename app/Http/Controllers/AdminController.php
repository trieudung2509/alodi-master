<?php

namespace App\Http\Controllers;

use App\Blog;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Cache;
use Spatie\Analytics\AnalyticsFacade as Analytics;
use Spatie\Analytics\Period;

class AdminController extends Controller
{
    protected $analytics_cache_key = 'analytics_query';

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_dashboard(Request $request)
    {
        $blogs = Blog::with(['author', 'editor'])->orderBy('created_at', 'desc');

        $blogs = $blogs->simplePaginate(5)->withQueryString();

        $response = Cache::remember($this->analytics_cache_key, now()->addHours(4), function () {
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

        return view('backend.dashboard', compact('blogs', 'analytics_data'));
    }

    public function test_analytics_data() {
//        $response = Analytics::performQuery(null,
//            'ga:pageviews',
//            [
//                'dimensions' => 'ga:pagePath,ga:pageTitle',
//                'sort' => '-ga:pageviews'
//            ]
//        );
//        $analyticsData = Analytics::fetchMostVisitedPages(Period::);
//        dd($analyticsData);
//        $end = Carbon::now()->minute(0);
//        $start = new DateTime(Carbon::createFromFormat('Y-m-d', '2021-11-01'));
//
//        $response = Analytics::performQuery(
//            Period::create($end->copy()->subDays(30), $end),
//            'ga:users,ga:pageviews',
//            ['dimensions' => 'ga:pagePath']
//        );
//        $analyticsData = collect($response['rows'] ?? [])->map(function (array $dateRow) {
//            return [
//                'url' => $dateRow[0],
//                'visitors' => (int) $dateRow[1],
//                'pageViews' => (int) $dateRow[2],
//            ];
//        });
//        dd($analyticsData);
    }
}
