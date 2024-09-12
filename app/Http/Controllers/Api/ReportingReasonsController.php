<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ReportingReason;
use Illuminate\Http\Request;

class ReportingReasonsController extends Controller
{
    //
    public function index() {
        try {
            return response()->json([
                'data' => ReportingReason::all(),
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not find reporting reasons'
            ], 404);
        }
    }

    public function store(Request $request) {
        try {
            $request->validate([
                'name' => 'required',
            ],
            [
                'name.required' => 'Please provide a reporting reason',
            ]); 

            $reporting_reason = new ReportingReason();
            $reporting_reason->name = $request->name;
            
            $reporting_reason->save();
            return response()->json([
                'message' => 'Added reporting reason',
                'data' => $reporting_reason
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not add reporting reason',
                'error' => $exception->message
            ],500);
        }
    }

    public function show($id) {
        try {
            $reporting_reason = ReportingReason::where('id', $id)->first();
            if($reporting_reason){
                return response()->json([
                    'message' => 'Found reporting reason',
                    'reporting_reason' => $reporting_reason
                ]);
            } else {
                return response()->json([
                    'message' => 'Could not find reporting reason',
                ],404);
            }
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not find reporting reason',
                'error' => $exception->message
            ],500);
        }
    }

    public function update(Request $request, $id) {
        try {
            $request->validate([
                'name' => 'required',
            ],
            [
                'name.required' => 'Please provide a reporting reason',
            ]); 
            $reporting_reason = ReportingReason::where('id', $id)->first();
            $reporting_reason->name = $request->name;
            
            $reporting_reason->save();
            return response()->json([
                'message' => 'Updated reporting reason',
                'reporting_reason' => $reporting_reason
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not update reporting reason',
                'error' => $exception->message
            ],500);
        }
    }

    public function destroy($id) {
        try {
            $reporting_reason = ReportingReason::where('id', $id)->first();
            
            $reporting_reason->delete();
            return response()->json([
                'message' => 'Deleted reporting reason',
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not delete reporting reason',
                'error' => $exception->message
            ],500);
        }
    }
}