$(".control--delete").click(function(){
    var categoryId = $(this).attr("id");
    console.log(window.location);
    $.ajax(
        {
            //url: '/articles?Delete_ID=' + Delete_ID, //'@Url.Action("articles", "Base")?Delete_ID=' + Delete_ID, //'/articles?module=Base&action=articlesAction'
            //method: 'post',
            //data: {Del_ID:Delete_ID},
            // success: function(data){
            //     alert ("it works !");
            // }
            
            url: window.location.origin + "/deleteCategorie",
            type: 'POST',
            data: {category_id:categoryId},
            beforeSend: function () {//We add this before send to disable the button once we submit it so that we prevent the multiple click
		            
            },
            success: function(res){
                    console.log('Success !');
                    window.location.href = window.location.origin + "/categorie";
            }
            
        });
});