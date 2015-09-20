var app = angular.module('trakker', []);


app.controller('timelineController', function($scope, $http) {

	//laddar in episoder för 2 dagar tillbaka i tiden
	$scope.loadEpisodes = function() {

		var array = [];

		for(var i = 0; i < 2; i++) {
			var today = new Date();
			today.setDate(today.getDate() - i);
			var date = today.toISOString().substring(0, 10); //rätt format
			
			$http.get("http://api.tvmaze.com/schedule?country=US&date=" + date).success(function(response) {
		    	array.push(response);
		    });
		}

		$scope.schedule = array;
	}

});




//Gör detta med angular

//Request till /timeline -> få tvrageids som json

// for($i = 0; $i < 7; $i++) {
//     $date = date("Y-m-d",strtotime("-$i day"));
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