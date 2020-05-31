$('document').ready(function() {
    var email_state = false;
    var username_state = false;
    var skills = new Array();
    $('#n_password').prop('readonly', true);
    $('#r_password').prop('readonly', true);
    $('#user_email').prop('readonly', true);

    $('#update_account').on('click', function() {
        
        var profile_name = $('#p_name').val();
        var last_name    = $('#p_last').val();
        var rate         = $('#rate').val();
        var position     = $('#position').val();
        var country      = $('#country').val();
        var description  = $('#description').val();
        var cover_letter = $('#upload').val();
        var resume       = $('#resumeUpload').val();
        var password     = $('#n_password').val();
        var con_p        = $('#r_password').val();
        var user_id      = $('#employer-radio').val(); 
        var button       = $('#update_account');
        var new_cover    = cover_letter.replace("C:\\fakepath\\", "");
     
        if( (password.length > 0) ||  (con_p.length > 0) ){
       
        if(password == ''){
            confirm("Please enter new password!");
            event.preventDefault(); die();
        }

        if(con_p == ''){
            confirm("Please enter confirm password!");
            event.preventDefault(); die();
        }

        if(con_p !== password){
            confirm("Confirm password doesn't match with new password!");
            event.preventDefault(); die();
        }
    }
        
        //get the skills tags
        $('.keyword-text').each(function() {
            skills.push($(this).text());
        });   
        
        $.ajax({
            url: xperts_register.ajaxurl,
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
                'cover_letter'  : new_cover,
                'resume'        : resume,
                'skills'        : skills,
                'password'      : password,
                'address'       : '',
                'city'          : '',
                'postalcode'    : '',
            },
            type: 'post',
            beforeSend: function(xhr) {
                button.text('Saving...');
            },
            success: function(data) {
                if (data == 'success') {
                    button.text('Saved');
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
                    $('#user_email').prop('readonly', true);
                    $('#login_Register').prop('disabled', true);
                } else if (data == 'not_taken') {
                    username_state = true;
                    $('#user_name').parent().removeClass();
                    $('#user_name').parent().addClass("input-with-icon-left form_success");
                    $('#user_email').prop('readonly', false);
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
        var button  = $(this);
        var email = $('#user_email').val();
        var username = $('#user_name').val();
        var pass_1 = $('#password-register').val();
        var pass_2 = $('#password-repeat-register').val();

        if( username == ''){
             confirm("Please enter Username!");
            event.preventDefault(); die();
        }

        if( email == ''){
             confirm("Please enter Email!");
            event.preventDefault(); die();
        }

        if( pass_1 == ''){
             confirm("Please enter Password!");
            event.preventDefault(); die();
        }

        if( pass_2 == ''){
             confirm("Please Confirm Password!");
            event.preventDefault(); die();
        }

        if( pass_2 !== pass_1){
             confirm("Confirm password doesn't match with password!");
            event.preventDefault(); die();
        }
        $.ajax({
            url: xperts_register.ajaxurl,
            type: 'post',
            data: {
                'action'  : 'freelance_register',
                'username': username,
                'email'   : email,
                'password':pass_1,
                'register': true,
            },
            beforeSend: function(xhr) {
                button.text('Processing...');
            },
            success: function(data) {
                 if (data == 'success') {
                    button.text('Saved');
                    var r = confirm("Successfully Registered! Check your Email for confirmation.");
                    if (r == true){
                    window.location.reload();
                    }
                } else{
                    alert('Failed! Please try again.');
                }
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

    //set password validation
    $('#c_password').bind('keyup change', function() {
        var c_password = $(this).val();
        if (c_password == '') {
            return;
        }
        $.ajax({
            url: xperts_register.ajaxurl,
            type: 'post',
            data: {
                'action'     : 'password_check',
                'check_pass' : true,
                'password'   : c_password,
            },
            success: function(data) {
                if (data == 'true') {
                    $('#n_password').prop('readonly', false);
                    $('#r_password').prop('readonly', false);
                } else if (data == 'false') {
                    $('#n_password').prop('readonly', true);
                    $('#r_password').prop('readonly', true);
                }
            }
        });
    });

     $('#r_password').bind('keyup', function() {
         var confirm_pass  =  $(this).val();
         var new_pass      =  $('#n_password').val();
          if (new_pass == '') {
             $('#update_account').prop('disabled', true);
          }
          if(confirm_pass !== new_pass){
              $('#update_account').prop('disabled', true);
          }else{
              $('#update_account').prop('disabled', false);
          }
     });
});