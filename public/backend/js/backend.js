$(document).ready(function(){
	var token = $("#token").val();

    $("#featureTalent").click(function(e){
        var userId = $("#userId").val();

        var formData = {'userId':userId, '_token':token};

        $.ajax({
            type        : 'POST',
            url         : '/backend/users/talent/feature',
            data        : formData,
            success     : function(data) {
                if (data.success == 1) {
                    //Success
                    swal({
                        title: "Feature Talent",
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
                            window.location.replace('/backend/users/all-talent');
                        }
                    });

                } else {
                    //Failed
                    swal("Failed!", data.message, "error");
                } 
            }      
        })
    })

    $("#users").on('click', 'button.blockUser', function(e) {
        e.preventDefault(); 
        var id = $(this).attr("data-code");
        blockUser(id);
    })

    $("#users").on('click', 'button.approveUser', function(e) {
        e.preventDefault(); 
        var id = $(this).attr("data-code");
        approveUser(id);
    })
    $("#users").on('click', 'button.unblockUser', function(e) {
        e.preventDefault(); 
        var id = $(this).attr("data-code");
        unblockUser(id);
    })

    $("#jobs").on('click', 'button.deleteJob', function(e) {
        e.preventDefault(); 
        var id = $(this).attr("data-code");
        deleteJob(id);
    })

    //From single talent page
    $("#blockTalent").click(function(){
        var id = $("#userId").val();
        blockUser(id);
    });
    $("#unblockTalent").click(function(){
        var id = $("#userId").val();
        unblockUser(id);
    });
    $("#deleteTalent").click(function(){
        var id = $("#userId").val();
        deleteUser(id);
    });

    $(".deleteJobBtn").click(function(e){
        e.preventDefault(); 
        var id = $(this).attr("data-code");
        var reasonDelete = $("#reasonDelete").val();
        
        if($.trim(reasonDelete) == ''){
            alert("Reason is required!");
        }else{
            deleteJob(id, reasonDelete);
        }
    })

    function blockUser(id){
        var formData = {'id':id, '_token':token};
        $.ajax({
            type        : 'POST',
            url         : '/backend/users/block',
            data        : formData,
            success     : function(data) {
                if (data.success == 1) {
                    //Success
                    swal({
                        title: "Block user",
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
                    swal("Block user", data.message, "error");
                } 
            }      
        })
    }

    function unblockUser(id){
        var formData = {'id':id, '_token':token};

        $.ajax({
            type        : 'POST',
            url         : '/backend/users/unblock',
            data        : formData,
            success     : function(data) {
                if (data.success == 1) {
                    //Success
                    swal({
                        title: "Unblock user",
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
                    swal("Unblock user", data.message, "error");
                } 
            }      
        })
    }

    function approveUser(id){
        var formData = {'id':id, '_token':token};

        $.ajax({
            type        : 'POST',
            url         : '/backend/users/approve',
            data        : formData,
            success     : function(data) {
                if (data.success == 1) {
                    //Success
                    swal({
                        title: "Approve user",
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
                    swal("Approve user", data.message, "error");
                } 
            }      
        })
    }

    function deleteUser(id, reasonDelete){
        swal({
            title: "Delete User",
            text: "Are you sure of this action?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            confirmButtonText: "Delete",
            cancelButtonText: "Cancel",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                var formData = {'id':id, 'reason':reasonDelete, '_token':token};

                $.ajax({
                    type        : 'POST',
                    url         : '/backend/users/delete',
                    data        : formData,
                    success     : function(data) {
                        if (data.success == 1) {
                            //Success
                            swal({
                                title: "Voila!",
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
                                    window.location.replace('/backend/users/all-talent');
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
    }

    function deleteJob(id, reasonDelete){
        swal({
            title: "Delete Job",
            text: "Are you sure of this action?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-info",
            confirmButtonText: "Delete",
            cancelButtonText: "Cancel",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                var formData = {'id':id, 'reason':reasonDelete, '_token':token};

                $.ajax({
                    type        : 'POST',
                    url         : '/backend/jobs/delete',
                    data        : formData,
                    success     : function(data) {
                        if (data.success == 1) {
                            //Success
                            swal({
                                title: "Delete Job",
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
                                    window.location.replace('/backend/jobs?type=Job');
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
    }
})