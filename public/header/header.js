$(document).ready(function() {
    $(".nav-item").hover(
        function() {
            $(this).children(".border-li").css("width", "40px");
        },
        function() {
            $(this).children(".border-li").css("width", "20px");
        }
    );
});




