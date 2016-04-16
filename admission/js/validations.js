var emailregex = "^[_A-Za-z0-9-\\+]+(\\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$";
var alphabetsregex = "^[A-z]+$";

jQuery.noConflict()(function($) {
    $(document).ready(function() {

        $("input[name=mobilenumber]").ForceNumericOnly();
        $("input[name=phonenumber]").ForceNumericOnly();
        $("input[name=emergencymobile]").ForceNumericOnly();
        $("input[name=annualrenumeration]").ForceNumericOnly();
        $("input[name=totalworkex]").ForceNumericOnly();
        $("input[name=refreecontact]").ForceNumericOnly();


        $("input[name=firstname]").ForceAlphabestOnly();
        $("input[name=middlename]").ForceAlphabestOnly();
        $("input[name=refreename]").ForceAlphabestOnly();

        $("#academicachivements, #rolesandresponsibility, #refreeknowing, #rolemodelinfo, #failureinfo, #acheivementasalumnus, #supportinfo").on('keyup', function() {
            var words = this.value.match(/\S+/g).length;
            if (words > 200) {
                // Split the string on first 200 words and rejoin on spaces
                var trimmed = $(this).val().split(/\s+/, 200).join(" ");
                // Add a space at the end to keep new typing making new words
                $(this).val(trimmed + " ");
            }
        });

        $("#section_personal").validate({
            rules: {
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
                dob: {
                    required: true,
                    dpDate: true
                }
            },
            errorPlacement: function(error, element) {
                $(element).tooltipster('update', $(error).text());

            },
            success: function(label, element) {

            }
        });

        // the following method must come AFTER .validate()
        $('#section_personal .itrequired').each(function() {
            $(this).rules('add', {
                required: true,
            });
        });



        $("#section_contact").validate({
            rules: {
                email: {
                    required: true,
                    regexemail: emailregex
                },
                mobilenumber: {
                    required: true,
                    minlength: 10
                },
                emergencymobile: {
                    minlength: 10
                }
            },
            errorPlacement: function(error, element) {
                $(element).tooltipster('update', $(error).text());
            },
            success: function(label, element) {

            },
            submitHandler: function(form) {

            }
        });

        // the following method must come AFTER .validate()
        $('#section_contact .itrequired').each(function() {
            $(this).rules('add', {
                required: true,
            });
        });

        $("#section_academic").validate({

            rules: {
                tenthaggregate: {
                    required: true,
                    max: 100
                },
                twelfthaggregate: {
                    required: true,
                    max: 100
                },
                graduationpercentage: {
                    required: true,
                    max: 100
                },
                graduationgpaobtained: {
                    required: true,
                    number: true
                },
                graduationgpamax: {
                    required: true,
                    number: true
                }
            },

            errorPlacement: function(error, element) {
                $(element).tooltipster('update', $(error).text());
            },
            success: function(label, element) {

            },
            submitHandler: function(form) {

            }
        });

        // the following method must come AFTER .validate()
        $('#section_academic .itrequired').each(function() {
            $(this).rules('add', {
                required: true,
            });
        });

        $("#section_workex").validate({

            rules: {
                workstarted: {
                    required: true,
                    dpDate: true
                },
                workcompleted: {
                    required: true,
                    dpDate: true
                }
            },

            errorPlacement: function(error, element) {
                $(element).tooltipster('update', $(error).text());
            },
            success: function(label, element) {

            },
            submitHandler: function(form) {

            }
        });

        // the following method must come AFTER .validate()
        $('#section_workex .itrequired').each(function() {
            $(this).rules('add', {
                required: true,
            });
        });

        $("#section_reference").validate({

            rules: {
                refreeemail: {
                    required: true,
                    regexemail: emailregex
                }

            },

            errorPlacement: function(error, element) {
                $(element).tooltipster('update', $(error).text());
            },
            success: function(label, element) {

            },
            submitHandler: function(form) {

            }
        });

        // the following method must come AFTER .validate()
        $('#section_reference .itrequired').each(function() {
            $(this).rules('add', {
                required: true,
            });
        });


        $("#section_additional_info").validate({

            errorPlacement: function(error, element) {
                $(element).tooltipster('update', $(error).text());
            },
            success: function(label, element) {

            },
            submitHandler: function(form) {

            }
        });

        // the following method must come AFTER .validate()
        $('#section_additional_info .itrequired').each(function() {
            $(this).rules('add', {
                required: true,
            });
        });



        $("#section_docs").validate({

            errorPlacement: function(error, element) {

            },
            success: function(label, element) {

            },
            submitHandler: function(form) {

            }
        });

        // the following method must come AFTER .validate()
        $('#section_docs .itrequired').each(function() {
            $(this).rules('add', {
                required: true,
            });
        });

    });

});

// Alphabets only control handler
jQuery.fn.ForceAlphabestOnly =
    function() {
        return this.each(function() {
            jQuery(this).keydown(function(e) {
                if ((e.which > 47 && e.which < 58) && (e.which != 32)) {
                    return false;
                }
            });
        });
    };

// Numeric only control handler
jQuery.fn.ForceNumericOnly =
    function() {
        return this.each(function() {
            jQuery(this).keydown(function(e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    return false;
                }
            });
        });
    };
