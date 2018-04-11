$(function () {
	$("form").on('change', '.fileupload', function (input) {
		if (typeof (FileReader) != "undefined") {
			var dvPreview = $(this).siblings('.dvPreview');
			var imgSpace = $(this).siblings('imgSpace');
			var afterPreview = $(this).siblings('imgSpace');
			dvPreview.html("");
			imgSpace.html("");
			afterPreview.html("");
			var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
			$($(this)[0].files).each(function () {
				var file = $(this);
				if (regex.test(file[0].name.toLowerCase())) {
					var reader = new FileReader();
					reader.onload = function (e) {
						var img = $(
						"<img class=\"imagelogo\" src=\"" + e.target.result + "\" height=\"150\" width=\"150\" />" +
						"<br/>"+
						"<span class='logo'>"+
						"<span class=\"remove_image\"></span>" +
						"</span>");
						console.log(dvPreview);
						dvPreview.append(img);
						$('.imgSpace').css('padding-left','65px');
						$('.fileupload').css('width','89px');
						$('.afterPreview').text(file[0].name);
						$('.afterPreview').css('margin-left','89px');
						$('.afterPreview').css('margin-top','-20px');
					}
					reader.readAsDataURL(file[0]);
				} else {
					alert(file[0].name + " is not a valid image file.");
					dvPreview.html("");
					return false;
				}
			});
		} else {
			alert("This browser does not support HTML5 FileReader.");
		}
	});
});