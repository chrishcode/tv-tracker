<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;
use App\Follow;

class FollowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $tvRageIds = Follow::where('userId', '=', Auth::user()->id)->get();
        
        $followimgs = array();
        $tempArray = array();
        
        foreach($tvRageIds as $follow) {
            $tvRageId = $follow['tvRageId'];
            
            $follows = file_get_contents("http://api.tvmaze.com/lookup/shows?tvrage=$tvRageId");
            $follows = json_decode($follows);
            
            $img = $follows->image->medium;
            
            $tempArray = array($tvRageId => $img);
            array_push($followimgs, $tempArray);
        }
            
        $followimgs = array_reverse($followimgs);
        
        
        
        //episode feed
        $episodes = array();
        $tempepisodes = array();
        
        for($i = 0; $i < 16; $i++) {
	        $date = date("Y-m-d",strtotime("-$i day"));
            $followfeed = file_get_contents("http://api.tvmaze.com/schedule?country=US&date=$date");
            $followfeed = json_decode($followfeed, true);

            foreach($tvRageIds as $tvRageId){
                foreach($followfeed as $episode) {
                    $pTags = array("<p>", "</p>", "<br />");
                    if($episode['show']['externals']['tvrage'] == $tvRageId->tvRageId) {
                        $tempepisodes = array('showname' => $episode['show']['name'],  'image' => $episode['show']['image']['medium'], 'episodename' => $episode['name'], 'season' => $episode['season'], 'episode' => $episode['number'], 'summary' => str_replace($pTags, '', $episode['summary']), 'airdate' => $episode['airdate']);

                        array_push($episodes, $tempepisodes);
                        
                    }
                }

            }
        
        }
        
        
//        return $episodes;
        return view('timeline', compact('followimgs', 'episodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store($tvRageId)
    {
        $follows = Follow::where('userId', '=', Auth::user()->id)->where('tvRageId', '=', $tvRageId)->first();
        
        if (is_null($follows)) {
            $follow = new Follow;
            $follow->userId = Auth::user()->id;
            $follow->tvRageId = $tvRageId;
            $follow->save();
        }
        

        return redirect('/timeline');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($tvRageId)
    {
        Follow::where('userId', '=', Auth::user()->id)->where('tvRageId', '=', $tvRageId)->delete();

        return redirect('timeline');
    }
}
