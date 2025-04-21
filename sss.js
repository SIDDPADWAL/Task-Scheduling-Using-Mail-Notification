function submit_yes_ans(sc_id = null) {
	if(sc_id) {
		var r = confirm("Are You Sure To Submit?");
		if(r==true){
			$.ajax({
				url: './submit_yes_ans.php',
				type: 'post',
				data: {sc_id : sc_id},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Course submitted Successfully!");
						 $("#mes").html("ookkk");
					} else {
					} // /else
				} // /success
			});  // /ajax function to remove the order
	} else{
		location.reload();
	}
	}
	else {
		alert('error! refresh the page again');
	}	
}
function submit_no_ans(sc_id = null) {
	if(sc_id) {
		var r = confirm("Are You Sure To Submit?");
		if(r==true){
			$.ajax({
				url: './submit_no_ans.php',
				type: 'post',
				data: {sc_id : sc_id},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Course submitted Successfully!");
						 $("#mes").html("ookkk");
					} else {
					} // /else
				} // /success
			});  // /ajax function to remove the order
	} else{
		location.reload();
	}
	}
	else {
		alert('error! refresh the page again');
	}	
}
function add_disease(pid = null) {
	if(pid) {
		var r = confirm("Are You Sure To add to my disease?");
		if(r==true){
			$.ajax({
				url: './addmydisease.php',
				type: 'post',
				data: {pid : pid},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Disease Added Successfully!");
						 $("#mes").html("ookkk");
					} else {
					} // /else
				} // /success
			});  // /ajax function to remove the order
	} else{
		location.reload();
	}
	}
	else {
		alert('error! refresh the page again');
	}	
}
function remove_disease(disease_id = null) {
	if(disease_id) {
		var r = confirm("Are You Sure To Remove from my disease?");
		if(r==true){
			$.ajax({
				url: './remove_mydisease.php',
				type: 'post',
				data: {disease_id : disease_id},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Disease Removed Successfully!");
						 $("#mes").html("ookkk");
					} else {
					} // /else
				} // /success
			});  // /ajax function to remove the order
	} else{
		location.reload();
	}
	}
	else {
		alert('error! refresh the page again');
	}	
}
function delete_task(task_id = null) {
	if(task_id) {
		var r = confirm("Are You Sure To Remove Task?");
		if(r==true){
			$.ajax({
				url: './delete_task.php',
				type: 'post',
				data: {task_id : task_id},
				dataType: 'json',
				success:function(response) {
					if(response.success == true) {
						 location.reload();
						 alert("Task Removed Successfully!");
						 $("#mes").html("ookkk");
					} else {
					} // /else
				} // /success
			});  // /ajax function to remove the order
	} else{
		location.reload();
	}
	}
	else {
		alert('error! refresh the page again');
	}	
}
