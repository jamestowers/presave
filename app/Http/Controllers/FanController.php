<?php

namespace App\Http\Controllers;

use App\Fan;
use App\Campaign;
use Illuminate\Http\Request;

class FanController extends Controller
{

    public function followCampaign(Request $request)
    {
        $accessToken = $this->getTokenFromHeader($request);
        $fan = Fan::where('access_token', $accessToken)->firstOrFail();

        $campaign = Campaign::findOrFail($request->campaignId);

        if(!$fan->campaigns->contains($campaign->id)){
            $fan->campaigns()->attach($campaign->id);
        }

        if(!$fan->artists->contains($campaign->artist->id)){
            $fan->artists()->attach($campaign->artist->id, ['mailing_list_opt_in' => $request->has('mailing_list')]);
        }

        return response()->json(['fan' => $fan, 'campaign' => $campaign]);
    }

    private function getTokenFromHeader(Request $request)
    {
        $header = $request->header('Authorization');
        $token = trim(str_ireplace('Bearer', '', $header));

        return $token;
    }
}
