<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reply;


class ReplyController extends Controller
{
    public function index($parent_comment_id) {
        // get all replies based on parent comment id
        try {
            $replies = Reply::where('parent_comment_id', $parent_comment_id)->get();
            return response()->json([
                'message' => 'Found replies',
                'data' => $replies
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not find replies'
            ], 404);
        }
    }

    public function store(Request $request) {
        // when storing, one needs the parent comment id
        try {   
            $request->validate([
                'parent_comment_id' => 'required',
                'content' => 'required',
            ],
            [
                'parent_comment_id.required' => 'Please provide comment id',
                'content.required' => 'Please provide content',
            ]);   

            $reply = new Reply();
            $reply->content = $request->content;
            $reply->parent_comment_id = $request->parent_comment_id;
            $reply->user_id = $request->user()->id;
            $reply->save();
            return response()->json([
                'message' => 'Added reply successfully',
                'data' => $reply
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not add reply',
                'error' => $exception->message
            ], 404);
        }
    }

    public function show($id) {
        $reply = Reply::where('id', $id)->first();
        if($reply) {
            return response()->json([
                'data' => $reply,
                'message' => 'Found reply'
            ]);
        } else {
            return response()->json([
                'message' => 'Could not find reply'
            ], 404);
        }
    }

    public function update(Request $request, $id) {
        try {
            $request->validate([
                'parent_comment_id' => 'required',
                'content' => 'required',
            ],
            [
                'parent_comment_id.required' => 'Please provide comment id',
                'content.required' => 'Please provide content',
            ]);  

            $reply = Reply::where('id', $id)->first();
            $reply->content = $request->content;
            $reply->save();
            return response()->json([
                'message' => 'Updated reply successfully',
                'data' => $reply
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not update reply',
                'error' => $exception->message
            ], 404);
        }
    }

    public function destroy($id) {
        try {
            $reply = Reply::where('id', $id)->first();
            $reply->delete();
            return response()->json([
                'message' => 'Deleted reply'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not delete reply',
            ], 404);
        }
    }
}
