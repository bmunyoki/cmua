$(document).ready(function(){
	var token = $("#token").val();

	$("#userStats").on('click', 'a#talent', function(e){
		e.preventDefault();
		var data = getStats('talent');
		if(data.success == 1){
			$("#userCount").html(data.total);
			$("#userHolder").html("Talents");
		}else{
			$("#userHolder").html("Error");
		}
	})


	function getStats(type){
        var formData = {'type':type, '_token':token};
        $.ajax({
            type        : 'POST',
            url         : '/backend/users/get-totals',
            data        : formData,
            success     : function(data) {
                return data;
            }      
        })
    }
})