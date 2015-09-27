<!DOCTYPE html>
<html lang="en" ng-app="trakker">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<link href='{{ URL::asset("http://fonts.googleapis.com/css?family=Quicksand:400,700,300") }}' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link href='{{ URL::asset("https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css") }}' rel='stylesheet'>
	<link href='{{ URL::asset("css/main.css") }}' rel='stylesheet'>


    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
    <script type='text/javascript' src="{{ URL::asset('js/ng-infinite-scroll.min.js') }}"></script>
    <script src="{{ URL::asset('js/main.js') }}"></script>
    <script src="{{ URL::asset('js/angular.js') }}"></script>
</head>
<body>
	    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="logo navbar-brand" href="/timeline">trakker.tv</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <ul class="nav navbar-nav search-nav">
        	    <li>
                    <input id="search" class="search form-control" type="text" name="search" placeholder="Search for shows to follow..." autocomplete="off">
                    
                </li>
            </ul>
            
            <ul class="nav navbar-nav">
                <li>
                    <a href="#" class="myshows"><i class="fa fa-television"></i> <span>Following</span></a>
                </li>
                <li>
                    <a href="/logout"><i class="fa fa-sign-out"></i> Sign Out</a>
                </li>
                <li>
                    <a href="#" class="last"><img class="img-circle userimg" src="{{ Auth::user()->avatarimg }}" alt="avatar">{{ Auth::user()->name }}</a>
                </li>
            </ul>
        </div>
        <!-- /.container -->
    </nav>
	
    <div class="coverimg">
	    <div class="container">
	     	<h1>Welcome back {{ Auth::user()->name }}, it's tv show time!</h1>   	
	    </div>
    </div>

    <div class="container content">

    	<div class="feed" ng-controller="timelineController" infinite-scroll="loadMoreEpisodes()" infinite-scroll-distance="0">
            <ul class="timeline">
               <li ng-repeat="day in schedule">
                    <div ng-repeat="episode in day">
                        <div ng-repeat="tvRageId in tvRageIds">
                            <div ng-if="tvRageId.tvRageId == episode.show.externals.tvrage">
                                <div class="ep">
                                    <div class="img">
                                        <img class="episodeimg img-responsive" src="@{{episode.show.image.medium}}">
                                    </div>

                                    <div class="desc">
                                        <h3>@{{'Season ' + episode.season + ' Episode ' + episode.number + ' - ' + episode.name}}</h3>
                                        <p class="descairdate">@{{episode.airdate + ' | ' + episode.airtime + ' | ' + episode.show.network.name}}</p>
                                        <p class="descsummary">@{{episode.summary | htmlToPlaintext}}</p>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </li>

                <li ng-repeat="day in more">
                    <div ng-repeat="episode in day">
                        <div ng-repeat="tvRageId in tvRageIds">
                            <div ng-if="tvRageId.tvRageId == episode.show.externals.tvrage">
                                <div class="ep">
                                    <div class="img">
                                        <img class="episodeimg img-responsive" src="@{{episode.show.image.medium}}">
                                    </div>

                                    <div class="desc">
                                        <h3>@{{'Season ' + episode.season + ' Episode ' + episode.number + ' - ' + episode.name}}</h3>
                                        <p class="descairdate">@{{episode.airdate + ' | ' + episode.airtime + ' | ' + episode.show.network.name}}</p>
                                        <p class="descsummary">@{{episode.summary | htmlToPlaintext}}</p>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </li>  
            </ul>

            <div class="loading">
                <div class="sp sp-circle"></div>
                <p>Loading...</p>
            </div>
        </div>

		<div id="sidebar" class="sidebar">

			<div class="btn btn-default"><i class="fa fa-line-chart"></i> Popular tv shows</div>

            <div class="sidebarshow">
	                <div class="img">
	                    <img class="episodeimg img-responsive" width="50" src="img/epimg.jpg">
	                </div>

	                <div class="desc">
	                    <h3>Alcatraz</h3>
	                    <p class="descairdate">Action, Crime, Drama</p>
	                    <p class="descairdate">USA Network</p>
	            	</div>
	        </div>

	        <div class="sidebarshow">
	                <div class="img">
	                    <img class="episodeimg img-responsive" width="50" src="img/epimg.jpg">
	                </div>

	                <div class="desc">
	                    <h3>Alcatraz</h3>
	                    <p class="descairdate">Action, Crime, Drama</p>
	                    <p class="descairdate">USA Network</p>
	            	</div>
	        </div>

	        <div class="sidebarshow">
	                <div class="img">
	                    <img class="episodeimg img-responsive" width="50" src="img/epimg.jpg">
	                </div>

	                <div class="desc">
	                    <h3>Alcatraz</h3>
	                    <p class="descairdate">Action, Crime, Drama</p>
	                    <p class="descairdate">USA Network</p>
	            	</div>
	        </div>

	        <div class="sidebarshow">
	                <div class="img">
	                    <img class="episodeimg img-responsive" width="50" src="img/epimg.jpg">
	                </div>

	                <div class="desc">
	                    <h3>Alcatraz</h3>
	                    <p class="descairdate">Action, Crime, Drama</p>
	                    <p class="descairdate">USA Network</p>
	            	</div>
	        </div>

            <div class="footer">
                <ul>
                    <li>&copy; trakker.tv</li>
                    <li><a href="mailto:chris.wohlfarth@gmail.com">Contact</a></li>
                </ul>
            </div>
    	</div>

    </div>
</body>
</html>