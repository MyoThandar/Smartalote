$(document).on('click', '.jobListApply', function(){
		var authId = $('.authId').val();
		var cmp_id = $(this).parent().attr('data-cmp-id');
		var CmpHeadhunterID =$(this).closest(".CmpHeadhunterID").attr('data-cmpheadhunter-id');
		var job_id = $(this).attr('id');
		if(authId ==''){
			window.location.replace('/user/logout');
		}else{
			if(CmpHeadhunterID != ''){ //you cannot apply this job because of user blocked this job of company
				alert("Sorry, you cannot apply to this job.");
			} else{
				$.ajax({
					url: "/useroccupations/applied",
					type: "POST",
					dataType: 'json',
					data: "job_id="+job_id+"&CmpHeadhunterId="+cmp_id,
					success : function(response){
						if(response['result'] == 'save'){
							$("span[id="+job_id+"]").text('Applied job');
							$("span[id="+job_id+"]").css({ opacity: 0.5});
							$("span[id="+job_id+"]").css("pointer-events", "none");
						}
					},
					error: function(){
						alert("error");
					}
				});
			}
		}
	});

	$(document).on('click', '.jobListSave', function(){
		var authId=$('.authId').val();
		var job_id = $(this).attr('id');
		if(authId == ''){
			window.location.replace('/user/logout');
		}else{
			$.ajax({
				url: "/useroccupations/saveJob/" + job_id,
				dataType: "json",
			})
			.done(function(data) {
				// console.log(data['ajaxStatus']);
				if(data['ajaxStatus'] == 'keep'){
					$("div[id="+job_id+"]").css({ opacity: 0.5});
					$("div[id="+job_id+"]").html("Saved job");
				}else{
					$("div[id="+job_id+"]").css("opacity", "");
					$("div[id="+job_id+"]").html("Save job");
				}
			})
			.fail(function(xhr, textStatus, errorThrown) {
				console.log(xhr);
				console.log(textStatus);
				console.log(errorThrown);
			});
		}
	});