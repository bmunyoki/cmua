$(document).ready(function(){
	var token = $("#token").val();

	//Users
	//Get total talent
	$("#userStats").on('click', 'a#talent', function(e){
		e.preventDefault();
		
		doGetStats('users', 'talent', function(data){
			if(data.success == 1){
				$("#userTxtHolder").html("Talent");
				$(".users").html(data.total);
			}else{
				swal("Failed!", data.message, "error");
			}
		});
	})

	//Get total individual employers
	$("#userStats").on('click', 'a#individual', function(e){
		e.preventDefault();
		
		doGetStats('users', 'individual', function(data){
			if(data.success == 1){
				$("#userTxtHolder").html("Individual Employers");
				$(".users").html(data.total);
			}else{
				swal("Failed!", data.message, "error");
			}
		});
	})

	//Get total company employers
	$("#userStats").on('click', 'a#company', function(e){
		e.preventDefault();
		
		doGetStats('users', 'company', function(data){
			if(data.success == 1){
				$("#userTxtHolder").html("Company Employers");
				$(".users").html(data.total);
			}else{
				swal("Failed!", data.message, "error");
			}
		});
	})


	//Jobs
	//Get total jobs
	$("#jobStats").on('click', 'a#job', function(e){
		e.preventDefault();
		
		doGetStats('jobs', 'job', function(data){
			if(data.success == 1){
				$("#jobsTxtHolder").html("Jobs");
				$(".jobs").html(data.total);
			}else{
				swal("Failed!", data.message, "error");
			}
		});
	})

	//Get total internships
	$("#jobStats").on('click', 'a#internship', function(e){
		e.preventDefault();
		
		doGetStats('jobs', 'internship', function(data){
			if(data.success == 1){
				$("#jobsTxtHolder").html("Internships");
				$(".jobs").html(data.total);
			}else{
				swal("Failed!", data.message, "error");
			}
		});
	})

	//Get total projects
	$("#jobStats").on('click', 'a#project', function(e){
		e.preventDefault();
		
		doGetStats('jobs', 'project', function(data){
			if(data.success == 1){
				$("#jobsTxtHolder").html("Projects");
				$(".jobs").html(data.total);
			}else{
				swal("Failed!", data.message, "error");
			}
		});
	})

	function doGetStats(type, category, callback){
        var formData = {'type':type, 'category':category, '_token':token};
        $.ajax({
            type        : 'POST',
            url         : '/backend/dashboard/get-stats',
            data        : formData,
            success     : function(data) {
                callback(data);
            }      
        })
    }
})