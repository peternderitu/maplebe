<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MicroBlog;
use App\Models\MicroBlogFavourite;

class MicroBlogController extends Controller
{

    public function index() {
        try {
            // on getting all I also need to get the number of likes and number of comments
            $blogs = MicroBlog::with('category')->with('user')->withCount('microBlogFavourite')->withCount('parentComment')->get();
            return response()->json([
                'data' => $blogs,
                // MicroBlog::with('category')->get(),
                'message' => 'Found all micro blogs'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not find micro blogs'
            ], 404);
        }
    }

    public function showMyMicroBlogs(Request $request) {
        try {
            $user = $request->user();
            // dd($user);
            $blogs = MicroBlog::where('user_id', $user->id)->get();
            return response()->json([
                'data' => $blogs,
                'message' => 'Found all micro blogs'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not find micro blogs'
            ], 404);
        }
    }

    public function store(Request $request) {
        try {   
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'original_price' => 'required',
                'discounted_price' => 'required',
                'discount_url' => 'required|url|regex:/^https:\/\/.+$/',
            ],
            [
                'title.required' => 'Please provide a title',
                'description.required' => 'Please provide a description',
                'original_price.required' => 'Please provide the original price',
                'discounted_price.required' => 'Please provide the discounted price',
                'discount_url.required' => 'Please provide a deal or product url',
            ]);   

            $microblog = new Microblog();
             
            if($request->hasFile('image')){
                $file = $request->file('image');
                $extension = $file->extension();
                $name = 'Micro_blog_'.time().'.'.$extension;

                $destination = 'storage/microblogs';
                $file->move($destination, $name);
                $microblog->image_url = $name;
            }
            $microblog->category_id = $request->category_id;
            $microblog->title = $request->title;
            $microblog->description = $request->description;
            $microblog->start_date = $request->start_date;
            $microblog->end_date = $request->end_date;
            $microblog->original_price = $request->original_price;
            $microblog->discounted_price = $request->discounted_price;
            $microblog->user_id = $request->user()->id;
            $microblog->discount_url = $request->discount_url;
            // $microblog->discount_code = $request->discount_code;
            $microblog->save();
            return response()->json([
                'message' => 'Created micro blog successfully',
                'data' => $microblog
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not create micro blog',
                'error' => $exception->message
            ], 404);
        }
    }

    public function show(Request $request, $id) {
        $user = $request->user();
        $microblog = MicroBlog::where('id', $id)->first();
        // dd($user);
        if($microblog && $user) {
            $favourite = MicroBlogFavourite::where('micro_blog_id', $microblog->id)
                                    ->where('user_id', $user->id)
                                    ->first();
            if($favourite){
                $microblog->isFavourite = true;
            } else {
                $microblog->isFavourite = false;
            }
            
            return response()->json([
                'data' => $microblog,
                'message' => 'Found micro blog'
            ]);
        } else {
            return response()->json([
                'message' => 'Could not find micro blog'
            ], 404);
        }
    }

    public function update(Request $request, $id) {
        try {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'original_price' => 'required',
                'discounted_price' => 'required',
                'discount_url' => 'required',
            ],
            [
                'title.required' => 'Please provide a title',
                'description.required' => 'Please provide a description',
                'original_price.required' => 'Please provide the original price',
                'discounted_price.required' => 'Please provide the discounted price',
                'discount_url.required' => 'Please provide a deal or product url',
            ]);   

            $microblog = MicroBlog::where('id', $id)->first();
            if($request->hasFile('image')) {
                if($microblog->image_url) {
                    $fileName = 'storage/microblogs/'.$microblog->image_url;
                    unlink(realpath($fileName));
                }
                $file = $request->file('image');
                $extension = $file->extension();
                $name = 'Micro_blog_'.time().'.'.$extension;

                $destination = './storage/microblogs';
                $file->move($destination, $name);
                $microblog->image_url = $name;
            }

            $microblog->category_id = $request->category_id;
            $microblog->title = $request->title;
            $microblog->description = $request->description;
            $microblog->start_date = $request->start_date;
            $microblog->end_date = $request->end_date;
            $microblog->original_price = $request->original_price;
            $microblog->discounted_price = $request->discounted_price;
            $microblog->user_id = $request->user()->id;
            $microblog->discount_url = $request->discount_url;
            // $microblog->discount_code = $request->discount_code;

            $microblog->save();
            return response()->json([
                'message' => 'Updated micro blog successfully',
                'data' => $microblog
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not update micro blog',
                'error' => $exception->message
            ], 404);
        }
    }

    public function destroy($id) {
        try {
            $microblog = MicroBlog::where('id', $id)->first();
            if($microblog->image_url){
                $fileName = 'storage/microblogs/'.$microblog->image_url;
                unlink(realpath($fileName));
            }
            $microblog->delete();
            return response()->json([
                'message' => 'Deleted micro blog'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not delete micro blog',
            ], 404);
        }
    }
}
