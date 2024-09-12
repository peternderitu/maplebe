<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\DealActivity;


class DealActivityController extends Controller
{
    public function index(Request $request) {
        // get  all records of the deal owner
        try {
            $user = $request->user();
            $deal_activities = DealActivity::whereHas('deal', function ($query) use ($user) {
                $query->where('deal_owner_id', $user->id);
            })->get();

            return response()->json([
                'data' => $deal_activities
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not find deal activity'
            ], 404);
        }
    }

    public function store(Request $request) {
        // When a deal is clicked by a user, we should store the user id and the deal id here.
        // if user had clicked on a deal before, then we can't record twice
        // One needs logged in user and deal id
        try {
            $request->validate([
                'deal_id' => 'required',
            ],
            [
                'deal_id.required' => 'Please provide a deal id',
            ]);
            $user = $request->user();
            $isDeal_activity = DealActivity::where('deal_id', $request->deal_id)
                                            ->where('user_id', $user->id)
                                            ->first();
            // dd($isDeal_activity);
            if(!$isDeal_activity){
                // no deal activity so someone can add
                $deal_activity = new DealActivity();
                $deal_activity->deal_id = $request->deal_id;
                $deal_activity->user_id = $user->id;
                $deal_activity->save();
                return response()->json([
                    'message' => 'Added deal activity',
                    'data' => $deal_activity
                ]);
            } else {
                return response()->json([
                    'message' => 'User has clicked this deal before',
                ]);
            }
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not add deal activity',
                'error' => $exception->message
            ], 404);
        }
    }

    public function show($id) {
        // Get the deal activity of a specific deal
        // $id here is the deal id
        $currentYear = date('Y');
    
        $clicks = DB::table('deal_activities')
            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as clicks'))
            ->where('deal_id', $id)
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        return response()->json($clicks);
    }

    public function update(Request $request, $id) {
        // not needed for now
    }

    public function destroy($id) {
        // not needed for now
    }
}
