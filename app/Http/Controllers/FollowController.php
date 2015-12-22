<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests;
use App\Http\Controllers\Controller;

use Cache;
use App\User;
use Auth;
use App\Follow;
use DB;

class FollowController extends Controller
{
    //Get all the the tv shows a user is following
    public function tvRageIds()
    {
        $tvRageIds = Follow::where('userId', '=', Auth::user()->id)->get();

        return $tvRageIds;
    }

    // Get the 10 most followed tv shows by all users
    public function getPopularShows()
    {
        $popularShows = Follow::groupBy('tvRageId')->orderBy('follow_count', 'desc')->take(10)->get(['tvRageId', DB::raw('count(tvRageId) as follow_count')]);

        return $popularShows;
    }

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



        // //episode feed
        // $episodes = array();
        // $tempepisodes = array();


        // for($i = 0; $i < 0; $i++) {
	       //  $date = date("Y-m-d",strtotime("-$i day"));
        //     $followfeed = file_get_contents("http://api.tvmaze.com/schedule?country=US&date=$date");
        //     $followfeed = json_decode($followfeed, true);

        //     foreach($tvRageIds as $tvRageId){
        //         foreach($followfeed as $episode) {
        //             $pTags = array("<p>", "</p>", "<br />");
        //             if($episode['show']['externals']['tvrage'] == $tvRageId->tvRageId) {
        //                 $tempepisodes = array('showname' => $episode['show']['name'],  'image' => $episode['show']['image']['medium'], 'episodename' => $episode['name'], 'season' => $episode['season'], 'episode' => $episode['number'], 'summary' => str_replace($pTags, '', $episode['summary']), 'airdate' => $episode['airdate']);

        //                 array_push($episodes, $tempepisodes);

        //             }
        //         }

        //     }

        // }

//        return $episodes;
        return view('timeline', compact('followimgs', 'tvRageIds'));
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
        if($tvRageId != 'null') {
            $follows = Follow::where('userId', '=', Auth::user()->id)->where('tvRageId', '=', $tvRageId)->first();

            if (is_null($follows)) {
                $follow = new Follow;
                $follow->userId = Auth::user()->id;
                $follow->tvRageId = $tvRageId;
                $follow->save();
            }
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
