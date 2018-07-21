$(document).ready(function(){
    //Get the csrf token for Laravel
    const token = $("#token").val();
    //alert('l');

    //add apartment
    $('#addApartment').click(function(e){
        var name = $('#name').val();
        
        var formData = { 'name':name, '_token':token };
        $.ajax({
            type        : 'POST',
            url         : '/apartments/add',
            data        : formData,
            success     : function(data) {
                if (data.res == 0) {
                    $(".response").html('<span style="font-size: 16px; color: red; font-weight: 600">'+data.message+'</span>');
                } else {
                    $(".response").html('<span style="font-size: 16px; color: green; font-weight: 600">'+data.message+'</span>');
                    setTimeout(function(){
                        location.reload();
                    }, 2000);
                }
            }     
        })
    })

    //add student
    $('#addStudent').click(function(e){
        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var email = $('#email').val();
        var gender = $('#gender').val();
        var apartment = $('#apartment').val();
        
        var formData = { 'fname':fname, 'lname':lname, 'email':email, 'gender':gender, 'apartment':apartment, '_token':token };
        $.ajax({
            type        : 'POST',
            url         : '/students/add',
            data        : formData,
            success     : function(data) {
                if (data.res == 0) {
                    $(".response").html('<span style="font-size: 16px; color: red; font-weight: 600">'+data.message+'</span>');
                } else {
                    $(".response").html('<span style="font-size: 16px; color: green; font-weight: 600">'+data.message+'</span>');
                    setTimeout(function(){
                        location.reload();
                    }, 2000);
                }
            }     
        })
    })


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


    //Email validation function
    function validateEmail(sEmail) {
        var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
        if (filter.test(sEmail)) {
            return true;
        }
    }

    
});