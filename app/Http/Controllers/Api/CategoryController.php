<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

// add category image code

class CategoryController extends Controller
{
    public function index() {
        try {
            return response()->json([
                'data' => Category::all(),
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not find categories'
            ], 404);
        }
    }

    public function store(Request $request) {
        try {
            $request->validate([
                'category_name' => 'required',
            ],
            [
                'category_name.required' => 'Please provide a category name',
            ]); 

            $category = new Category();
            $category->category_name = $request->category_name;
            if($request->hasFile('image')){
                $file = $request->file('image');
                $extension = $file->extension();
                $name = 'Category_'.time().'.'.$extension;

                $destination = 'storage/categories';
                $file->move($destination, $name);
                $category->image_url = $name;
            }
            $category->save();
            return response()->json([
                'message' => 'Created category',
                'data' => $category
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not create category',
                'error' => $exception->message
            ],500);
        }
    }

    public function show($id) {
        try {
            $category = Category::where('id', $id)->first();
            if($category){
                return response()->json([
                    'message' => 'Found category',
                    'category' => $category
                ]);
            } else {
                return response()->json([
                    'message' => 'Could not find category',
                ],404);
            }
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not find category',
                'error' => $exception->message
            ],500);
        }
    }

    public function update(Request $request, $id) {
        try {
            $request->validate([
                'category_name' => 'required',
            ],
            [
                'category_name.required' => 'Please provide a category name',
            ]);
            $category = Category::where('id', $id)->first();
            $category-> category_name = $request->category_name;
            if($request->hasFile('image')) {
                if($category->image_url) {
                    $fileName = 'storage/categories/'.$category->image_url;
                    unlink(realpath($fileName));
                }
                $file = $request->file('image');
                $extension = $file->extension();
                $name = 'Category_'.time().'.'.$extension;

                $destination = './storage/categories';
                $file->move($destination, $name);
                $category->image_url = $name;
            }
            $category->save();
            return response()->json([
                'message' => 'Updated category',
                'category' => $category
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not update category',
                'error' => $exception->message
            ],500);
        }
    }

    public function destroy($id) {
        try {
            $category = Category::where('id', $id)->first();
            if($category->image_url) {
                $fileName = 'storage/categories/'.$category->image_url;
                unlink(realpath($fileName));
            }
            $category->delete();
            return response()->json([
                'message' => 'Deleted category',
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not delete category',
                'error' => $exception->message
            ],500);
        }
    }
}
