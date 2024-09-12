<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;
use App\Models\ZAccessToken;

class RefreshZAccessToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:zAccessToken';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This refreshes the z access token after every hour';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $zAccessToken = ZAccessToken::where('id', 1)->first(); 
        if($zAccessToken){
           // use api to refresh the token 
           $response = Http::post('https://accounts.zoho.com/oauth/v2/token?refresh_token='.$zAccessToken->refresh_token.'&client_id='.env('ZOHO_CLIENT_ID').'&client_secret='.env('ZOHO_CLIENT_SECRET').'&grant_type=refresh_token');

        //    \Log::info($response);

            $zAccessToken->access_token = $response['access_token'];
            if (isset($response['refresh_token'])) $zAccessToken->refresh_token = $response['refresh_token'];

            $zAccessToken->save();
        }  
        //  else {
            // \Log::info('Could not find refresh token!');
        // }                        
        return 0;
    }
}
