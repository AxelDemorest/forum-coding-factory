$(document).ready(function() {
    $(".description-website").hover(
        function() {
            $(this).find(".hr-body").css("width", "15em");
        },
        function() {
            $(this).find(".hr-body").css("width", "8em");
        }
    );
});