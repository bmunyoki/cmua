$('#changePassword').click(function(e){
    e.preventDefault();
    var token = $('#token').val();
    var oldPass = $('#oldPass').val();
    var newPass = $('#newPass').val();
    var confirmPass = $('#confirmPass').val();

    if($.trim(oldPass) == ''){
        $('.response').html('<span style="font-size: 16px; color: red; font-weight: 600">Old password is required</span>');
    }else if($.trim(newPass) != $.trim(confirmPass)){
        $('.response').html('<span style="font-size: 16px; color: red; font-weight: 600">New passwords do not match</span>');
    }else{
        var formData = { 'oldPass':oldPass, 'newPass':newPass, 'confirmPass':confirmPass, '_token':token };
        $.ajax({
            type        : 'POST',
            url         : '/auth/change-password',
            data        : formData,
            success     : function(data) {
                if (data.res == 0) {
                    $(".response").html('<span style="font-size: 16px; color: red; font-weight: 600">'+data.message+'</span>');
                } else {
                    $(".response").html('<span style="font-size: 16px; color: green; font-weight: 600">'+data.message+'</span>');
                    setTimeout(function(){
                        window.location.replace(data.redirect);
                    }, 2000);
                }
            }     
        })
    }

});