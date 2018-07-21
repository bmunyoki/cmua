$(document).ready(function(){
    //Get the csrf token for Laravel
    const token = $("#token").val();
    //alert('l');

    //Close a case
    $("#closeBtn").click(function(){
        swal({
            title: "Resolve Case",
            text: "Resolving a case closes it. Are you sure of this action?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            cancelButtonText: "Cancel",
            confirmButtonText: "Yes",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                var caseId = $('#caseId').val();
                var formData = {'caseId':caseId, '_token':token};

                $.ajax({
                    type        : 'POST',
                    url         : '/cases/close',
                    data        : formData,
                    success     : function(data) {
                        if (data.res == 1) {
                            //Success
                            swal({
                                title: "Close Case",
                                text: data.message,
                                type: "success",
                                showCancelButton: false,
                                confirmButtonClass: "btn-info",
                                confirmButtonText: "OK!",
                                closeOnConfirm: false,
                                closeOnCancel: false
                            },
                            function(isConfirm) {
                                if (isConfirm) {
                                    window.location.replace('/cases/resolved');
                                }
                            });
                        } else {
                            //Failed
                            swal("Failed!", data.message, "error");
                        } 
                    }      
                })

            }
        });
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

    //Update user details
    $('#updateUser').click(function(e){
        e.preventDefault();
        var userId = $("#uUserId").val();
        var fName = $("#uFName").val();
        var lName = $("#uLName").val();
        var email = $("#uEmail").val();
        var phone = $("#uIntPhone").val();
        var device = $("#uDevice").val();

        var isValid = $("#uIntPhone").intlTelInput("isValidNumber");

        if ($.trim(fName) == ''){
            $(".response").html('<span style="font-size: 16px; color: red; font-weight: 600">First name is required</span>');
        } else if ($.trim(lName) == ''){
            $(".response").html('<span style="font-size: 16px; color: red; font-weight: 600">Last name is required</span>');
        } else if ($.trim(email) == '' || !validateEmail(email)) {
            $(".response").html('<span style="font-size: 16px; color: red; font-weight: 600">Invalid email</span>');
        } else if (!isValid){
            $(".response").html('<span style="font-size: 16px; color: red; font-weight: 600;">Invalid phone number</span>');
        } else {
            var formData = {'userId':userId, 'fName':fName, 'lName':lName, 'phone':phone, 'email':email, 'device':device, '_token':token };
            $.ajax({
                type        : 'POST',
                url         : '/users/update',
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
                                location.reload();
                            }
                        });
                    }
                }     
            })
        }
    });

    //Discard a case
    $('#discardCase').click(function(){
        var audioId = $('#audioId').val();
        swal({
            title: "Discard a Recording",
            text: "Discarding a recording deletes it from the system and cannot be recorvered.",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            cancelButtonText: "Cancel",
            confirmButtonText: "Yes",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                var formData = {'audioId':audioId, '_token':token};

                $.ajax({
                    type        : 'POST',
                    url         : '/audio/discard',
                    data        : formData,
                    success     : function(data) {
                        if (data.res == 1) {
                            //Success
                            swal({
                                title: "Discard a Recording",
                                text: data.message,
                                type: "success",
                                showCancelButton: false,
                                confirmButtonClass: "btn-info",
                                confirmButtonText: "OK!",
                                closeOnConfirm: false,
                                closeOnCancel: false
                            },
                            function(isConfirm) {
                                if (isConfirm) {
                                    location.reload();
                                }
                            });
                        } else {
                            //Failed
                            swal("Failed!", data.message, "error");
                        } 
                    }      
                })

            }
        });
    })


    //Delete a user (admin/volunteer)
    $('.users').on('click', 'a.deleteUser', function(){
        var userId = $(this).attr("data-code");
        swal({
            title: "Delete a User",
            text: "Deleting are user removes them and their associated records from the system. Are you sure of this action?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            cancelButtonText: "Cancel",
            confirmButtonText: "Yes",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                var formData = {'userId':userId, '_token':token};

                $.ajax({
                    type        : 'POST',
                    url         : '/users/delete',
                    data        : formData,
                    success     : function(data) {
                        if (data.res == 1) {
                            //Success
                            swal({
                                title: "Delete a User",
                                text: data.message,
                                type: "success",
                                showCancelButton: false,
                                confirmButtonClass: "btn-info",
                                confirmButtonText: "OK!",
                                closeOnConfirm: false,
                                closeOnCancel: false
                            },
                            function(isConfirm) {
                                if (isConfirm) {
                                    location.reload();
                                }
                            });
                        } else {
                            //Failed
                            swal("Failed!", data.message, "error");
                        } 
                    }      
                })

            }
        });
    })

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

    $("#addVolunteer").click(function(e){
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
                url         : '/users/add/volunteer',
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
                                window.location.replace('/users/volunteers');
                            }
                        });
                    }
                }     
            })
        }
    });

    //Save case progress notes and close Case
    $('#saveCloseCaseNotes').click(function(e){
        var caseId = $('#caseId').val();
        var notes = $('#closureNotes').val();
        
        if ($.trim(notes) == ''){
            $(".response").html('<span style="font-size: 16px; color: red; font-weight: 600">Case closure notes are required</span>');
        } else {
            var formData = { 'caseId':caseId, 'notes':notes, '_token':token };
            $.ajax({
                type        : 'POST',
                url         : '/cases/single/close-with-notes',
                data        : formData,
                success     : function(data) {
                    if (data.res == 0) {
                        $(".response").html('<span style="font-size: 16px; color: red; font-weight: 600">'+data.message+'</span>');
                    } else {
                        //$(".response").html('<span style="font-size: 16px; color: green; font-weight: 600">'+data.message+'</span>');
                        setTimeout(function(){
                            window.location.replace(data.redirect);
                        }, 10);
                    }
                }     
            })
        }
    })

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

    //Add a case (from listening to audio)
    $("#audios").on('click', 'button.listen-button', function() { 

        var audioId = $(this).attr("data-code");
        document.getElementById('audioId').value = audioId;
        var formData = { 'audioId':audioId, '_token':token };
        $.ajax({
            type        : 'POST',
            url         : '/cases/create/get-call-date-and-phone',
            data        : formData,
            success     : function(data) {
                if (data.res == 0) {
                    var today = new Date();
                    var day = today.getDate();
                    var month = today.getMonth()+1;
                    var year = today.getFullYear();
                    if(month < 10){
                        month = '0'+month;
                    }

                    var todayDate = year + '-' + month + '-' + day;

                    document.getElementById('callDate').value = todayDate;
                    document.getElementById('callerPhone').value = '07xxxxxxxx';
                } else {
                    $('#audioName').html(
                        '<audio controls controlsList="nodownload" style="width: 100% !important" id="loadedAudio">'+
                            '<source src="'+data.filePath+'" type="audio/mp3">'+  
                        '</audio>'
                    );
                    //$('#audioName').html('<source src="'+data.filePath+'" type="audio/mp3">');
                    document.getElementById('callDate').value = data.audioDate;
                    document.getElementById('callerPhone').value = data.callerPhone;

                    $(".bd-example-modal-lg").modal();
                    
                }
            }     
        })
    })

    $('#createCase').click(function(e){
        e.preventDefault();
        var audioId = $('#audioId').val();
        var fName = $('#fName').val();
        var lName = $('#lName').val();
        var locationName = $('#locationName').val();
        var callDate = $('#callDate').val();
        var latitude = $('#latitude').val();
        var longitude = $('#longitude').val();
        var radius = $('#radius').val();
        var tag = $('#tag').val();
        var description = $('#description').val();
        var priority = $('#priority').val();
        var callerPhone = $('#callerPhone').val();

        if ($.trim(fName) == ''){
            $(".response").html('<span style="font-size: 16px; color: red; font-weight: 600">First name is required</span>');
        } else if ($.trim(lName) == ''){
            $(".response").html('<span style="font-size: 16px; color: red; font-weight: 600">Last name is required</span>');
        } else if ($.trim(locationName) == '') {
            $(".response").html('<span style="font-size: 16px; color: red; font-weight: 600">Location name is required</span>');
        } else if ($.trim(description) == ''){
            $(".response").html('<span style="font-size: 16px; color: red; font-weight: 600;">Description is required</span>');
        } else {
            var formData = {
                'audioId':audioId, 'fName':fName, 'lName':lName, 'locationName':locationName,
                'latitude':latitude, 'longitude':longitude, 'radius':radius, 'tag':tag, 'priority':priority,
                'callerPhone':callerPhone, 'callDate':callDate, 'description':description, '_token':token
            };
            $.ajax({
                type        : 'POST',
                url         : '/cases/create',
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
                                window.location.replace('/cases/received');
                            }
                        });
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