/**
 * Resize function without multiple trigger
 *
 * Usage:
 * $(window).smartresize(function(){
 *     // code here
 * });
 */
 (function($,sr){
		// debouncing function from John Hann
		// http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
		var debounce = function (func, threshold, execAsap) {
			var timeout;

			return function debounced () {
				var obj = this, args = arguments;
				function delayed () {
					if (!execAsap)
						func.apply(obj, args);
					timeout = null;
				}

				if (timeout)
					clearTimeout(timeout);
				else if (execAsap)
					func.apply(obj, args);

				timeout = setTimeout(delayed, threshold || 100);
			};
		};

		// smartresize
		jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };

	})(jQuery,'smartresize');
/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 var CURRENT_URL = window.location.href.split('#')[0].split('?')[0],
 $BODY = $('body'),
 $MENU_TOGGLE = $('#menu_toggle'),
 $SIDEBAR_MENU = $('#sidebar-menu'),
 $SIDEBAR_FOOTER = $('.sidebar-footer'),
 $LEFT_COL = $('.left_col'),
 $RIGHT_COL = $('.right_col'),
 $NAV_MENU = $('.nav_menu'),
 $FOOTER = $('footer');

// Sidebar
$(document).ready(function() {
	//for checkbox click show password textbox
	$("#cbox").click(function(){
		$("#wizard").toggle();
	});
		// TODO: This is some kind of easy fix, maybe we can improve this
		var setContentHeight = function () {
				// reset height
				$RIGHT_COL.css('min-height', $(window).height());

				var bodyHeight = $BODY.outerHeight(),
				footerHeight = $BODY.hasClass('footer_fixed') ? -10 : $FOOTER.height(),
				leftColHeight = $LEFT_COL.eq(1).height() + $SIDEBAR_FOOTER.height(),
				contentHeight = bodyHeight < leftColHeight ? leftColHeight : bodyHeight;

				// normalize content
				contentHeight -= $NAV_MENU.height() + footerHeight;

				$RIGHT_COL.css('min-height', contentHeight);
			};

			var $tag = $SIDEBAR_MENU.find('a').parent();
			$('ul:first', $tag).slideDown();

			$SIDEBAR_MENU.find('a').on('click', function(ev) {
				var $li = $SIDEBAR_MENU.find('a').parent();

				if ($li.is('.active')) {
					$li.removeClass('active active-sm');
				} else {
						// prevent closing menu if we are on child menu
						if (!$li.parent().is('.child_menu')) {
							$SIDEBAR_MENU.find('li').removeClass('active active-sm');
							$SIDEBAR_MENU.find('li ul').slideDown();
						}

						$li.addClass('active');
					}
				});

		// toggle small or large menu
		$MENU_TOGGLE.on('click', function() {
			if ($BODY.hasClass('nav-md')) {
				$SIDEBAR_MENU.find('li.active ul').hide();
				$SIDEBAR_MENU.find('li.active').addClass('active-sm').removeClass('active');
			} else {
				$SIDEBAR_MENU.find('li.active-sm ul').show();
				$SIDEBAR_MENU.find('li.active-sm').addClass('active').removeClass('active-sm');
			}

			$BODY.toggleClass('nav-md nav-sm');

		});

		// check active menu
		$SIDEBAR_MENU.find('a[href="' + CURRENT_URL + '"]').parent('li').addClass('current-page');

		$SIDEBAR_MENU.find('a').filter(function () {
			return this.href == CURRENT_URL;
		}).parent('li').addClass('current-page').parents('ul').slideDown().parent().addClass('active');

		// recompute content when resizing
		$(window).smartresize();

		setContentHeight();

		// fixed sidebar
		if ($.fn.mCustomScrollbar) {
			$('.menu_fixed').mCustomScrollbar({
				autoHideScrollbar: true,
				theme: 'minimal',
				mouseWheel:{ preventDefault: true }
			});
		}
	});
// /Sidebar

// Panel toolbox
$(document).ready(function() {
	$('.collapse-link').on('click', function() {
		var $BOX_PANEL = $(this).closest('.x_panel'),
		$ICON = $(this).find('i'),
		$BOX_CONTENT = $BOX_PANEL.find('.x_content');

				// fix for some div with hardcoded fix class
				if ($BOX_PANEL.attr('style')) {
					$BOX_CONTENT.slideToggle(200, function(){
						$BOX_PANEL.removeAttr('style');
					});
				} else {
					$BOX_CONTENT.slideToggle(200);
					$BOX_PANEL.css('height', 'auto');
				}

				$ICON.toggleClass('fa-chevron-up fa-chevron-down');
			});

	$('.close-link').click(function () {
		var $BOX_PANEL = $(this).closest('.x_panel');

		$BOX_PANEL.remove();
	});
});
// /Panel toolbox

// Tooltip
$(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip({
		container: 'body'
	});
});
// /Tooltip

// Progressbar
if ($(".progress .progress-bar")[0]) {
	$('.progress .progress-bar').progressbar();
}
// /Progressbar

// Switchery
$(document).ready(function() {
	if ($(".js-switch")[0]) {
		var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
		elems.forEach(function (html) {
			var switchery = new Switchery(html, {
				color: '#26B99A'
			});
		});
	}
});
// /Switchery

// iCheck
$(document).ready(function() {
	if ($("input.flat")[0]) {
		$(document).ready(function () {
			$('input.flat').iCheck({
				checkboxClass: 'icheckbox_flat-green',
				radioClass: 'iradio_flat-green'
			});
		});
	}
});
// /iCheck

// Table
$('table input').on('ifChecked', function () {
	checkState = '';
	$(this).parent().parent().parent().addClass('selected');
	countChecked();
});
$('table input').on('ifUnchecked', function () {
	checkState = '';
	$(this).parent().parent().parent().removeClass('selected');
	countChecked();
});

var checkState = '';

$('.bulk_action input').on('ifChecked', function () {
	checkState = '';
	$(this).parent().parent().parent().addClass('selected');
	countChecked();
});
$('.bulk_action input').on('ifUnchecked', function () {
	checkState = '';
	$(this).parent().parent().parent().removeClass('selected');
	countChecked();
});
$('.bulk_action input#check-all').on('ifChecked', function () {
	checkState = 'all';
	countChecked();
});
$('.bulk_action input#check-all').on('ifUnchecked', function () {
	checkState = 'none';
	countChecked();
});

function countChecked() {
	if (checkState === 'all') {
		$(".bulk_action input[name='table_records']").iCheck('check');
	}
	if (checkState === 'none') {
		$(".bulk_action input[name='table_records']").iCheck('uncheck');
	}

	var checkCount = $(".bulk_action input[name='table_records']:checked").length;

	if (checkCount) {
		$('.column-title').hide();
		$('.bulk-actions').show();
		$('.action-cnt').html(checkCount + ' Records Selected');
	} else {
		$('.column-title').show();
		$('.bulk-actions').hide();
	}
}

// Accordion
$(document).ready(function() {
	$(".expand").on("click", function () {
		$(this).next().slideToggle(200);
		$expand = $(this).find(">:first-child");

		if ($expand.text() == "+") {
			$expand.text("-");
		} else {
			$expand.text("+");
		}
	});
});

// NProgress
if (typeof NProgress != 'undefined') {
	$(document).ready(function () {
		NProgress.start();
	});

	$(window).load(function () {
		NProgress.done();
	});
}

$(document).ready(function() {

	// Industry and job category add
	$('form#sub-form').hide();
	$("form#editform").hide();
	$(".large").on('click', function() {
		$('form#sub-form').show();
		$("form#editform").hide();
		$("form#main-form").hide();
		$("#blabel").val($(this).text());
		$("#big_item_txt").html($(this).text());
		$("#tmplabel").attr('value', $(this).text());
		$("#bigId").attr('value', $(this).attr('id'));
		$("#industryId").attr('value', $(this).attr('id'));
	});

	// Industry and job category edit
	$(".editform").on('click', function() {
		$('form#main-form').hide();
		$('form#sub-form').hide();
		var res = $(this).attr('id').split(":");
		var industry_big_id = res[0];
		var smallId = res[1];
		var bigLabel= res[2];
		var smallLabel = res[3];
		$("#biglabel").attr('value', bigLabel);
		$("#smalllabel").attr('value', smallLabel);
		$("#smallId").attr('value', smallId);
		$("#industry_big_id").attr('value', industry_big_id);
		$("form#editform").show();
	});

	// Region edit
	$(".region-edit").on('click', function() {
		var res = $(this).attr('id').split(":");
		var id = res[0];
		var name = res[1];
		var home_abroad = res[2];
		$("#id").attr('value', id);
		$("#name").attr('value', name);
		if (home_abroad == 'Domestic') {
			$("#home_abroad option[value='Domestic']").attr('selected', 'selected');
			$("#home_abroad option[value='Oversea']").removeAttr('selected');
		} else {
			$("#home_abroad option[value='Oversea']").attr('selected', 'selected');
			$("#home_abroad option[value='Domestic']").removeAttr('selected');
		}

	});

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//// Industry Select box Using in Company and Headhunter add ////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	$('#hide_div_location').hide();
	$('.location-small').hide();
	$('#location-small-'+$('#location-big option:selected').val()).show();
	$('.location-small').children('select').attr('disabled', 'disabled');
	$('#location-small-'+$('#location-big option:selected').val()).children('select').removeAttr('disabled');
	$('#small-location-blank').show();

	///////////////////////////////////////////////// Start location ///////////////////////////////////////////////////////////////////////////////////////////
	$('#location-big').on('change',function() {
		var locationId = $('#location-big option:selected').val();
		if (locationId == "") {
			$('#hide_div_location').show();
			$('#small-location-blank').show();
			$('.location-small').hide();
			$('.location-small').children('select').attr('disabled', 'disabled');
			$('#small-location-blank').children('select').removeAttr('disabled');
		} else {
			$('#hide_div_location').hide();
			$('.location-small').show();
			$('#small-location-blank').hide();
			$('#small-location-blank').children('select').attr('disabled', 'disabled');
			$('.location-small').children().hide();
			$('.location-small').children('select').attr('disabled', 'disabled');
			$('#location-small-'+locationId).children().show();
			$('#location-small-'+locationId).children('select').removeAttr('disabled');
		}
	});
	///////////////////////////////////////////////// End location ///////////////////////////////////////////////////////////////////////////////////////////

	$('#hide_div_industry').hide();
	$('.industry-small').hide();
	$('#industry-small-'+$('#industry-big option:selected').val()).show();
	$('.industry-small').children('select').attr('disabled', 'disabled');
	$('#industry-small-'+$('#industry-big option:selected').val()).children('select').removeAttr('disabled');
	$('#small-industry-blank').show();

	$('#industry-big').on('change',function() {
		var industryId = $('#industry-big option:selected').val();
		if (industryId == "") {
			$('#hide_div_industry').show();
			$('#small-industry-blank').show();
			$('.industry-small').hide();
			$('.industry-small').children('select').attr('disabled', 'disabled');
			$('#small-industry-blank').children('select').removeAttr('disabled');
		} else {
			$('#hide_div_industry').hide();
			$('.industry-small').show();
			$('#small-industry-blank').hide();
			$('#small-industry-blank').children('select').attr('disabled', 'disabled');
			$('.industry-small').children().hide();
			$('.industry-small').children('select').attr('disabled', 'disabled');
			$('#industry-small-'+industryId).children().show();
			$('#industry-small-'+industryId).children('select').removeAttr('disabled');
		}
	});

	///////////////////////////////////////////////// End ///////////////////////////////////////////////////////////////////////////////////////////

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//// Job Select box Using in Company and Headhunter add ////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$('.sub-job').hide();
	$('#sub-job-'+$('#job option:selected').val()).show();
	$('.sub-job').children('select').attr('disabled', 'disabled');
	$('#sub-job-'+$('#job option:selected').val()).children('select').removeAttr('disabled');

	$('#job').on('change',function() {
		var jobId = $('#job option:selected').val();
		if (jobId == "") {
			$('#hide_div_job').show();
			$('#sub-job-blank').show();
			$('.sub-job').hide();
			$('.sub-job').children('select').attr('disabled', 'disabled');
			$('#sub-job-blank').children('select').removeAttr('disabled');
		} else {
			$('#hide_div_job').hide();
			$('.sub-job').show();
			$('#sub-job-blank').hide();
			$('#sub-job-blank').children('select').attr('disabled', 'disabled');
			$('.sub-job').children().hide();
			$('.sub-job').children('select').attr('disabled', 'disabled');
			$('#sub-job-'+jobId).children().show();
			$('#sub-job-'+jobId).children('select').removeAttr('disabled');
		}
	});

	//////////////////////////////////////////////////////// End ///////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//// Location Select box Using in occupation add ////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	var error_back = $("#error-back").text();

	$('.location-small').hide();
	$('#location-small-'+$('#location-big option:selected').val()).show();
	$('.location-small').children('select').attr('disabled', 'disabled');
	$('#location-small-'+$('#location-big option:selected').val()).children('select').removeAttr('disabled');
	$('#small-location-blank').show();

	if (error_back == 1) {
		$('#small-location-blank').hide();
		$('#small-location-blank').children().attr('disabled', 'disabled');
	} else {
		$('#small-location-blank').show();
		$('#small-location-blank').children().removeAttr('disabled');
	}

	$('#location-big').on('change',function() {
		var locationId = $('#location-big option:selected').val();
		if (locationId == "") {
			$('#small-location-blank').show();
			$('.location-small').hide();
			$('.location-small').children('select').attr('disabled', 'disabled');
			$('#small-location-blank').children('select').removeAttr('disabled');
		} else {
			$('.location-small').show();
			$('#small-location-blank').hide();
			$('#small-location-blank').children('select').attr('disabled', 'disabled');
			$('.location-small').children().hide();
			$('.location-small').children('select').attr('disabled', 'disabled');
			$('#location-small-'+locationId).children().show();
			$('#location-small-'+locationId).children('select').removeAttr('disabled');
		}
	});
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// for job category select box in user page
	$('#hide_div_category').hide();
	$('.small-job').hide();
	$('#small-job-'+$('#big-job option:selected').val()).show();
	$('.small-job').children('select').attr('disabled', 'disabled');
	$('#small-job-'+$('#big-job option:selected').val()).children('select').removeAttr('disabled');
	$('#small-job-blank').show();

	$('#big-job').on('change',function() {
		var jobId = $('#big-job option:selected').val();
		if (jobId == "") {
			$('#hide_div_category').show();
			$('#small-job-blank').show();
			$('.small-job').hide();
			$('.small-job').children('select').attr('disabled', 'disabled');
			$('#small-job-blank').children('select').removeAttr('disabled');
		} else {
			$('#hide_div_category').hide();
			$('.small-job').show();
			$('#small-job-blank').hide();
			$('#small-job-blank').children('select').attr('disabled', 'disabled');
			$('.small-job').children().hide();
			$('.small-job').children('select').attr('disabled', 'disabled');
			$('#small-job-'+jobId).children().show();
			$('#small-job-'+jobId).children('select').removeAttr('disabled');
		}
	});

	$("#search").keyup(function(){
		var str = $('#search').val() ;
		if (str.length == '') {
			location.replace('index');
		};
	});

});

/////////////////////////////////////////One image upload////////////////////////////////////////////////

$("#file-7").on("change", function(evt){
	readURL(this);
});

function readURL(input) {

	// Set the file name
	var file = input.files[0].name;
	if($('#img-name').text() != ""){
		$('#img-name').text(file);
		$('#img-hidden-val').attr('value', file);
	} else {
		$('#img-name').text(file);
		$('#img-hidden-val').attr('value', file);
	}
	$(".resize-img").removeAttr('style');

	// Set the image for preview before upload
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		var targetleft = 0;
		var targettop = 0;
		var t_width = 0;
		var t_height = 0;
		reader.onload = function(e) {
			var image = new Image();
			image.src = e.target.result;
			image.onload = function() {
				var w = this.width;
				var h = this.height;
				var tw = 200;
				var th = 200;
				// compute the new size and offsets
				var result = ScaleImage(w, h, tw, th, true);
				// adjust the image coordinates and size
				t_width = result.width;
				t_height = result.height;
				targetleft = result.targetleft;
				targettop = result.targettop;
				$('#previewHolder').css("width", result.width);
				$('#previewHolder').css('height', result.height);
				$('#previewHolder').attr('src', image.src);
				$('#previewHolder').css("left", targetleft);
				$('#previewHolder').css("top", targettop);
				$('#previewHolder').attr("width", t_width);
				$('#previewHolder').attr("height", t_height);

			};
			$('#previewHolder').parent().attr('class' ,'resize-img').attr('style', 'width: 210px; height: 210px; border: thick solid #666666; overflow: hidden; position: relative;');
			$('#previewHolder').removeClass('hide');
		}
		reader.readAsDataURL(input.files[0]);
	}
}
/////////////////////////////////////////////////End of one image upload //////////////////////////////////

// Three Images Upload Process

/////////////////////////////////////////1st image upload////////////////////////////////////////////////

$("#file-1").on("change", function(){
	readURLf1(this);
});

$("#img-remove1").on("click", function() {
	var error_back = $("#error-back").text();

	if (error_back == 1) {
		$('#img-hidden-val').val('');
	}

	$("#previewHolder1").parents('.resize-img').css('display', 'none');
	var selected = $("#file-1").siblings('.resize-img').children().attr("src");
	$(".removed1" ).val(selected);
	$("#file-1").siblings('span').html("");
	$("#file-1").val("");
	// $(this).remove();
	$('#img-remove1').attr('style', 'display : none');
	$("#previewHolder1").removeAttr("calss src");
	$("#previewHolder1").parents('.resize-img').removeClass("resize-img");
});

function readURLf1(input1) {
	// Set the file name
	var file1 = input1.files[0].name;
	if($('#img1-name').text() != ""){
		$('#img1-name').text(file1);
		$('#img-hidden-val').attr('value', file1);
	} else {
		$('#img1-name').text(file1);
		$('#img-hidden-val').attr('value', file1);
	}

	// Set the image for preview before upload
	if (input1.files && input1.files[0]) {
		var reader1 = new FileReader();
		var targetleft = 0;
		var targettop = 0;
		var t_width = 0;
		var t_height = 0;
		reader1.onload = function(e) {
			var image1 = new Image();
			image1.src = e.target.result;
			image1.onload = function() {
				var w = this.width;
				var h = this.height;
				var tw = 200;
				var th = 200;
				// compute the new size and offsets
				var result = ScaleImage(w, h, tw, th, true);
				// adjust the image coordinates and size
				t_width = result.width;
				t_height = result.height;
				targetleft = result.targetleft;
				targettop = result.targettop;
				$('#previewHolder1').css("width", result.width);
				$('#previewHolder1').css('height', result.height);
				$('#previewHolder1').attr('src', image1.src);
				$('#previewHolder1').css("left", targetleft);
				$('#previewHolder1').css("top", targettop);
				$('#previewHolder1').attr("width", t_width);
				$('#previewHolder1').attr("height", t_height);

			};
			$('#previewHolder1').parent().attr('class' ,'resize-img').attr('style', 'width: 210px; height: 210px; border: thick solid #666666; overflow: hidden; position: relative;');
			$('#previewHolder1').removeClass('hide');
			$('#img-remove1').attr('style', 'display : block');
		}
		reader1.readAsDataURL(input1.files[0]);
	}
}
/////////////////////////////////////////////////End of 1st image upload //////////////////////////////////

/////////////////////////////////////////2nd image upload////////////////////////////////////////////////

$("#file-2").on("change", function(){
	readURLf2(this);
});

$("#img-remove2").on("click", function() {
	var error_back = $("#error-back").text();

	if (error_back == 1) {
		$('#img2-hidden-val').val('');
	}

	$("#previewHolder2").parents('.resize-img').css('display', 'none');
	var selected2 = $("#file-2").siblings('.resize-img').children().attr("src");
	$( ".removed2").val(selected2);
	$("#img2-name").text("");
	$("#file-2").val("");
	// $(this).remove();
	$('#img-remove2').attr('style', 'display : none');
	$("#previewHolder2").parents('.resize-img').removeClass("resize-img");
	$("#previewHolder2").removeAttr("calss src");
});

function readURLf2(input2) {
	// Set the file name
	var file2 = input2.files[0].name;
	if($('#img2-name').text() != ""){
		$('#img2-name').text(file2);
		$('#img-hidden-val').attr('value', file2);
	} else {
		$('#img2-name').text(file2);
		$('#img-hidden-val').attr('value', file2);
	}

	// Set the image for preview before upload
	if (input2.files && input2.files[0]) {
		var reader2 = new FileReader();
		var targetleft = 0;
		var targettop = 0;
		var t_width = 0;
		var t_height = 0;
		reader2.onload = function(e) {
			var image2 = new Image();
			image2.src = e.target.result;
			image2.onload = function() {
				var w = this.width;
				var h = this.height;
				var tw = 200;
				var th = 200;
				// compute the new size and offsets
				var result = ScaleImage(w, h, tw, th, true);
				// adjust the image coordinates and size
				t_width = result.width;
				t_height = result.height;
				targetleft = result.targetleft;
				targettop = result.targettop;
				$('#previewHolder2').css("width", result.width);
				$('#previewHolder2').css('height', result.height);
				$('#previewHolder2').attr('src', image2.src);
				$('#previewHolder2').css("left", targetleft);
				$('#previewHolder2').css("top", targettop);
				$('#previewHolder2').attr("width", t_width);
				$('#previewHolder2').attr("height", t_height);

			};
			$('#previewHolder2').parent().attr('class' ,'resize-img').attr('style', 'width: 210px; height: 210px; border: thick solid #666666; overflow: hidden; position: relative;');
			$('#previewHolder2').removeClass('hide');
			$('#img-remove2').attr('style', 'display : block');
		}
		reader2.readAsDataURL(input2.files[0]);
	}
}
//////////////////////////////////////////End of 2nd image upload//////////////////////////////////////

/////////////////////////////////////////3rd image upload////////////////////////////////////////////////

$("#file-3").on("change", function(){
	readURLf3(this);
});

$("#img-remove3").on("click", function() {
	var error_back = $("#error-back").text();

	if (error_back == 1) {
		$('#img3-hidden-val').val('');
	}

	$("#previewHolder3").parents('.resize-img').css('display', 'none');
	var selected3 = $("#file-3").siblings('.resize-img').children().attr("src");
	$(".removed3").val(selected3);
	$("#img3-name").text("");
	$("#file-3").val("");
	// $(this).remove();
	$('#img-remove3').attr('style', 'display : none');
	$("#previewHolder3").parents('.resize-img').removeClass("resize-img");
	$("#previewHolder3").removeAttr("calss src");
});

function readURLf3(input3) {
	// Set the file name
	var file3 = input3.files[0].name;
	if($('#img3-name').text() != ""){
		$('#img3-name').text(file3);
		$('#img-hidden-val').attr('value', file3);
	} else {
		$('#img3-name').text(file3);
		$('#img-hidden-val').attr('value', file3);
	}

	// Set the image for preview before upload
	if (input3.files && input3.files[0]) {
		var reader3 = new FileReader();
		var targetleft = 0;
		var targettop = 0;
		var t_width = 0;
		var t_height = 0;
		reader3.onload = function(e) {
			var image3 = new Image();
			image3.src = e.target.result;
			image3.onload = function() {
				var w = this.width;
				var h = this.height;
				var tw = 200;
				var th = 200;
				// compute the new size and offsets
				var result = ScaleImage(w, h, tw, th, true);
				// adjust the image coordinates and size
				t_width = result.width;
				t_height = result.height;
				targetleft = result.targetleft;
				targettop = result.targettop;
				$('#previewHolder3').css("width", result.width);
				$('#previewHolder3').css('height', result.height);
				$('#previewHolder3').attr('src', image3.src);
				$('#previewHolder3').css("left", targetleft);
				$('#previewHolder3').css("top", targettop);
				$('#previewHolder3').attr("width", t_width);
				$('#previewHolder3').attr("height", t_height);

			};
			$('#previewHolder3').parent().attr('class' ,'resize-img').attr('style', 'width: 210px; height: 210px; border: thick solid #666666; overflow: hidden; position: relative;');
			$('#previewHolder3').removeClass('hide');
			$('#img-remove3').attr('style', 'display : block');
		}
		reader3.readAsDataURL(input3.files[0]);
	}
}

function ScaleImage(srcwidth, srcheight, targetwidth, targetheight, fLetterBox) {
	var result = { width: 0, height: 0, fScaleToTargetWidth: true };

	if ((srcwidth <= 0) || (srcheight <= 0) || (targetwidth <= 0) || (targetheight <= 0)) {
		return result;
	}

	// scale to the target width
	var scaleX1 = targetwidth;
	var scaleY1 = (srcheight * targetwidth) / srcwidth;

	// scale to the target height
	var scaleX2 = (srcwidth * targetheight) / srcheight;
	var scaleY2 = targetheight;

	// now figure out which one we should use
	var fScaleOnWidth = (scaleX2 > targetwidth);
	if (fScaleOnWidth) {
		fScaleOnWidth = fLetterBox;
	}
	else {
		fScaleOnWidth = !fLetterBox;
	}

	if (fScaleOnWidth) {
		result.width = Math.floor(scaleX1);
		result.height = Math.floor(scaleY1);
		result.fScaleToTargetWidth = true;
	}
	else {
		result.width = Math.floor(scaleX2);
		result.height = Math.floor(scaleY2);
		result.fScaleToTargetWidth = false;
	}
	result.targetleft = Math.floor((targetwidth - result.width) / 2);
	result.targettop = Math.floor((targetheight - result.height) / 2);
	return result;
}

function OnImageLoad() {
	var img = $('.preview');
	if (img.length != 0) {
		// what's the size of this image and it's parent
		var w = parseInt($(img).css("width").replace('px',''));
		var h = parseInt($(img).css("height").replace('px',''));
		var tw = $(img).parent().width();
		var th = $(img).parent().height();
		// compute the new size and offsets
		var result = ScaleImage(w, h, tw, th, true);
		// adjust the image coordinates and size
		img.css("width", result.width);
		img.css('height', result.height);
		$(img).css("left", result.targetleft);
		$(img).css("top", result.targettop);
	}
}
//////////////////////////////////////////////////End of 3rd image upload//////////////////////////////////////

$(document).ready(function() {
	OnImageLoad();
	//Validation
	$("#imageSubmit").on('click', function(){
		var error = 0;
		var val = [];

		var company = $('#companyName').val();
		var companyDisable = $('#companyName').prop('disabled');
		var address = $('#address').val();
		var image = $('#file-7').val();
		var coImage = '';

		// Image validation not empty
			if ($('#CmpHeadhunterCologo').length) {
				coImage = $('#CmpHeadhunterCologo').val();
			}

			if ($('#img-hidden-val').length) {
				coImage = $('#img-hidden-val').val();
			}

			if ($('#SubHeadhunterCologo').length) {
				coImage = $('#SubHeadhunterCologo').val();
			}

			if (!image && !coImage){
				$('#imageValidate').css('display','block');
				error = 1;
			} else {
				$('#imageValidate').hide();
			}
		// Image validation not empty

		// company
		if (!company && !companyDisable) {
			$('#companyValidate').css('display','block');
			error = 1;
		} else {
			$('#companyValidate').hide();
		}

		// address
		if (!address) {
			$('#addressValidate').css('display','block');
			error = 1;
		} else {
			$('#addressValidate').hide();
		}

		// industry big and small
		if ($('#industry-big').length) {
			var bigIndustry = $('#industry-big').val();

			if (!bigIndustry) {
				$('#industryValidate').css('display','block');
				error = 1;
			} else {

				var smallIndustry = $('#industry-small-' + bigIndustry).children().val();
				if (smallIndustry) {
					$('#industryValidate').hide();
				} else {
					$('#industryValidate').css('display','block');
					error = 1;
				}
			}
		}

		// headhunter
		if ($('#headhunter').length) {
			var headhunter = $('#headhunter').val();

			if (!headhunter) {
				$('#headhunterValidate').css('display', 'block');
				error = 1;
			} else {
				$('#headhunterValidate').hide();
			}
		}

		// education
		if ($('#education').length) {
			var education = $('#education').val();

			if (!education) {
				$('#educationValidate').css('display', 'block');
				error = 1;
			} else {
				$('#educationValidate').hide();
			}
		}

		// industry
		if ($('#industry').length) {
			// get the checked value of the checkboxes by parent's class.
			$('.checkboxes input:checked').each(function(i){
				val[i] = $(this).val();
			});

			if (val.length === 0) {
				$('#industryValidate').css('display', 'block');
				error = 1;
			} else {
				$('#industryValidate').hide();
			}
		}

		// company phone number
		if ($('#phoneMain').length) {
			var phoneMain = $('#phoneMain').val();

			if (!phoneMain) {
				$('#phoneMainValidate').css('display', 'block');
				$('#phoneMainValidate').css('padding-left', '9%');
				error = 1;
			} else {
				$('#phoneMainValidate').hide();
			}
		}

		// Reprensitive Position
		if ($('#rPosition').length) {
			var rPosition = $('#rPosition').val();

			if (!rPosition) {
				$('#positionValidate1').css('display', 'block');
				$('#positionValidate1').css('padding-left', '9%');
				error = 1;
			} else {
				$('#positionValidate1').hide();
			}
		}

		// Reprensitive Name
		if ($('#rName').length) {
			var rName = $('#rName').val();

			if (!rName) {
				$('#nameValidate1').css('display', 'block');
				$('#nameValidate1').css('padding-left', '9%');
				error = 1;
			} else {
				$('#nameValidate1').hide();
			}
		}

		// Contact Position
		if ($('#cPosition').length) {
			var cPosition = $('#cPosition').val();

			if (!cPosition) {
				$('#positionValidate2').css('display', 'block');
				$('#positionValidate2').css('padding-left', '9%');
				error = 1;
			} else {
				$('#positionValidate2').hide();
			}
		}

		// Contact Name
		if ($('#cName').length) {
			var cName = $('#cName').val();

			if (!cName) {
				$('#nameValidate2').css('display', 'block');
				$('#nameValidate2').css('padding-left', '9%');
				error = 1;
			} else {
				$('#nameValidate2').hide();
			}
		}

		// Email not empty and pattern
		if ($('#email').length) {
			var email = $('#email').val();
			if (!email) {
				$('#emailValidate').css('display', 'block');
				$('#emailValidate').css('padding-left', '9%');
				error = 1;
			} else {
				if (email.indexOf('@') == -1) {
					$('#emailValidate').css('display', 'block');
					$('#emailValidate').text('Email address is wrong.');
					$('#emailValidate').css('padding-left', '9%');
					error = 1;
				} else {
					$('#emailValidate').hide();
				}
			}
		}

		// Contact email
		if ($('#emailAdd').length) {
			var emailAdd = $('#emailAdd').val();
			if (!emailAdd) {
				$('#emailAddValidate').css('display', 'block');
				error = 1;
			} else {
				if (emailAdd.indexOf('@') == -1) {
					$('#emailAddValidate').css('display', 'block');
					$('#emailAddValidate').text('Email address is wrong.');
					error = 1;
				} else {
					$('#emailAddValidate').hide();
				}
			}
		}

		// Number of employee
		if ($('#numberOfEmp').length) {
			var numberOfEmp = $('#numberOfEmp').val();

			if (!numberOfEmp) {
				$('#empValidate').css('display', 'block');
				error = 1;
			} else {
				$('#empValidate').hide();
			}
		}

		// Password
		if ($('#password').length) {
			var password = $('#password').val();
			if (!password) {
				$('#passwordValidate').css('display', 'block');
				error = 1;
			} else {
				$('#passwordValidate').hide();
			}
		}

		// Confirm password
		if ($('#passwordConfirm').length) {
			var passwordConfirm = $('#passwordConfirm').val();
			if (!passwordConfirm) {
				$('#passwordConfirmValidate').css('display', 'block');
				error = 1;
			} else {
				$('#passwordConfirmValidate').hide();
			}
		}

		if (error === 1) {
			// scroll to the top of the page without onload.
			$(document).scrollTop(0);
			return false;
		}
	});
});