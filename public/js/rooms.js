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

    $(".login100-form-btn").click(function(){
    	//e.preventDefault();
    	var email = $("#email").val();
    	var room = $("input[name='rooms']:checked").val();

    	if($.trim(email) == 'Select'){
    		$(".errors").html('<span style="font-size: 16px; color: red; font-weight: 600">Select your email</span>')
    		return false;
    	}else if($.trim(room) == ''){
    		$(".errors").html('<span style="font-size: 16px; color: red; font-weight: 600">You have not picked a room</span>')
    		return false;
    	}else{
    		return true;
    	}
    })
})