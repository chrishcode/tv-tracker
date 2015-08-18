$(document).ready(function() {
    $('.myshows').click(function() {
        if($('#myshows').height() == 300) {
            $('#myshows').animate({height: '0px'}, 200); 
        }
        else{
            $('#myshows').animate({height: '300px'}, 200);            
        }

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
                    output += '<a href="timeline/follow"><img class="img-responsive searchimg" src="'+val.show.image.medium+'" alt="'+ val.show.name +'" /></a>';
                    var tvRageId = val.show.externals.tvrage;
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