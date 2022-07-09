$(".control--delete").click(function(){
    var eventId = $(this).attr("id");
    console.log(window.location);
    $.ajax(
        {
            //url: '/articles?Delete_ID=' + Delete_ID, //'@Url.Action("articles", "Base")?Delete_ID=' + Delete_ID, //'/articles?module=Base&action=articlesAction'
            //method: 'post',
            //data: {Del_ID:Delete_ID},
            // success: function(data){
            //     alert ("it works !");
            // }
            
            url: window.location.origin + "/deleteEvent",
            type: 'POST',
            data: {event_id:eventId},
            beforeSend: function () {//We add this before send to disable the button once we submit it so that we prevent the multiple click
		            
            },
            success: function(res){
                    console.log('Success !');
                    window.location.href = window.location.origin + "/event";
            }
            
        });
});