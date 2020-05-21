$('document').ready(function() {
    var email_state = false;
    var username_state = false;

    // $('a').on('click', function() {
    //     var username = $('#v-pills-2-tab').val();
    //     if (username == '') {
    //         username_state = false;
    //         return;
    //     }
    //     // $("button").attr("aria-expanded","true");
    //     console.log('true');
    //     $.ajax({
    //         url: 'register.php',
    //         type: 'post',
    //         data: {
    //             'username_check': 1,
    //             'username': username,
    //         },
    //         success: function(response) {
    //             if (response == 'taken') {
    //                 username_state = false;
    //                 $('#username').parent().removeClass();
    //                 $('#username').parent().addClass("form_error");
    //                 $('#username').siblings("span").text('Sorry... Username already taken');
    //             } else if (response == 'not_taken') {
    //                 username_state = true;
    //                 $('#username').parent().removeClass();
    //                 $('#username').parent().addClass("form_success");
    //                 $('#username').siblings("span").text('Username available');
    //             }
    //         }
    //     });
    // });
    $('#user_name').bind('keyup change', function() {
        var username = $('#user_name').val();
        if (username == '') {
            username_state = false;
            return;
        }
        $.ajax({
            url: xperts_register.ajaxurl,
            type: 'post',
            data: {
                'action': 'username_check',
                'username': username,
            },
            success: function(data) {
                if (data == 'taken') {
                    username_state = false;
                    $('#user_name').parent().removeClass();
                    $('#user_name').parent().addClass("input-with-icon-left form_error");
                    $('#login_Register').prop('disabled', true);
                } else if (data == 'not_taken') {
                    username_state = true;
                    $('#user_name').parent().removeClass();
                    $('#user_name').parent().addClass("input-with-icon-left form_success");
                    $('#login_Register').prop('disabled', false);
                }
            }
        });
    });

    $('#user_email').bind('keyup change', function() {
        var email = $('#user_email').val();
        if (email == '') {
            email_state = false;
            return;
        }
        $.ajax({
            url: xperts_register.ajaxurl,
            type: 'post',
            data: {
                'action': 'email_check',
                'email': email,
            },
            success: function(data) {
                if (data == 'taken') {
                    username_state = false;
                    $('#user_email').parent().removeClass();
                    $('#user_email').parent().addClass("input-with-icon-left form_error");
                    $('#freelance_Register').prop('disabled', true);
                } else if (data == 'not_taken') {
                    username_state = true;
                    $('#user_email').parent().removeClass();
                    $('#user_email').parent().addClass("input-with-icon-left form_success");
                    $('#freelance_Register').prop('disabled', false);
                }
            }
        });
    });

    $('#freelance_Register').click(function() {
        var email = $('#user_email').val();
        var username = $('#user_name').val();
        $.ajax({
            url: xperts_register.ajaxurl,
            type: 'post',
            data: {
                'action': 'freelance_register',
                'username': username,
                'email': email,
                'register': true,
            },
            success: function(data) {
                alert(data);
            }
        });
    });
    $("#freelancer-radio").click(function() {

        $("#register-account-form").toggle();
        $("#freelance_Register").toggle();
        $("#Employer_Register").hide();

    });
    $("#employer-radio").click(function() {

        $("#register-account-form").toggle();
        $("#Employer_Register").toggle();
        $("#freelance_Register").hide();

    });
    $('#companyEmail').bind('keyup change', function() {
        var company_email = $('#companyEmail').val();
        if (company_email == '') {
            company_email_state = false;
            return;
        }
        $.ajax({
            url: ajax_object.ajaxurl,
            type: 'post',
            data: {
                'action': 'company_email_check',
                'company_email': company_email,
            },
            success: function(data) {
                console.log(data);
                if (data == 'taken') {
                    email_state = false;
                    $('#companyEmail').parent().removeClass();
                    $('#companyEmail').parent().addClass("col-md-12 mb-3 mb-md-0 form_error");
                    $('#companyEmail').siblings("span").text('Sorry... Email already taken');
                    $('#Company_register').prop('disabled', true);
                } else if (data == 'not_taken') {
                    email_state = true;
                    $('#companyEmail').parent().removeClass();
                    $('#companyEmail').parent().addClass("col-md-12 mb-3 mb-md-0 form_success");
                    $('#companyEmail').siblings("span").text('Email available!');
                    $('#Company_register').prop('disabled', false);
                }
            }
        });
    });
});