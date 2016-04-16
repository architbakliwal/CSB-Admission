var emailregex = "^[_A-Za-z0-9-\\+]+(\\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$";
var alphabetsregex = "^[A-z]+$";
/*  --------------------------------------------------
    :: Tooltips
    -------------------------------------------------- */
jQuery.noConflict()(function($) {
    $(document).ready(function() {
        $('input, select').each(function(index, element) {
            $(this).attr('title', $(this).attr('placeholder'));
        });

        $('input, select').tooltipster({
            offsetY: 2,
            position: 'top'
        });

        $('#tooltip-help').tooltipster({
            iconDesktop: true,
            iconTouch: true
        });

        // $(document).ajaxStop($('input, select').tooltipster('hide'));

        $.validator.addMethod(
            "regexemail",
            function(value, element, regexp) {
                var check = false;
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            }, "Please enter a valid email id"
        );

        $.validator.addMethod(
            "regexalpha",
            function(value, element, regexp) {
                var check = false;
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            }, "Only Alphabets allowed"
        );
    });
});



/*  --------------------------------------------------
    :: Activation Form
    -------------------------------------------------- */

jQuery.noConflict()(function($) {
    $(document).ready(function() {
        $('#activation-form').validate({
            rules: {},
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: '#activation-message',
                    success: function() {
                        $('#activation-message').fadeIn(500);
                    },
                });
            }
        });
    });
});

/*  --------------------------------------------------
    :: Complete Social Register Form
    -------------------------------------------------- */

jQuery.noConflict()(function($) {
    $(document).ready(function() {
        $('#complete-social-register-form input').tooltipster({
            trigger: 'custom',
            onlyOne: true,
            position: 'top'
        });

        $('#complete-social-register-form').validate({
            onfocusout: false,
            rules: {
                useremail: {
                    required: true,
                    regexemail: emailregex
                }
            },
            errorPlacement: function(error, element) {
                $(element).tooltipster('update', $(error).text());
                $(element).tooltipster('show');
            },
            success: function(label, element) {
                $(element).tooltipster('hide');
            },
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: '#complete-social-register-message',
                    beforeSubmit: function() {
                        $('#complete-social-register-button').attr('disabled', 'disabled');
                    },
                    success: function() {
                        $('#complete-social-register-button').removeAttr('disabled');
                        $('#complete-social-register-message').fadeIn(500).delay(10000).fadeOut();
                        $('#complete-social-register-form').each(function() {
                            this.reset();
                        });
                    },
                });
            }
        });
    });
});

/*  --------------------------------------------------
    :: Forgot Form
    -------------------------------------------------- */

jQuery.noConflict()(function($) {
    $(document).ready(function() {
        $('#forgot-form input').tooltipster({
            trigger: 'custom',
            onlyOne: true,
            position: 'top'
        });

        $('#forgot-form').validate({
            onfocusout: false,
            rules: {
                useremail: {
                    required: true,
                    regexemail: emailregex
                },
                captcha: {
                    required: true,
                    remote: 'php/captcha/processor-captcha.php'
                }
            },
            errorPlacement: function(error, element) {
                $(element).tooltipster('update', $(error).text());
                $(element).tooltipster('show');
            },
            success: function(label, element) {
                $(element).tooltipster('hide');
            },
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: '#forgot-message',
                    beforeSubmit: function() {
                        $('#forgot-button').attr('disabled', 'disabled');
                    },
                    success: function() {
                        $('#forgot-button').removeAttr('disabled');
                        $('#forgot-message').fadeIn(500).delay(10000).fadeOut();
                        $('#forgot-form').each(function() {
                            this.reset();
                        });
                    },
                });
            }
        });
    });
});

/*  --------------------------------------------------
    :: Login Form
    -------------------------------------------------- */

jQuery.noConflict()(function($) {
    $(document).ready(function() {
        $('#login-form input').tooltipster({
            trigger: 'custom',
            onlyOne: true,
            position: 'top'
        });

        $('#login-form').validate({
            onfocusout: false,
            onkeyup: false,
            rules: {
                username: {
                    required: true,
                },
                password: {
                    required: true,
                    minlength: 8
                },
                captcha: {
                    required: true,
                    remote: 'php/captcha/processor-captcha.php'
                }
            },
            errorPlacement: function(error, element) {
                $(element).tooltipster('update', $(error).text());
                $(element).tooltipster('show');
            },
            success: function(label, element) {
                $(element).tooltipster('hide');
            },
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: '#login-message',
                    beforeSubmit: function() {
                        $('#login-button').attr('disabled', 'disabled');
                    },
                    success: function() {
                        $('#login-button').removeAttr('disabled');
                        $('#login-message').fadeIn(500).delay(10000).fadeOut();
                        $('#login-form').each(function() {
                            this.reset();
                        });
                    },
                });
            }
        });
    });
});

/*  --------------------------------------------------
    :: New Password Form
    -------------------------------------------------- */

jQuery.noConflict()(function($) {
    $(document).ready(function() {
        $('#newpassword-form input').tooltipster({
            trigger: 'custom',
            onlyOne: true,
            position: 'top'
        });

        $('#newpassword-form').validate({
            onfocusout: false,
            rules: {
                password: {
                    required: true,
                    minlength: 8
                },
                retypepassword: {
                    required: true,
                    equalTo: '#password'
                },
            },
            errorPlacement: function(error, element) {
                $(element).tooltipster('update', $(error).text());
                $(element).tooltipster('show');
            },
            success: function(label, element) {
                $(element).tooltipster('hide');
            },
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: '#newpassword-message',
                    beforeSubmit: function() {
                        $('#newpassword-button').attr('disabled', 'disabled');
                    },
                    success: function() {
                        $('#newpassword-button').removeAttr('disabled');
                        $('#newpassword-message').fadeIn(500).delay(10000).fadeOut();
                        $('#newpassword-form').each(function() {
                            this.reset();
                        });
                    },
                });
            }
        });
    });
});

/*  --------------------------------------------------
    :: Register Form
    -------------------------------------------------- */

jQuery.noConflict()(function($) {
    $(document).ready(function() {
        $('#register input').tooltipster({
            trigger: 'custom',
            onlyOne: true,
            position: 'top'
        });

        $('#register select').tooltipster({
            trigger: 'custom',
            onlyOne: true,
            position: 'top'
        });

        $('#register').validate({
            onfocusout: false,
            onkeyup: false,
            rules: {
                program: {
                    required: true,
                },
                firstname: {
                    required: true,
                    regexalpha: alphabetsregex
                },
                lastname: {
                    required: true
                },
                middlename: {
                    regexalpha: alphabetsregex
                },
                useremail: {
                    required: true,
                    regexemail: emailregex
                },
                mobile: {
                    required: true,
                    number: true,
                    minlength: 10
                },
                city: {
                    required: true,
                    regexemail: alphabetsregex
                },
                password: {
                    required: true,
                    minlength: 8
                },
                retypepassword: {
                    required: true,
                    equalTo: '#password'
                },
                captcha: {
                    required: true,
                    remote: 'php/captcha/processor-captcha.php'
                }
            },
            errorPlacement: function(error, element) {
                $(element).tooltipster('update', $(error).text());
                $(element).tooltipster('show');
            },
            success: function(label, element) {
                $(element).tooltipster('hide');
            },
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: '#register-message',
                    beforeSubmit: function() {
                        $('#register-button').attr('disabled', 'disabled');
                    },
                    success: function(responseText) {
                        $('#register-button').removeAttr('disabled');
                        $('#register-message').fadeIn(500);
                        $('#register').each(function() {
                            this.reset();
                        });
                    },
                });
            }
        });

    });
});

/*  --------------------------------------------------
    :: Resend Form
    -------------------------------------------------- */

jQuery.noConflict()(function($) {
    $(document).ready(function() {
        $('#resend-form input').tooltipster({
            trigger: 'custom',
            onlyOne: true,
            position: 'top'
        });

        $('#resend-form').validate({
            onfocusout: false,
            rules: {
                useremail: {
                    required: true,
                    regexemail: emailregex
                },
                captcha: {
                    required: true,
                    remote: 'php/captcha/processor-captcha.php'
                }
            },
            errorPlacement: function(error, element) {
                $(element).tooltipster('update', $(error).text());
                $(element).tooltipster('show');
            },
            success: function(label, element) {
                $(element).tooltipster('hide');
            },
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: '#resend-message',
                    beforeSubmit: function() {
                        $('#resend-button').attr('disabled', 'disabled');
                    },
                    success: function() {
                        $('#resend-button').removeAttr('disabled');
                        $('#resend-message').fadeIn(500).delay(10000).fadeOut();
                        $('#resend-form').each(function() {
                            this.reset();
                        });
                    },
                });
            }
        });
    });
});

/*  --------------------------------------------------
    :: Update Account Info Form
    -------------------------------------------------- */

jQuery.noConflict()(function($) {
    $(document).ready(function() {
        $('#update-account-form input').tooltipster({
            trigger: 'custom',
            onlyOne: true,
            position: 'top'
        });

        $('#update-account-form').validate({
            onfocusout: false,
            rules: {
                update_firstname: {
                    required: true,
                },
                update_lastname: {
                    required: true,
                },
            },
            errorPlacement: function(error, element) {
                $(element).tooltipster('update', $(error).text());
                $(element).tooltipster('show');
            },
            success: function(label, element) {
                $(element).tooltipster('hide');
            },
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: '#update-account-message',
                    beforeSubmit: function() {
                        $('#update-account-button').attr('disabled', 'disabled');
                    },
                    success: function() {
                        $('#update-account-button').removeAttr('disabled');
                        $('#update-account-message').fadeIn(500).delay(10000).fadeOut();
                    },
                });
            }
        });
    });
});

/*  --------------------------------------------------
    :: Update Email Form
    -------------------------------------------------- */

jQuery.noConflict()(function($) {
    $(document).ready(function() {
        $('#update-email-form input').tooltipster({
            trigger: 'custom',
            onlyOne: true,
            position: 'top'
        });

        $('#update-email-form').validate({
            onfocusout: false,
            rules: {
                update_email: {
                    required: true,
                    regexemail: emailregex
                },
            },
            errorPlacement: function(error, element) {
                $(element).tooltipster('update', $(error).text());
                $(element).tooltipster('show');
            },
            success: function(label, element) {
                $(element).tooltipster('hide');
            },
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: '#update-email-message',
                    beforeSubmit: function() {
                        $('#update-email-button').attr('disabled', 'disabled');
                    },
                    success: function() {
                        $('#update-email-button').removeAttr('disabled');
                        $('#update-email-message').fadeIn(500).delay(10000).fadeOut();
                    },
                });
            }
        });
    });
});

/*  --------------------------------------------------
    :: Update Password Form
    -------------------------------------------------- */

jQuery.noConflict()(function($) {
    $(document).ready(function() {
        $('#update-password-form input').tooltipster({
            trigger: 'custom',
            onlyOne: true,
            position: 'top'
        });

        $('#update-password-form').validate({
            onfocusout: false,
            rules: {
                update_password: {
                    required: true,
                    minlength: 8
                },
                update_retypepassword: {
                    required: true,
                    equalTo: '#update_password'
                },
            },
            errorPlacement: function(error, element) {
                $(element).tooltipster('update', $(error).text());
                $(element).tooltipster('show');
            },
            success: function(label, element) {
                $(element).tooltipster('hide');
            },
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: '#update-password-message',
                    beforeSubmit: function() {
                        $('#update-password-button').attr('disabled', 'disabled');
                    },
                    success: function() {
                        $('#update-password-button').removeAttr('disabled');
                        $('#update-password-message').fadeIn(500).delay(10000).fadeOut();
                        $('#update-password-form').each(function() {
                            this.reset();
                        });
                    },
                });
            }
        });
    });
});

/*  --------------------------------------------------
    :: Update Username Form
    -------------------------------------------------- */

jQuery.noConflict()(function($) {
    $(document).ready(function() {
        $('#update-username-form input').tooltipster({
            trigger: 'custom',
            onlyOne: true,
            position: 'top'
        });

        $('#update-username-form').validate({
            onfocusout: false,
            rules: {
                update_username: {
                    required: true,
                },
            },
            errorPlacement: function(error, element) {
                $(element).tooltipster('update', $(error).text());
                $(element).tooltipster('show');
            },
            success: function(label, element) {
                $(element).tooltipster('hide');
            },
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: '#update-username-message',
                    beforeSubmit: function() {
                        $('#update-username-button').attr('disabled', 'disabled');
                    },
                    success: function() {
                        $('#update-username-button').removeAttr('disabled');
                        $('#update-username-message').fadeIn(500).delay(10000).fadeOut();
                    },
                });
            }
        });
    });
});

/*  --------------------------------------------------
    :: Update Social Account Form
    -------------------------------------------------- */

jQuery.noConflict()(function($) {
    $(document).ready(function() {
        $('#update-social-account-form input').tooltipster({
            trigger: 'custom',
            onlyOne: true,
            position: 'top'
        });

        $('#update-social-account-form').validate({
            onfocusout: false,
            rules: {
                update_social_firstname: {
                    required: true,
                },
                update_social_useremail: {
                    required: true,
                    email: true
                },
                provider: {
                    required: true,
                },
                provider_uid: {
                    required: true,
                },
                display_name: {
                    required: true,
                },
                profile_url: {
                    required: true,
                    url: true
                },
            },
            errorPlacement: function(error, element) {
                $(element).tooltipster('update', $(error).text());
                $(element).tooltipster('show');
            },
            success: function(label, element) {
                $(element).tooltipster('hide');
            },
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: '#update-social-account-message',
                    beforeSubmit: function() {
                        $('#update-social-account-button').attr('disabled', 'disabled');
                    },
                    success: function() {
                        $('#update-social-account-button').removeAttr('disabled');
                        $('#update-social-account-message').fadeIn(500).delay(10000).fadeOut();
                    },
                });
            }
        });
    });
});
