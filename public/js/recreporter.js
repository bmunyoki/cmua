$(document).ready(function(){
    //Get the csrf token for Laravel
    const token = $("#token").val();
    //alert('l');


    //Load user details for editing
    $('.users').on('click', 'a.editUser', function(){
        var userId = $(this).attr("data-code");
        //$('#userDetails').html(userId);
        var formData = {'userId':userId, '_token':token};

        $.ajax({
            type        : 'POST',
            url         : '/users/details',
            data        : formData,
            success     : function(data) {
                if (data.res == 1) {
                    //Success
                    $('#userDetails').html(data.details);
                } else {
                    //Failed
                    $('#userDetails').html(data.message);
                } 
            }      
        })
    });

    


    //Create an admin
    $("#addAdmin").click(function(e){
        e.preventDefault();
        var fName = $("#fname").val();
        var lName = $("#lname").val();
        var email = $("#email").val();
        var phone = $("#intPhone").val();
        var device = $("#device").val();

        var isValid = $("#intPhone").intlTelInput("isValidNumber");

        if ($.trim(fName) == ''){
            $(".response").html('<span style="font-size: 16px; color: red; font-weight: 600">First name is required</span>');
        } else if ($.trim(lName) == ''){
            $(".response").html('<span style="font-size: 16px; color: red; font-weight: 600">Last name is required</span>');
        } else if ($.trim(email) == '' || !validateEmail(email)) {
            $(".response").html('<span style="font-size: 16px; color: red; font-weight: 600">Invalid email</span>');
        } else if (!isValid){
            $(".response").html('<span style="font-size: 16px; color: red; font-weight: 600;">Invalid phone number</span>');
        } else {
            var formData = { 'fName':fName, 'lName':lName, 'phone':phone, 'email':email, 'device':device, '_token':token };
            $.ajax({
                type        : 'POST',
                url         : '/users/add/admin',
                data        : formData,
                success     : function(data) {
                    if (data.res == 0) {
                        swal("Failed!", data.message, "warning")
                    } else {
                        swal({
                            title: "Success!",
                            text: data.message,
                            type: "success",
                            showCancelButton: false,
                            confirmButtonClass: "btn-success",
                            confirmButtonText: "OK",
                            closeOnConfirm: false,
                            closeOnCancel: false
                        },
                        function(isConfirm) {
                            if (isConfirm) {
                                window.location.replace('/users/administrators');
                            }
                        });
                    }
                }     
            })
        }
    });

    

    //Save case progress notes
    $('#saveCaseNotes').click(function(e){
        var caseId = $('#caseId').val();
        var notes = $('#notes').val();
        
        if ($.trim(notes) == ''){
            $(".response").html('<span style="font-size: 16px; color: red; font-weight: 600">Case notes are required</span>');
        } else {
            var formData = { 'caseId':caseId, 'notes':notes, '_token':token };
            $.ajax({
                type        : 'POST',
                url         : '/cases/single/add-notes',
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
    })


    //Email validation function
    function validateEmail(sEmail) {
        var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
        if (filter.test(sEmail)) {
            return true;
        }
    }

    
});