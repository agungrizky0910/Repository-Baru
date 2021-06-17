const inputs = document.querySelectorAll(".input");

function addcl() {
    let parent = this.parentNode.parentNode;
    parent.classList.add("focus");
}

function remcl() {
    let parent = this.parentNode.parentNode;
    if (this.value == "") {
        parent.classList.remove("focus");
    }
}

inputs.forEach((input) => {
    input.addEventListener("focus", addcl);
    input.addEventListener("blur", remcl);
});

(function($) {
    ("use strict");
    // Page loading animation
    $(window).on("load", function() {
        if ($(".cover").length) {
            $(".cover").parallax({
                imageSrc: $(".cover").data("image"),
                zIndex: "1",
            });
        }

        $("#preloader").animate({
                opacity: "0",
            },
            600,
            function() {
                setTimeout(function() {
                    $("#preloader").css("visibility", "hidden").fadeOut();
                }, 300);
            }
        );
    });
})(window.jQuery);