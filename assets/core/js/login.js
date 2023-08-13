$("#form-login").submit(function (e) {
    e.preventDefault();

    $.ajax({
        url: baseUrl + '/api/auth/login',
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        data: {},
        success: function () { },
        error: function () { },
    });
});