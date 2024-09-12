<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MicroBlogReport;
use Illuminate\Http\Request;

class MicroBlogReportController extends Controller
{
    //
    public function index() {
        try {
            return response()->json([
                'data' => MicroBlogReport::with('reporting_reason')->with('micro_blog')->get(),
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not find micro blog reports'
            ], 404);
        }
    }

    // this should store 'micro_blogs_id', 'reporting_reasons_id' and 'reason' if other was selected
    public function store(Request $request) {
        try {
            $request->validate([
                'micro_blogs_id' => 'required',
                'reporting_reasons_id' => 'required',
            ],
            [
                'micro_blogs_id.required' => 'Please provide a micro blog/community deal id',
                'reporting_reasons_id.required' => 'Please provide a reason',//when there is no id, it should be populated with 'other'
            ]); 

            $micro_blog_report = new MicroBlogReport();
            $micro_blog_report->micro_blogs_id = $request->micro_blogs_id;
            if($request->reason){
                $micro_blog_report->reason = $request->reason;
            } else {
                $micro_blog_report->reporting_reasons_id = $request->reporting_reasons_id;
            }
            
            $micro_blog_report->save();
            return response()->json([
                'message' => 'Added micro blog report',
                'data' => $micro_blog_report
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not add micro blog report',
                'error' => $exception->message
            ],500);
        }
    }

    public function show($id) {
        try {
            $micro_blog_report = MicroBlogReport::where('id', $id)->with('micro_blog')->with('reporting_reason')->first();
            if($micro_blog_report){
                return response()->json([
                    'message' => 'Found micro blog/community deal report',
                    'micro_blog_report' => $micro_blog_report
                ]);
            } else {
                return response()->json([
                    'message' => 'Could not find micro blog/community deal report',
                ],404);
            }
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not find micro blog/community deal report',
                'error' => $exception->message
            ],500);
        }
    }

    // will this use the micro blog report id or the community deal id?
    public function update(Request $request, $id) {
        try {
            $request->validate([
                'micro_blogs_id' => 'required',
                'reporting_reasons_id' => 'required',
            ],
            [
                'micro_blogs_id.required' => 'Please provide a micro blog/community deal id',
                'reporting_reasons_id.required' => 'Please provide a reason',//when there is no id, it should be populated with 'other'
            ]); 

            $micro_blog_report = MicroBlogReport::where('id', $id)->first();
            $micro_blog_report->micro_blogs_id = $request->micro_blogs_id;
            if($request->reason){
                $micro_blog_report->reason = $request->reason;
            } else {
                $micro_blog_report->reporting_reasons_id = $request->reporting_reasons_id;
            }
            
            $micro_blog_report->save();
            return response()->json([
                'message' => 'Updated micro blog report',
                'micro_blog_report' => $micro_blog_report
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not update micro blog report',
                'error' => $exception->message
            ],500);
        }
    }

    public function destroy($id) {
        try {
            $micro_blog_report = MicroBlogReport::where('id', $id)->first();
            
            $micro_blog_report->delete();
            return response()->json([
                'message' => 'Deleted micro blog report',
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Could not delete micro blog report',
                'error' => $exception->message
            ],500);
        }
    }
}
