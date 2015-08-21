$(document).ready(function() {
    
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
        
        $('#results').hide();
        if($('#myshows').height() > 1) {
            $('#myshows').animate({height: '0px'}, 200); 
        }
        else{
            $('#myshows').animate({height: $("#myshows").get(0).scrollHeight}, 200); 
        }

    });
    
    $('#search').focusin(function() {
        $('#search').css('border-color', '#e1e8ed');
        $('#search').css('box-shadow', 'none');
        $('#search').css('background-color', '#ffffff');
        $('#myshows').animate({height: '0px'}, 200);
    });
    
    $('#search').focusout(function() {
        $('#search').css('background-color', '#f5f8fa');
    });
    

        
    $('#search').keyup(function(){
        if($('#results').children().length > 0) {
            $('#results').show();
        }
        else {
            $('#results').hide();
        }
        
        var searchField = $('#search').val();
        var regex = new RegExp(searchField, "i");
        var output = '';
        var count = 1;
        
        
        $.getJSON('http://api.tvmaze.com/search/shows?q=' + searchField, function(data) {
            $.each(data, function(key, val){
                if ((val.show.name.search(regex) != -1)) {
                    var tvRageId = val.show.externals.tvrage;
                    output += '<a class="follow" href="/follow/' + tvRageId + '">' + '<img class="img-responsive searchimg" src="'+val.show.image.medium+'" alt="'+ val.show.name +'" /></a>';
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