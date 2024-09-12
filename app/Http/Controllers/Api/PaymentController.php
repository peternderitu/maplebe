<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    
    public function index(Request $request) {
        try {
            $user = $request->user();
            return response()->json([
                'data' => Payment::where('deal_owner_id', $user->id)->with('deal')->get(),
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not find payments of this user'
            ], 404);
        }
    }

    public function store(Request $request) {

    }

    public function show($id) {

    }

    public function update(Request $request, $id) {

    }

    public function destroy($id) {

    }
}
