$("#form-register").submit(function (e) {
    $.ajax({
        url: baseUrl + '/api/user/register',
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
            "Authorization": "Bearer " + JSON.parse(localStorage.getItem("token"))
        },
        data: {},
        success: function () { },
        error: function () { },
    });
});