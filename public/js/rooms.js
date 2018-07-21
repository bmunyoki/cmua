$(document).ready(function(){
	//alert("h");
	 //Get the csrf token for Laravel
    const token = $("#token").val();

	//Load details based on student email
    $("#email").on('change', function(){
        var email = $("#email").val();
        
        var formData = {'email':email, '_token':token};
        $.ajax({
            type        : 'POST',
            url         : '/selection-details',
            data        : formData,
            success     : function(data) {
                $(".appendage").html(data);
            }     
        })
    });
})