<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favourite;
use App\Models\Deal;

class DealController extends Controller
{
    public function index() {
        try {
            return response()->json([
                'data' => Deal::with('category')->get()
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not find deals'
            ], 404);
        }
    }

    public function indexDO(Request $request) {
        try {
            $user = $request->user();
            $deal = Deal::where('deal_owner_id', $user->id)
                        ->with('category')->get();
            return response()->json([
                'data' => $deal
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not find deals'
            ], 404);
        }
    }

    public function indexAdmin(Request $request) {
        try {
            $user = $request->user();
            $deal = Deal::where('admin_id', $user->id)
                        ->where('isAffiliate', 0)
                        ->with('category')->get();
            return response()->json([
                'data' => $deal
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not find deals'
            ], 404);
        }
    }

    public function indexAffiliate(Request $request) {
        try {
            $deal = Deal::where('isAffiliate', 1)->with('category')->get();
            return response()->json([
                'data' => $deal
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not find deals'
            ], 404);
        }
    }

    public function store(Request $request) {
        try {   
            $request->validate([
                'category_id' => 'required',
                'title' => 'required',
                'description' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'original_price' => 'required',
                'discount' => 'required',
                'discount_code' => 'required_without:discount_url',
                'discount_url' => 'required_without:discount_code',
            ],
            [
                'category_id.required' => 'Please provide a category',
                'title.required' => 'Please provide a title',
                'description.required' => 'Please provide a description',
                'start_date.required' => 'Please provide a start date',
                'end_date.required' => 'Please provide an end date',
                'original_price.required' => 'Please provide the original price',
                'discount.required' => 'Please provide a discount value',
            ]);   

            $deal = new Deal();
            if($request->hasFile('image')){
                $file = $request->file('image');
                $extension = $file->extension();
                $name = 'Deal_'.time().'.'.$extension;

                $destination = 'storage/deals';
                $file->move($destination, $name);
                $deal->image_url = $name;
            }

            if($request->hasFile('logo')){
                $file = $request->file('logo');
                $extension = $file->extension();
                $name = 'Deal_Logo_'.time().'.'.$extension;

                $destination = 'storage/logos';
                $file->move($destination, $name);
                $deal->logo_url = $name;
            }

            $deal->brand_name = $request->brand_name;
            $deal->category_id = $request->category_id;
            $deal->title = $request->title;
            $deal->description = $request->description;
            $deal->start_date = $request->start_date;
            $deal->end_date = $request->end_date;
            $deal->original_price = $request->original_price;
            $deal->discount = $request->discount;
            $deal->discounted_price = $request->original_price - ($request->original_price * ($request->discount/100));
            $deal->deal_owner_id = $request->user()->id;
            $request->discount_code ?  $deal->discount_code = $request->discount_code : $deal->discount_url = $request->discount_url;
            $deal->save();
            return response()->json([
                'message' => 'Created deal successfully',
                'data' => $deal,
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not create deal',
                'error' => $exception->message
            ], 404);
        }
    }

    public function storeDealByAdmin(Request $request) {
        try {   
            $request->validate([
                'category_id' => 'required',
                'title' => 'required',
                'description' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'original_price' => 'required',
                'discount' => 'required',
                'discount_code' => 'required_without:discount_url',
                'discount_url' => 'required_without:discount_code',
            ],
            [
                'category_id.required' => 'Please provide a category',
                'title.required' => 'Please provide a title',
                'description.required' => 'Please provide a description',
                'start_date.required' => 'Please provide a start date',
                'end_date.required' => 'Please provide an end date',
                'original_price.required' => 'Please provide the original price',
                'discount.required' => 'Please provide a discount value',
            ]);   

            $deal = new Deal();
            if($request->hasFile('image')){
                $file = $request->file('image');
                $extension = $file->extension();
                $name = 'Deal_'.time().'.'.$extension;

                $destination = 'storage/deals';
                $file->move($destination, $name);
                $deal->image_url = $name;
            }

            if($request->hasFile('logo')){
                $file = $request->file('logo');
                $extension = $file->extension();
                $name = 'Deal_Logo_'.time().'.'.$extension;

                $destination = 'storage/logos';
                $file->move($destination, $name);
                $deal->logo_url = $name;
            }

            $deal->status = 1;
            $deal->title = $request->title;
            $deal->brand_name = $request->brand_name;
            $deal->category_id = $request->category_id;
            $deal->description = $request->description;
            $deal->start_date = $request->start_date;
            $deal->end_date = $request->end_date;
            $deal->original_price = $request->original_price;
            $deal->discount = $request->discount;
            $deal->discounted_price = (100 - $request->discount) / 100 * $request->original_price;
            $deal->admin_id = $request->user()->id;
            $request->discount_code ?  $deal->discount_code = $request->discount_code : $deal->discount_url = $request->discount_url;
            $deal->save();
            return response()->json([
                'message' => 'Created deal successfully',
                'data' => $deal
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not create deal',
                'error' => $exception->message
            ], 404);
        }
    }

    public function storeAffiliate(Request $request) {
        try {
            $request->validate([
                'category_id' => 'required',
                'title' => 'required',
                'description' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'original_price' => 'required',
                'discount' => 'required',
                'discount_code' => 'required_without:discount_url',
                'discount_url' => 'required_without:discount_code',
            ],
            [
                'category_id.required' => 'Please provide a category',
                'title.required' => 'Please provide a title',
                'description.required' => 'Please provide a description',
                'start_date.required' => 'Please provide a start date',
                'end_date.required' => 'Please provide an end date',
                'original_price.required' => 'Please provide the original price',
                'discount.required' => 'Please provide a discount value',
            ]);   

            // dd($request);
            $deal = new Deal();
            if($request->hasFile('image')){
                $file = $request->file('image');
                $extension = $file->extension();
                $name = 'Deal_'.time().'.'.$extension;

                $destination = 'storage/deals';
                $file->move($destination, $name);
                $deal->image_url = $name;
            }

            if($request->hasFile('logo')){
                $file = $request->file('logo');
                $extension = $file->extension();
                $name = 'Deal_Logo_'.time().'.'.$extension;

                $destination = 'storage/logos';
                $file->move($destination, $name);
                $deal->logo_url = $name;
            }

            $deal->category_id = $request->category_id;
            $deal->brand_name = $request->brand_name;
            $deal->title = $request->title;
            $deal->description = $request->description;
            $deal->start_date = $request->start_date;
            $deal->end_date = $request->end_date;
            $deal->original_price = $request->original_price;
            $deal->discount = $request->discount;
            $deal->discounted_price = (100 - $request->discount) / 100 * $request->original_price;
            $deal->admin_id = $request->user()->id;
            $request->discount_code ?  $deal->discount_code = $request->discount_code : $deal->discount_url = $request->discount_url;
            $deal->isAffiliate = 1;
            $deal->status = 1;
            $deal->save();
            return response()->json([
                'message' => 'Created affiliate link successfully',
                'data' => $deal
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not create deal',
                'error' => $exception->message
            ], 404);
        }
    }

    public function show(Request $request, $id) {
        $deal = Deal::where('id', $id)->with('category')->first();
        if($deal) {
            return response()->json([
                'data' => $deal,
                'message' => 'Found deal'
            ]);
        } else {
            return response()->json([
                'message' => 'Could not find deal'
            ], 404);
        }
    }

    public function showWithFavourite(Request $request, $id) {
        $user = $request->user();
        $deal = Deal::where('id', $id)->first();
        if($deal) {
            if ($user) {
                $favourite = Favourite::where('deal_id', $deal->id)
                                        ->where('user_id', $user->id)
                                        ->first();
                if($favourite){
                    $deal->isFavourite = true;
                } else {
                    $deal->isFavourite = false;
                }
                return response()->json([
                    'data' => $deal,
                    'message' => 'Found deal'
                ]);
            } else {
                return response()->json([
                    'data' => $deal,
                    'message' => 'Found deal'
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Could not find deal'
            ], 404);
        }
    }

    public function update(Request $request, $id) {
        try {
            $request->validate([
                'category_id' => 'required',
                'title' => 'required',
                'description' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'original_price' => 'required',
                'discount' => 'required',
            ],
            [
                'category_id.required' => 'Please provide a category',
                'title.required' => 'Please provide a title',
                'description.required' => 'Please provide a description',
                'start_date.required' => 'Please provide a start date',
                'end_date.required' => 'Please provide an end date',
                'original_price.required' => 'Please provide the original price',
                'discount.required' => 'Please provide a discount value',
            ]);   
            $deal = Deal::where('id', $id)->first();
            if($request->hasFile('image')) {
                if($deal->image_url) {
                    $fileName = 'storage/deals/'.$deal->image_url;
                    unlink(realpath($fileName));
                }
                $file = $request->file('image');
                $extension = $file->extension();
                $name = 'Deal_'.time().'.'.$extension;

                $destination = './storage/deals';
                $file->move($destination, $name);
                $deal->image_url = $name;
            }

            if($request->hasFile('logo')){
                if($deal->logo_url) {
                    $fileName = 'storage/logos/'.$deal->logo_url;
                    unlink(realpath($fileName));
                }
                $file = $request->file('logo');
                $extension = $file->extension();
                $name = 'Deal_Logo_'.time().'.'.$extension;

                $destination = 'storage/logos';
                $file->move($destination, $name);
                $deal->logo_url = $name;
            }

            $deal->brand_name = $request->brand_name;
            $deal->category_id = $request->category_id;
            $deal->title = $request->title;
            $deal->description = $request->description;
            $deal->start_date = $request->start_date;
            $deal->end_date = $request->end_date;
            $deal->original_price = $request->original_price;
            $deal->discount = $request->discount;
            $deal->discounted_price = (100 - $request->discount) * $request->original_price;
            $request->discount_code !== 'null' ?  $deal->discount_code = $request->discount_code : $deal->discount_url = $request->discount_url;
            $deal->save();
            return response()->json([
                'message' => 'Updated deal successfully',
                'data' => $deal
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not update deal',
                'error' => $exception->message
            ], 404);
        }
    }

    public function destroy($id) {
        try {
            $deal = Deal::where('id', $id)->first();
            if($deal->image_url){
                $fileName = 'storage/deals/'.$deal->image_url;
                unlink(realpath($fileName));
            }
            $deal->delete();
            return response()->json([
                'message' => 'Deleted deal'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not delete deal',
            ], 404);
        }
    }

    public function deleteImg() {
        // unlink(storage_path('public/storage/deals/Deal_1708519967jpg'));
        // Storage::delete("storage/deals/Deal_1708519967jpg");
        $fileName = 'storage/deals/Deal_1708525109.jpg';
        unlink(realpath($fileName));
        return response()->json([
            'message' => 'success'
        ]);
    }

    public function approve($id) {
        try {
            $deal = Deal::where('id', $id)->first();
            $deal->status = 1;
            $deal->save();
            return response()->json([
                'message' => 'Deal approved',
                'data' => $deal
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not approved deal'
            ], 404);
        }
    }

    public function reject($id) {
        try {
            $deal = Deal::where('id', $id)->first();
            $deal->status = 3;
            $deal->save();
            return response()->json([
                'message' => 'Deal rejected',
                'data' => $deal
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not reject deal'
            ], 404);
        }
    }
}