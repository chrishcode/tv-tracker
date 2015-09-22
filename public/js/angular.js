var app = angular.module('trakker', ['infinite-scroll']);


//filtrerar bort html taggar
app.filter('htmlToPlaintext', function() {
    return function(text) {
      return  text ? String(text).replace(/<[^>]+>/gm, '') : '';
    };
  }
);


app.controller('timelineController', function($scope, $http) {

	//laddar in episoder för 7 dagar tillbaka i tiden

	$http.get("http://localhost:8000/tvrageids").success(function(response) {
    	$scope.tvRageIds = response;
    });


	setTimeout(function() {
		var array = [];

		for(var i = 0; i < 7; i++) {
			var today = new Date();
			today.setDate(today.getDate() - i);
			var date = today.toISOString().substring(0, 10); //rätt format
			
			$http.get("http://api.tvmaze.com/schedule?country=US&date=" + date).success(function(response) {
		    	array.push(response);
		    });
		}

		$scope.schedule = array;

	}, 300);


	//laddar fler episoder (för 7 dagar till)

	var moreArray = [];
	var count = 0; //räknar antal veckor tillbaka
	var iStart = 0;
	var iStop = 0;

	$scope.loadMoreEpisodes = function() {

		count++;
		iStart = count * 7;
		iStop = iStart + 7;
		for(var i = iStart; i < iStop; i++) {
			var today = new Date();
			today.setDate(today.getDate() - i);
			var date = today.toISOString().substring(0, 10); //rätt format
			
			$http.get("http://api.tvmaze.com/schedule?country=US&date=" + date).success(function(response) {
		    	moreArray.push(response);
		    });
		}

		$scope.more = moreArray;
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