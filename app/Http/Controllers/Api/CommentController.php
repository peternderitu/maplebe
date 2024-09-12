<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParentComment;

class CommentController extends Controller
{

    public function index($micro_blog_id) {
        // find comments by the micro blog id
        // this should fetch with the replies?
        // or maybe fetch replies on link click would be better
        try {
            $comments = ParentComment::where('micro_blog_id', $micro_blog_id)->with('user')->with('replies')->get();
            return response()->json([
                'data' => $comments
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not find comments'
            ], 404);
        }
    }

    public function store(Request $request) {
        try {   
            $request->validate([
                'micro_blog_id' => 'required',
                'content' => 'required',
            ],
            [
                'micro_blog_id.required' => 'Comment must belong to a micro blog',
                'content.required' => 'Please provide content',
            ]);   

            $comment = new ParentComment();
            $comment->content = $request->content;
            $comment->micro_blog_id = $request->micro_blog_id;
            $comment->user_id = $request->user()->id;
            $comment->save();
            return response()->json([
                'message' => 'Added comment successfully',
                'data' => $comment
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not add comment',
                'error' => $exception->message
            ], 404);
        }
    }

    public function show($id) {
        $comment = ParentComment::where('id', $id)->first();
        if($comment) {
            return response()->json([
                'data' => $comment,
                'message' => 'Found comment'
            ]);
        } else {
            return response()->json([
                'message' => 'Could not find comment'
            ], 404);
        }
    }

    public function update(Request $request, $id) {
        try {
            $request->validate([
                'micro_blog_id' => 'required',
                'content' => 'required',
            ],
            [
                'micro_blog_id.required' => 'Comment must belong to a micro blog',
                'content.required' => 'Please provide content',
            ]);  

            $comment = ParentComment::where('id', $id)->first();
            $comment->content = $request->content;
            $comment->save();
            return response()->json([
                'message' => 'Updated comment successfully',
                'data' => $comment
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not update comment',
                'error' => $exception->message
            ], 404);
        }
    }

    public function destroy($id) {
        try {
            $comment = ParentComment::where('id', $id)->first();
            $comment->delete();
            return response()->json([
                'message' => 'Deleted comment'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not delete comment',
            ], 404);
        }
    }
}
