<?php

namespace App\Http\Controllers;

use App\Campaign;

use Illuminate\Http\Request;

class CampaignController extends Controller
{

    protected $campaigns;

    public function __construct(Campaign $campaign)
    {
        $this->campaigns = $campaign;

        /*$this->middleware('auth', ['except' => [
            'show',
            'showBySlug',
        ]]);*/
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = $this->campaigns
            ->whereCreatedBy(\Auth::user()->id)
            ->get();

        return response()->json(['campaigns' => $campaigns]);
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
        //\Log::info($request->all());

        if($this->exists($request->release_spotify_id)){
            abort(501, 'There is already a campaign for this album');
        }

        $artist = \App\Artist::firstOrCreate([
            'spotify_id' => $request->artist['id'],
            'name' => $request->artist['name'],
            'image' => $request->artist['images'][0]['url']
            ]);

        $campaign = new $this->campaigns;
        $campaign->release_title = $request->release_title;
        $campaign->slug = $request->slug;
        $campaign->release_spotify_id = $request->release_spotify_id;
        $campaign->description = $request->description;
        $campaign->release_artwork = $request->release_artwork;
        $campaign->background_image = $request->background_image;
        $campaign->release_date = \Carbon\Carbon::parse($request->release_date);
        $campaign->created_by = \Auth::user()->id;

        $campaign->artist()->associate($artist);

        $campaign->save();

        return $campaign;
    }

    public function exists($spotifyId)
    {
        return $this->campaigns->whereReleaseSpotifyId($spotifyId)->exists();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {   
        $campaign = $this->campaigns->with('artist')->findOrFail($id);

        if ($request->wantsJson()){
            return response()->json(['campaign' => $campaign]);
        }
        
        return view('campaigns.show', compact('campaign'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showBySlug($slug)
    {
        $campaign = $this->campaigns->whereSlug($slug)->firstOrFail();
        
        return view('campaigns.show', compact('campaign'));

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
        $campaign = $this->campaigns->findOrFail($id);

        $campaign->release_title = $request->release_title;
        $campaign->slug = $request->slug;
        $campaign->release_spotify_id = $request->release_spotify_id;
        $campaign->description = $request->description;
        $campaign->release_artwork = $request->release_artwork;
        $campaign->background_image = $request->background_image;
        $campaign->release_date = \Carbon\Carbon::parse($request->release_date);
        //$campaign->created_by = \Auth::user()->id;
        
        if($request->artist['spotify_id'] !== $campaign->artist->spotify_id){
            $artist = \App\Artist::firstOrCreate([
                'spotify_id' => $request->artist['id'],
                'name' => $request->artist['name'],
                'image' => $request->artist['images'][0]['url']
                ]);

            $campaign->artist()->associate($artist);
        }
        
        $campaign->save();

        return $campaign;
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

    public function handleFileUpload(Request $request)
    {
        if ($request->hasFile('file')) {
            $files = [];
            //foreach($request->file as $file){
                
                $file = $request->file;
                $mimeType = $file->getMimeType();
                $filename = santizeFileName( $file->getClientOriginalName() );
                $upload_success = $file->move('uploads', $filename);
                if($upload_success){
                    $files[] = [
                        'name' => $filename,
                        'mimeType' => $mimeType,
                        'path' => 'uploads'
                    ];
                }
            //}
        
            return response()->json(['files' => $files]);
        }
    }
}
