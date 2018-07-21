$(document).ready(function(){
    'use strict';
    const token = $("#token").val();


    setTimeout(function(){
        loadDashboardStats();
    }, 500);

    function loadDashboardStats(){
    	var formData = {'_token':token };
        $.ajax({
            type        : 'POST',
            url         : '/dashboard/get-stats',
            data        : formData,
            success     : function(data) {
                if (data.res == 1) {
                    $('#dashRecordingsNumber').html(data.dashNumRecordings+' Recordings');

                    $('#dashActiveFGM').html(data.dashActiveFGM);
                    $('#dashFGMEmergency').html(data.dashFGMEmergency);
                    $('#dashActiveEM').html(data.dashActiveEM);
                    $('#dashEMEmergency').html(data.dashEMEmergency);
                    $('#dashActiveCA').html(data.dashActiveCA);
                    $('#dashCAEmergency').html(data.dashCAEmergency);

                    $('#dashTotalCasesIncept').html(data.dashTotalCasesIncept);
                    $('#dashTotalCasesYTD').html(data.dashTotalCasesYTD);

                    $('#dashResolvedFGM').html(data.dashResolvedFGM);
                    $('#dashResolvedEM').html(data.dashResolvedEM);
                    $('#dashResolvedCA').html(data.dashResolvedCA);
                } 
            }     
        })
    }
})