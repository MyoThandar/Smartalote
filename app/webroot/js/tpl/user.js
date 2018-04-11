$(document).ready(function(){
	var job_id=$('#job_id').val();
	var authId=$('#authId').val();
	var CmpHeadhunterId = $('.CmpHeadhunterId').val();
	//apply from occupations detail
	$("#apply").click(function() {
		var blockCmpID = $('.blockCmpID').val();

		if(authId ==''){
			window.location.replace('/user/logout');
		}else{
			if(blockCmpID != ''){
				$("#notapplied_text").show();
			}else{
				$.ajax({
					url: "/useroccupations/applied",
					type: "POST",
					dataType: 'json',
					data: "job_id="+job_id+"&CmpHeadhunterId="+CmpHeadhunterId,
					success : function(response){
						if(response['result'] == 'save'){
							$("#applied_text").show();
							$("#apply").text('Applied');
							$('#apply').css({ opacity: 0.5});
							$("#apply").css("pointer-events", "none");
						}
					},
					error: function(){
						alert('error');
					}
				});
			}

		}
	});

	$(document).on('click', '#keep', function(){
		var authId=$('.authId').val();
		var authId=$('#authId').val();


		if(authId == ''){
			window.location.replace('/user/logout');
		}else{
			$.ajax({
				url: "/useroccupations/saveJob/" + job_id,
				dataType: "json",
			})
			.done(function(data) {
				console.log(data);
				console.log(data['ajaxStatus']);
				if(data['ajaxStatus'] == 'keep'){
					$("#keep").css({ opacity: 0.5});
					$('#keep').html("Saved");
				}else{
					$('#keep').css("opacity", "");
					$('#keep').html("Save");
				}
			})
			.fail(function(xhr, textStatus, errorThrown) {
				console.log(xhr);
				console.log(textStatus);
				console.log(errorThrown);
			});
		}
	});

});