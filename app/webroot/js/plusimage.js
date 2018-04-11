$(function () {
    $("form").on('change', '.fileupload', function () {
        if (typeof (FileReader) != "undefined") {
            var dvPreview = $(this).siblings('.dvPreview');
            dvPreview.html("");
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            $($(this)[0].files).each(function () {
                var file = $(this);
                if (regex.test(file[0].name.toLowerCase())) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var img = $("<span class=\"pip\">" +
                        "<img class=\"imagethum\" src=\"" + e.target.result + "\"/>" +
                        "<br/>"+
                        "<span class='removeLink'>"+
                        "<span class=\"remove_image\"></span>" +
                        "Delete photo"+
                        "</span>"+
                        "</span>");
                        // img.attr("style", "height:80px;width: 80px;border: 1px solid #c0c0c0;border-radius:3px;box-shadow: 0px 0px 1px 0px;");
                        // img.attr("src", e.target.result);
                        dvPreview.append(img);
                        $('.remove_image,.removeLink').click(function(e) {
                            $(this).closest('.dvPreview').siblings('.fileupload').val("");
                            // ('.fileupload').val("");
                            $(this).parent(".pip").remove();
                        });
                        //   $(".remove").click(function(){
                        //   $(this).parent(".pip").remove();
                        //   // $(this).closest('div').slideUp('slow', function(){$(this).remove();});
                        // });
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
function show(target){
document.getElementById(target).style.display = 'block';
}
function hide(target){
document.getElementById(target).style.display = 'none';
}