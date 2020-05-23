$('document').ready(function() {
    var email_state = false;
    var username_state = false;

    $('#update_account').on('click', function() {
        var profile_name = $('#p_name').val();
        var last_name    = $('#p_last').val();
        var rate         = $('#rate').val();
        var position     = $('#position').val();
        var country      = $('#country').val();
        var description  = $('#description').val();
        var cover_letter = $('#upload').val();
        var resume       = $('#resumeUpload').val();
        var skills       = $('#skills').val();
        var password     = $('#n_password').val();
        var user_id      = $('#employer-radio').val();    

        $.ajax({
            url: xperts_register.ajaxurl,
            type: 'post',
            data: {
                'action'        : 'update_account',
                'update_account': true,
                'user_id'       : user_id,
                'profile_name'  : profile_name,
                'last_name'     : last_name,
                'rate'          : rate,
                'position'      : position,
                'country'       : country,
                'description'   : description,
                'cover_letter'  : cover_letter,
                'resume'        : resume,
                'skills'        : skills,
                'address'       : '',
                'city'          : '',
                'postalcode'    : '',
            },
            success: function(data) {
                if (data == 'success') {
                    var r = confirm("Successfully updated!");
                    if (r == true){
                    window.location.reload();
                    }
                } else{
                    alert('Failed! Please try again.');
                }
            }
        });
    });
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