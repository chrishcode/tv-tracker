<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tinyshows</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link href='http://fonts.googleapis.com/css?family=Quicksand:400,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="{{ URL::asset('js/main.js') }}"></script>


    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/1-col-portfolio.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/sv_SE/sdk.js#xfbml=1&version=v2.4";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="logo navbar-brand" href="/timeline"><i class="fa fa-youtube-play"></i> Tinyshows</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <input id="search" class="search form-control" type="text" name="search" placeholder="Search for shows to follow..." autocomplete="off">
                        <i class="fa fa-search"></i>
                    </li>
                    <li>
                        <a href="#" class="myshows"><i class="fa fa-television"></i> My shows</a>
                    </li>
                    <li>
                        <a href="/logout"><i class="fa fa-power-off"></i> Sign Out</a>
                    </li>
                    <li>
                        <a href="#"><img class="img-circle avatar" src="{{ Auth::user()->avatarimg }}" alt="avatar">{{ Auth::user()->name }}</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    
    <div id="myshows">
        @foreach($followimgs as $followimg)
        @foreach($followimg as $tvRageId => $img)
            
        
        
            <a class="unfollow" href="unfollow/{{ $tvRageId }}">
                <img class="searchimg" src="{{ $img }}">
            </a>
            @endforeach
        @endforeach


    </div>
    <div class="container-fluid">
        <div class="row">
            <div id="results"></div>     
        </div>
    </div>


    <!-- Page Content -->
    <div class="container content">
        <div class="spinner">
          <div class="bounce1"></div>
          <div class="bounce2"></div>
          <div class="bounce3"></div>
        </div>
        
        <div class="col-md-3 sidebar">
            <div class="fb-page" data-href="https://www.facebook.com/facebook" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/facebook"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div></div>
        </div>
        <!-- episode-->
        @foreach($episodes as $episode)
        <div class="row">
            <div class="col-md-8 episode">
            <div class="col-md-2">
                <a href="#">
                    <img class="episodeimg img-responsive" src="{{ $episode['image'] }}" alt="">
                </a>
            </div>
            <div class="col-md-10">
                <h3>S{{ $episode['season'] }}E{{ $episode['episode'] }} - {{ $episode['episodename'] }} <span class="airdate">{{ $episode['airdate'] }}</span></h3>
                
                <p>{{ $episode['summary'] }}</p>
            </div>
            </div>
        </div>
        <!-- /.row -->
        @endforeach


        <!-- Pagination -->
        <div class="row text-center">
            <div class="col-lg-12">
                <a href="#">Show more</a>
            </div>
        </div>
        <!-- /.row -->




    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
