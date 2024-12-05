$(document).ready(function () {

    $("#back").on('click', function (e) {
        activarLogoCarga();
        e.preventDefault();
        $(".area-trabajo").load('consultarUsersAppsView', function () {
            cerrarLogoCarga();
        });
    });
});