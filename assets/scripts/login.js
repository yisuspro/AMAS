(function ($) {
    $("#frm_login").submit(function (ev) {
        ev.preventDefault();
        $.ajax({
            url: 'users/login',
            type: 'POST',
            data: $(this).serialize(),
            success: function (data, xhr) {
                
                var rute = 'users/profileUser';
                window.location.href = rute;
            },
            error: function (xhr) {
                if (xhr.status == 401) {

                    var json = JSON.parse(xhr.responseText);
                    alert('error = ' + json);

                } else if (xhr.status == 402) {

                }
            },

        });
    });
})(jQuery)