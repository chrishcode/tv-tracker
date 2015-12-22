$(document).ready(function() {

    // var $sidebar   = $("#sidebar"),
    // $window    = $(window),
    // offset     = $sidebar.offset(),
    // topPadding = 70;

    // $window.scroll(function() {
    //     if ($window.scrollTop() > offset.top) {
    //         $sidebar.stop().animate({
    //             marginTop: $window.scrollTop() - offset.top + topPadding
    //         });
    //     } else {
    //         $sidebar.stop().animate({
    //             marginTop: 0
    //         });
    //     }
    // });

    $('.logo').click(function() {
        $('.spinner').show();
    });

    $('.unfollow').click(function() {
        $('.spinner').show();
    });



    $(document).ajaxComplete(function(){
        $('.follow').click(function() {
            $('.spinner').show();
        });
    });



    $('.myshows').click(function() {

        // $('#results').hide();
        if ($('#myshows').is(':hidden')) {
            $('.myshows').css({'border-color': '#dd9696', 'background-color': '#dd9696', 'color': '#ffffff'});
            $('#myshows').fadeIn(250);
        }
        else {
            $('.myshows').css({'border-color': '#eceef0', 'background-color': '#f6f6f6', 'color': '#4c5962'});
            $('#myshows').fadeOut(250);
        }

        // if($('#myshows').height() > 1) {
        //     $('#myshows').animate({height: '0px'}, 200);
        // }
        // else{
        //     $('#myshows').animate({height: $("#myshows").get(0).scrollHeight}, 200);
        // }

    });

    $('#search').focusin(function() {
        $('.myshows').css({'border-color': '#eceef0', 'background-color': '#f6f6f6', 'color': '#4c5962'});
        $('#myshows').fadeOut(250);

        $('#search').css('box-shadow', 'none');
        $('#search').css('background-color', '#edeff1');
        // $('#myshows').animate({height: '0px'}, 200);
        $('#results').fadeIn(250);
        $('#resultswrap').fadeIn(250);
        $('.coverimg h1').hide();
    });

    $('#search').focusout(function() {
        $('#search').css('background-color', '#e9eaeb');
        $('#results').fadeOut(250);
        $('#resultswrap').fadeOut(250);
        $('.coverimg h1').delay(100).show(0);
    });

    $('#search').keyup(function(){
        if($('#results').children().length > 0) {
            // $('.coverimg h1').hide();
        }
        else {

        }

        var searchField = $('#search').val();
        var regex = new RegExp(searchField, "i");
        var output = '';
        var count = 1;


        $.getJSON('http://api.tvmaze.com/search/shows?q=' + searchField, function(data) {
            $.each(data, function(key, val){
                if ((val.show.name.search(regex) != -1)) {
                    var tvRageId = val.show.externals.tvrage;
                    output += '<a class="follow" title="Follow" href="/follow/' + tvRageId + '">' + '<img class="img-responsive searchimg" src="'+val.show.image.medium+'" alt="'+ val.show.name +'" /></a>';
                    var tvRageName = val.show.name;
                    var status = val.show.status;

                    if(count%2 == 0){
                        output += '</div>'
                    }
                    count++;
                    output += '';
                }
            });

            $('#results').html(output);
        });

    });
});
