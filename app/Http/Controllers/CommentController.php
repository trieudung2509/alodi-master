<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Comment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $comments = Comment::with('blog', 'author')->orderBy('created_at', 'desc');

        if ($request->has('search')) {
            $sort_search = $request->search;
            $comments = $comments->where('description', 'like', '%' . $sort_search . '%');
        }

        $comments = $comments->paginate(15)->withQueryString();

        return view('backend.blog_system.comment.index', compact('comments'));
    }

    public function change_status(Request $request)
    {
        $comment = Comment::find($request->id);
        $comment->is_approved = $request->is_approved;

        $comment->save();
        return 1;
    }

    public function store(Request $request, $slug)
    {
        $request->validate([
            'description' => 'required',
            'author_name' => 'required|max:255',
            'author_email' => 'required|max:255',
            'blog_id' => 'required'
        ]);

        $blog = Blog::where('id', $request->blog_id)->first();
        if ($blog != null)
        {
            $user = User::where('email', '=', $request->author_email)->first();
            DB::beginTransaction();
            try
            {
                if ($user == null)
                {
                    $user = new User;
                    $user->email = $request->author_email;
                    $user->name = $request->author_name;
                    $user->user_type = 'guest';
                    $user->save();
                }

                $comment = new Comment;
                $comment->is_approved = false;
                $comment->author_id = $user->id;
                $comment->author_name = $request->author_name;
                $comment->description = $request->description;

                $blog->comments()->save($comment);
                DB::commit();
            }
            catch (\Exception $exception)
            {
                DB::rollBack();
                throw $exception;
            }

            return redirect()->route('custom-pages.show_custom_page', [$slug, '#comments']);
//            return redirect()->action('PageController@show_custom_page', [$slug]);
        }

        abort(404);
    }

    public function edit($id)
    {
        $comment = Comment::with('blog', 'author')->find($id);
        if ($comment == null)
            abort(404);

        return view('backend.blog_system.comment.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required'
        ]);

        $comment = Comment::find($id);

        if ($comment != null)
        {
            $comment->description = $request->description;
            $comment->save();

            return redirect()->route('comment.index');
        }

        abort(404);
    }


    public function destroy($id)
    {
        Comment::find($id)->delete();
        return redirect('admin/comments');
    }
}
