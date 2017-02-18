<?php

namespace App\Http\Controllers;

use App\Campaign;

use Illuminate\Http\Request;

class CampaignController extends Controller
{

    protected $camnpaigns;

    public function __construct(Campaign $campaign)
    {
        $this->campaigns = $campaign;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Campaign $campaign)
    {
        return view('campaigns/createOrUpdate', compact('campaign'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Log::info($request->all());

        if($this->exists($request->album_spotify_id)){
            abort(501, 'There is already a campaign for this album');
        }

        $artist = \App\Artist::firstOrCreate([
            'spotify_id' => $request->artist['id'],
            'name' => $request->artist['name'],
            'image' => $request->artist['images'][0]['url']
            ]);

        $campaign = new $this->campaigns;
        $campaign->album_title = $request->album_title;
        $campaign->album_spotify_id = $request->album_spotify_id;
        $campaign->description = $request->description;
        $campaign->created_by = \Auth::user()->id;

        $campaign->artist()->associate($artist);

        $campaign->save();
    }

    public function exists($spotifyId)
    {
        return $this->campaigns->whereAlbumSpotifyId($spotifyId)->exists();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showBySlug($slug)
    {
        $campaign = $this->campaigns->whereSlug($slug)->first();

        dd($campaign);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
