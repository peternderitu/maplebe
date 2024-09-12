<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MicroBlogFavourite;
use App\Models\MicroBlog;

class MicroBlogFavouriteController extends Controller
{
    public function index(Request $request) {
        // get all the favourites of the logged in user
        $user = $request->user();
        $favourites = MicroBlogFavourite::with('micro-blogs')->where('user_id', $user->id)->get();
        if($favourites) {
            return response()->json([
                'message' => 'Found favourites',
                'favourites' => $favourites
            ]);
        } else {
            return response()->json([
                'message' => 'Could not find favourites. Ensure user is logged in'
            ]);
        }
    }

    public function store(Request $request) {
        // add a favourite - you need the micro blog id and the user id of the logged in user
        try {
            $request->validate([
                'micro_blog_id' => 'required'
            ], 
            [
                'micro_blog_id.required' => 'Please provide the micro blog id'
            ]);
            $user = $request->user();
            if(!$user){
                return response()->json([
                    'message' => 'User not logged in'
                ]);
            } else {
                $favourite = new MicroBlogFavourite();
                $favourite->micro_blog_id = $request->micro_blog_id;
                $favourite->user_id = $user->id;
                $favourite->save();
                $micro_blog = MicroBlog::where('id', $request->micro_blog_id)->first();
                $micro_blog->isFavourite = true;
                return response()->json([
                    'message' => 'Micro blog favourited',
                    'data' => $micro_blog
                ]);
            }

        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not favourite deal.'
            ]);
        }
    }

    public function show($id) {
        // this one not sure whether I'll need it but getting a favourite by the id, will use with id
    }

    public function update(Request $request, $id) {
        // this one I don't think I'll need
    }

    public function destroy(Request $request, $id) {
        try {
            $user = $request->user();
            $favourite = MicroBlogFavourite::where('user_id', $user->id)
                                    ->where('micro_blog_id', $id)
                                    ->first();
            $favourite->delete();
            return response()->json([
                'message' => 'Removed micro blog as favourite',
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not delete favourite',
                'error' => $exception->message
            ],500);
        }
    }
}
