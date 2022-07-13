$(".control--delete").click(function(){
    var ForumId = $(this).attr("id");
    //console.log(window.location);
    $.ajax(
        {
            url: window.location.origin + "/admin/delete",
            type: 'POST',
            data: {forum_id:ForumId},
            beforeSend: function () {//We add this before send to disable the button once we submit it so that we prevent the multiple click
		            
            },
            success: function(res){
                    console.log('Success !');
                    window.location.href = window.location.origin + "/admin/forums";
            }
            
        });
});