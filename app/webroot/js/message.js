$(document).ready(function(){
	$('#selectall').on('click',function(){
		var checked = $(this).is(':checked');
		$('.select_id').each(function () {
			var checkBox = $(this);
			if (checked) {
				checkBox.prop('checked', true);
			}else {
				checkBox.prop('checked', false);
			}
		});
	});

	$(".select_id").click(function () {
		if ($(this).is(":checked")){
			var isAllChecked = 0;
			$(".select_id").each(function(){
				if(!this.checked)
					isAllChecked = 1;
			})
			if(isAllChecked == 0){ $("#selectall").prop("checked", true); }
		}else {
			$("#selectall").prop("checked", false);
		}
	});

	$('#delete').click(function(){
		var checkValues = $('input[name=checkboxlist]:checked').map(function(){
			return $(this).val();
		}).get();
		$.ajax({
			url: "/mastermessages/ajaxTest",
			type: "POST",
			dataType: 'HTML',
			data: "id="+checkValues,
			success : function(response){
						//alert(response);
						alert("Are You Sure Want To Delete?");
						window.location.reload(true);
					},
					error: function(){
						alert('Error');
					}
				});
	});

	$("#move").change(function() {
		var checkValues = $('input[name=checkboxlist]:checked').map(function(){
			return $(this).val();
		}).get();
		var selectData = $(this).val();
		if(selectData == 1){
			$.ajax({
				url: "/mastermessages/ajaxSpam",
				type: "POST",
				dataType: 'HTML',
				data: "id="+checkValues,
				success : function(response){
					window.location.reload(true);
				},
				error: function(){
					alert('Error');
				}
			});
		}else{
			$.ajax({
				url: "/mastermessages/ajaxTest",
				type: "POST",
				dataType: 'HTML',
				data: "id="+checkValues,
				success : function(response){
					window.location.reload(true);
				},
				error: function(){
					alert('Error');
				}
			});

		}
	});

	$('#info').click(function(){
		var checkValues = $('input[name=checkboxlist]:checked').map(function(){
			return $(this).val();
		}).get();
		var infovalue=$(this).val();
		$.ajax({
			url: "/mastermessages/ajaxButtons",
			type: "POST",
			dataType: 'HTML',
			data: "id="+checkValues+"&btn_value="+infovalue,
			success : function(response){
				window.location.reload(true);
			},
			error: function(){
				alert('Error');
			}
		});
	});

	$('#jobseek').click(function(){
		var checkValues = $('input[name=checkboxlist]:checked').map(function(){
			return $(this).val();
		}).get();
		var jobseekvalue=$(this).val();
		$.ajax({
			url: "/mastermessages/ajaxButtons",
			type: "POST",
			dataType: 'HTML',
			data: "id="+checkValues+"&btn_value="+jobseekvalue,
			success : function(response){
				window.location.reload(true);
			},
			error: function(){
				alert('Error');
			}
		});
	});

	$('#company').click(function(){
		var checkValues = $('input[name=checkboxlist]:checked').map(function(){
			return $(this).val();
		}).get();
		var companyvalue=$(this).val();
		$.ajax({
			url: "/mastermessages/ajaxButtons",
			type: "POST",
			dataType: 'HTML',
			data: "id="+checkValues+"&btn_value="+companyvalue,
			success : function(response){
				window.location.reload(true);
			},
			error: function(){
				alert('Error');
			}
		});
	});

	$('#spam').click(function(){
		var checkValues = $('input[name=checkboxlist]:checked').map(function(){
			return $(this).val();
		}).get();
		$.ajax({
			url: "/mastermessages/ajaxSpam",
			type: "POST",
			dataType: 'HTML',
			data: "id="+checkValues,
			success : function(response){
				window.location.reload(true);
			},
			error: function(){
				alert('Error');
			}
		});
	});

	$("#level").change(function() {
		var checkValues = $('input[name=checkboxlist]:checked').map(function(){
			return $(this).val();
		}).get();
		var selectData = $(this).val();
		$.ajax({
			url: "/mastermessages/ajaxButtons",
			type: "POST",
			dataType: 'HTML',
			data: "id="+checkValues+"&btn_value="+selectData,
			success : function(response){
				window.location.reload(true);
			},
			error: function(){
				alert('error');
			}
		});
	});
	$(".compost_table tbody").on('click', 'tr td:not(:first-child)', function () {
		var id = $(this).closest('tr').attr('id');
		window.location.href = "detail/"+ id;
	});

	/*$('#delete').click(function(){
			var checkValues = $('input[name=checkboxlist]:checked').map(function(){
				return $(this).val();
			}).get();
			$.ajax({
				url: "/mastermessages/ajaxTest",
				type: "POST",
				dataType: 'HTML',
				data: "id="+checkValues,
				success : function(response){
					window.location.reload(true);
				},
				error: function(){
					alert('通信失敗');
				}
			});
	});*/

	/*$('#spam').click(function(){
		var checkValues = $('input[name=checkboxlist]:checked').map(function(){
			return $(this).val();
		}).get();
		$.ajax({
			url: "/mastermessages/ajaxSpam",
			type: "POST",
			dataType: 'HTML',
			data: "id="+checkValues,
			success : function(response){
				window.location.reload(true);
			},
			error: function(){
				alert('通信失敗');
			}
		});
	});*/

	/*$("#move").change(function() {
		var checkValues = $('input[name=checkboxlist]:checked').map(function(){
			return $(this).val();
		}).get();
		var selectData = $(this).val();
		if(selectData == 1){
			$.ajax({
				url: "/mastermessages/ajaxSpam",
				type: "POST",
				dataType: 'HTML',
				data: "id="+checkValues,
				success : function(response){
					window.location.reload(true);
				},
				error: function(){
					alert('通信失敗');
				}
			});
		}else{
			$.ajax({
				url: "/mastermessages/ajaxTest",
				type: "POST",
				dataType: 'HTML',
				data: "id="+checkValues,
				success : function(response){
					window.location.reload(true);
				},
				error: function(){
					alert('通信失敗');
				}
			});

		}
	});*/

	/*$('#info').click(function(){
		var checkValues = $('input[name=checkboxlist]:checked').map(function(){
			return $(this).val();
		}).get();
		var infovalue=$(this).val();
		$.ajax({
			url: "/mastermessages/ajaxButtons",
			type: "POST",
			dataType: 'HTML',
			data: "id="+checkValues+"&btn_value="+infovalue,
			success : function(response){
				window.location.reload(true);
			},
			error: function(){
				alert('通信失敗');
			}
		});
	});*/

	/*$('#jobseek').click(function(){
		var checkValues = $('input[name=checkboxlist]:checked').map(function(){
			return $(this).val();
		}).get();
		var jobseekvalue=$(this).val();
		$.ajax({
			url: "/mastermessages/ajaxButtons",
			type: "POST",
			dataType: 'HTML',
			data: "id="+checkValues+"&btn_value="+jobseekvalue,
			success : function(response){
				window.location.reload(true);
			},
			error: function(){
				alert('通信失敗');
			}
		});
	});*/

	/*$('#company').click(function(){
		var checkValues = $('input[name=checkboxlist]:checked').map(function(){
			return $(this).val();
		}).get();
		var companyvalue=$(this).val();
		$.ajax({
			url: "/mastermessages/ajaxButtons",
			type: "POST",
			dataType: 'HTML',
			data: "id="+checkValues+"&btn_value="+companyvalue,
			success : function(response){
				window.location.reload(true);
			},
			error: function(){
				alert('通信失敗');
			}
		});
	});

	$("#level").change(function() {
		var checkValues = $('input[name=checkboxlist]:checked').map(function(){
			return $(this).val();
		}).get();
		var selectData = $(this).val();
		$.ajax({
			url: "/mastermessages/ajaxButtons",
			type: "POST",
			dataType: 'HTML',
			data: "id="+checkValues+"&btn_value="+selectData,
			success : function(response){
				window.location.reload(true);
			},
			error: function(){
				alert('通信失敗');
			}
		});
	});*/
});