<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favourite;
use App\Models\Deal;

class FavouriteController extends Controller
{
    public function index(Request $request) {
        // get all the favourites of the logged in user
        $user = $request->user();
        $favourites = Favourite::with('deal')->where('user_id', $user->id)->get();
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
        // add a favourite - you need the deal id and the user id of the logged in user
        try {
            $request->validate([
                'deal_id' => 'required'
            ], 
            [
                'deal_id.required' => 'Please provide the deal id'
            ]);
            $user = $request->user();
            if(!$user){
                return response()->json([
                    'message' => 'User not logged in'
                ]);
            } else {
                $favourite = new Favourite();
                $favourite->deal_id = $request->deal_id;
                $favourite->user_id = $user->id;
                $favourite->save();
                $deal = Deal::where('id', $request->deal_id)->first();
                $deal->isFavourite = true;
                return response()->json([
                    'message' => 'Deal favourited',
                    'data' => $deal
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
            $favourite = Favourite::where('user_id', $user->id)
                                    ->where('deal_id', $id)
                                    ->first();
            $favourite->delete();
            return response()->json([
                'message' => 'Removed deal as favourite',
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not delete favourite',
                'error' => $exception->message
            ],500);
        }
    }
}