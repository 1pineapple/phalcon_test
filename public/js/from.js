$(document).ready(() => {
    let formLogic = (data)=>{
        if (data.error) {
            if (!data.db) {
                for (const item of data.message) {
                    let error = $($($("#" + item.field).parent()).find('.error'));
                    $(error).css("display", "block");
                    $(error).empty();
                    $(error).append('<p>' + item.message + '</p>');
                }
            } else {
                $(".messages").css("display", "block");
                for (const item of data.message) {
                    $(".messages").append('<div class="alert alert-danger">'+item+'</div>');
                }
            }
        } else {
            $(".messages").css("display", "block");
            $(".messages").append('<div class="alert alert-success">'+data.message+'</div>');
            setTimeout(() => window.location.href = "/users/index", 1500);
        }
    };
    $("#create-form").on('submit', function(e) {
        e.preventDefault();
        $(".error").css( "display", "none" );
        $(".messages").css( "display", "none" );
        $(".messages").empty();
        $.ajax({
            method: "POST",
            url: "/users/create",
            data: $(this).serialize()
        }).done((data) => {
            formLogic(data);
        });
    });
    $("#save-form").on('submit', function(e) {
        e.preventDefault();
        $(".error").css( "display", "none" );
        $(".messages").css( "display", "none" );
        $(".messages").empty();
        $.ajax({
            method: "POST",
            url: "/users/save",
            data: $(this).serialize()
        }).done((data) => {
            formLogic(data);
        });
    });
});