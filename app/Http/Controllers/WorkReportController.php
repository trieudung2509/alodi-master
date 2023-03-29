<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WorkReport;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;

class WorkReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $sort_search_user = null;
        $work_reports = WorkReport::orderBy('blog_name', 'asc');

        if ($request->has('search')){
            $sort_search = $request->search;
            $work_reports = $work_reports->where('blog_name', 'like', '%'.$sort_search.'%');
        }

        if($request->user_search != null) {
            $sort_search_user = $request->user_search;
            $work_reports = WorkReport::whereHas('user', function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->user_search.'%');
               });
        }

        $work_reports = $work_reports->paginate(15);
        return view('backend.blog_system.work_report.index', compact('work_reports', 'sort_search','sort_search_user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $work_reports =  WorkReport::all();

        $users = User::all();

        return view('backend.blog_system.work_report.create', compact('work_reports', 'users'));
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
            'blog_name' => 'required|max:255',
        ]);

        $work_report = new WorkReport;

        $work_report->blog_name = $request->blog_name;
        $work_report->is_created = $request->is_created;
        $work_report->work_date = Carbon::parse($request->work_date, 'Asia/Bangkok')->setTimezone('UTC');
        $work_report->words_count = $request->words_count;
        $work_report->images_count = $request->images_count;
        $work_report->display_link = $request->display_link;
        $work_report->notes = $request->notes;
        if(Auth::user()->user_type == 'admin') {
            $work_report->user_id = $request->user_id;
        } else {
            $work_report->user_id = Auth::user()->id;
        }

        $work_report->save();

        flash(translate('Work Report has been created successfully'))->success();
        return redirect()->route('work-report.index');

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
        $work_report = WorkReport::find($id);
        $users = User::all();

        return view('backend.blog_system.work_report.edit', compact('work_report', 'users'));
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
            'blog_name' => 'required|max:255',
        ]);

        $work_report = WorkReport::find($id);

        $work_report->blog_name = $request->blog_name;
        $work_report->is_created = $request->is_created;
        $work_report->work_date = Carbon::parse($request->work_date, 'Asia/Bangkok')->setTimezone('UTC');
        $work_report->words_count = $request->words_count;
        $work_report->images_count = $request->images_count;
        $work_report->display_link = $request->display_link;
        $work_report->notes = $request->notes;
        if(Auth::user()->user_type == 'admin') {
            $work_report->user_id = $request->user_id;
        }

        $work_report->save();

        flash(translate('Work Report has been updated successfully'))->success();
        return redirect()->route('work-report.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        WorkReport::find($id)->delete();

        return redirect('admin/work-report');
    }
}
