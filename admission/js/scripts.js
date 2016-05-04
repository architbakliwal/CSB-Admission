var currentYear = (new Date()).getFullYear();
var isApplicationValid = true;
var baseurl = '';
var personalstatus = false;
var contactstatus = false;
var examscorestatus = false;
var refreestatus = false;
var additionalinfostatus = false;
var docstatus = false;
var applicantdata = null;

function isValid(object) {
    if (object === undefined || object === null || object.length === 0) {
        return false;
    } else {
        return true;
    }
}

jQuery.noConflict()(function($) {
    $(document).ready(function() {

        $(document).ajaxStart($.blockUI).ajaxStop($.unblockUI);

        $.fn.changeVal = function(v) {
            return $(this).val(v).trigger("change");
        };

        $(".irequire input").addClass('itrequired');
        $(".irequire select").addClass('itrequired');
        $(".irequire textarea").addClass('itrequired');
        $(".irequire input[type=file]").removeClass('itrequired');


        $("input[type=text]").attr('maxlength', 60);

        $("#dob").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            yearRange: '1900:' + (currentYear - 15)
        });

        $("#currentcountry").change(function() {
            if ($("#currentcountry").val() != 'India') {
                $("#currentstate").val('Other');
                $("#currentstate").attr('disabled', 'disabled');
                $("#currentstateother-div").addClass('irequire');
                $("#currentstateother").removeAttr('disabled');
            } else {
                $("#currentstate").val('');
                $("#currentstate").removeAttr('disabled');
                $("#currentstateother-div").removeClass('irequire');
                $("#currentstateother").val('');
                $("#currentstateother").attr('disabled', 'disabled');
            }
        });

        $("#currentstate").change(function() {
            if ($("#currentstate").val() == 'Other') {
                $("#currentstateother-div").addClass('irequire');
                $("#currentstateother").removeAttr('disabled');
            } else {
                $("#currentstateother-div").removeClass('irequire');
                $("#currentstateother").val('');
                $("#currentstateother").attr('disabled', 'disabled');
            }
        });

        $('input[name=permanentsameascurrent]', '#section_contact').change(function() {
            if (this.value == 'Yes') {
                $("#permanentaddress1").changeVal($("#currentaddress1").val());
                $("#permanentaddress2").changeVal($("#currentaddress2").val());
                $("#permanentaddress3").changeVal($("#currentaddress3").val());
                $("#permanentcity").changeVal($("#currentcity").val());
                $("#permanentcountry").changeVal($("#currentcountry").val());
                $("#permanentstate").changeVal($("#currentstate").val());
                $("#permanentstateother").changeVal($("#currentstateother").val());
                $("#permanentzip").changeVal($("#currentzip").val());
            } else if (this.value == 'No') {
                $("#permanentaddress1").changeVal('');
                $("#permanentaddress2").changeVal('');
                $("#permanentaddress3").changeVal('');
                $("#permanentcity").changeVal('');
                $("#permanentcountry").changeVal('');
                $("#permanentstate").changeVal('');
                $("#permanentstateother").changeVal('');
                $("#permanentzip").changeVal('');
            }
        });

        $("#permanentcountry").change(function() {
            if ($("#permanentcountry").val() != 'India') {
                $("#permanentstate").val('Other');
                $("#permanentstate").attr('disabled', 'disabled');
                $("#permanentstateother-div").addClass('irequire');
                $("#permanentstateother").removeAttr('disabled');
            } else {
                $("#permanentstate").val('');
                $("#permanentstate").removeAttr('disabled');
                $("#permanentstateother-div").removeClass('irequire');
                $("#permanentstateother").val('');
                $("#permanentstateother").attr('disabled', 'disabled');
            }
        });

        $("#permanentstate").change(function() {
            if ($("#permanentstate").val() == 'Other') {
                $("#permanentstateother-div").addClass('irequire');
                $("#permanentstateother").removeAttr('disabled');
            } else {
                $("#permanentstateother-div").removeClass('irequire');
                $("#permanentstateother").val('');
                $("#permanentstateother").attr('disabled', 'disabled');
            }
        });

        $(".modal, .overlay").hide();

        $("#save-button-personal").click(function() {
            jQuery('#section_personal').ajaxSubmit();
        });

        $("#save-button-contact").click(function() {
            jQuery('#section_contact').ajaxSubmit();
        });

        $("#save-button-score").click(function() {
            jQuery('#section_exam_score').ajaxSubmit();
        });

        $("#save-button-refree").click(function() {
            jQuery('#section_reference').ajaxSubmit();
        });

        $("#save-button-additional").click(function() {
            jQuery('#section_additional_info').ajaxSubmit();
        });

        $("#save-button-doc").click(function() {
            jQuery('#section_docs').ajaxSubmit({
                success: function(responseText) {
                    var response = JSON.parse(responseText);
                    $.unblockUI();

                    if (response.status === 'F') {
                        swal({
                            title: "Error!",
                            text: response.msg,
                            type: "error",
                            animation: false
                        });
                    } else if (response.status === 'P') {
                        swal({
                            title: "Success!",
                            text: "Document(s) uploaded!!",
                            type: "success",
                            animation: false
                        });
                    }
                }
            });
        });


        $("#continue-button-personal").click(function() {
            jQuery('#section_personal').ajaxSubmit({
                beforeSubmit: function() {
                    // $('#register-button').attr('disabled', 'disabled');
                },
                success: function(responseText, statusText, xhr, $form) {
                    checktimeout(responseText);
                    if ($("#section_personal").valid()) {
                        personalstatus = true;
                        $("label[for='sky-tab1']").css('background-color', '#26C281');
                    } else {
                        $("label[for='sky-tab1']").css('background-color', '#F22613');
                        personalstatus = false;
                    }
                    $("#sky-tab2").prop("checked", true);
                    $("body").scrollTop(0);

                    changeSectionStatus();
                },
            });
        });

        $("#continue-button-contact").click(function() {
            var section_contact = $('#section_contact');
            var disabled;
            jQuery('#section_contact').ajaxSubmit({
                beforeSubmit: function() {
                    disabled = section_contact.find(':input:disabled').removeAttr('disabled');
                },
                success: function(responseText, statusText, xhr, $form) {
                    checktimeout(responseText);
                    disabled.attr('disabled', 'disabled');
                    if ($("#section_contact").valid()) {
                        contactstatus = true;
                        $("label[for='sky-tab2']").css('background-color', '#26C281');
                    } else {
                        $("label[for='sky-tab2']").css('background-color', '#F22613');
                        contactstatus = false;
                    }
                    $("#sky-tab3").prop("checked", true);
                    $("body").scrollTop(0);

                    changeSectionStatus();
                },
            });

        });

        $("#back-button-contact").click(function() {
            $("#sky-tab1").prop("checked", true);
            $("body").scrollTop(0);
        });

        $("#continue-button-score").click(function() {
            var section_exam_score = $('#section_exam_score');
            var disabled;
            jQuery('#section_exam_score').ajaxSubmit({
                beforeSubmit: function() {
                    disabled = section_exam_score.find(':input:disabled').removeAttr('disabled');
                },
                success: function(responseText, statusText, xhr, $form) {
                    checktimeout(responseText);
                    disabled.attr('disabled', 'disabled');
                    if ($("#section_exam_score").valid()) {
                        examscorestatus = true;
                        $("label[for='sky-tab3']").css('background-color', '#26C281');
                    } else {
                        $("label[for='sky-tab3']").css('background-color', '#F22613');
                        examscorestatus = false;
                    }
                    $("#sky-tab4").prop("checked", true);
                    $("body").scrollTop(0);

                    changeSectionStatus();
                },
            });

        });

        $("#back-button-score").click(function() {
            $("#sky-tab2").prop("checked", true);
            $("body").scrollTop(0);
        });

        $("#continue-button-refree").click(function() {
            jQuery('#section_reference').ajaxSubmit({
                beforeSubmit: function() {
                    // $('#register-button').attr('disabled', 'disabled');
                },
                success: function(responseText, statusText, xhr, $form) {
                    checktimeout(responseText);
                    if ($("#section_reference").valid()) {
                        refreestatus = true;
                        $("label[for='sky-tab4']").css('background-color', '#26C281');
                    } else {
                        $("label[for='sky-tab4']").css('background-color', '#F22613');
                        refreestatus = false;
                    }
                    $("#sky-tab5").prop("checked", true);
                    $("body").scrollTop(0);

                    changeSectionStatus();
                },
            });
        });

        $("#back-button-refree").click(function() {
            $("#sky-tab3").prop("checked", true);
            $("body").scrollTop(0);
        });

        $("#continue-button-additional").click(function() {
            jQuery('#section_additional_info').ajaxSubmit({
                beforeSubmit: function() {
                    // $('#register-button').attr('disabled', 'disabled');
                },
                success: function(responseText, statusText, xhr, $form) {
                    checktimeout(responseText);
                    if ($("#section_additional_info").valid()) {
                        additionalinfostatus = true;
                        $("label[for='sky-tab5']").css('background-color', '#26C281');
                    } else {
                        $("label[for='sky-tab5']").css('background-color', '#F22613');
                        additionalinfostatus = false;
                    }
                    $("#sky-tab6").prop("checked", true);
                    $("body").scrollTop(0);

                    changeSectionStatus();
                },
            });
        });

        $("#back-button-additional").click(function() {
            $("#sky-tab4").prop("checked", true);
            $("body").scrollTop(0);
        });

        $("#continue-button-doc").click(function() {

            jQuery('#section_docs').ajaxSubmit({
                beforeSubmit: function() {
                    $.blockUI();
                },
                success: function(responseText, statusText, xhr, $form) {
                    var response = JSON.parse(responseText);
                    checktimeout(responseText);
                    $.unblockUI();

                    if ($("#section_docs").valid()) {
                        $("label[for='sky-tab6']").css('background-color', '#26C281');
                        docstatus = true;
                    } else {
                        $("label[for='sky-tab6']").css('background-color', '#F22613');
                        docstatus = false;
                    }

                    if (response.status === 'F') {
                        swal({
                            title: "Error!",
                            text: response.msg,
                            type: "error",
                            animation: false
                        });

                        $("label[for='sky-tab6']").css('background-color', '#F22613');
                        docstatus = false;
                    } else if (response.status === 'P') {
                        /*swal({
                            title: "Success!",
                            text: "Documents uploaded!!",
                            type: "success",
                            animation: false
                        });*/
                    }

                    if ($("#section_personal").valid()) {
                        $("label[for='sky-tab1']").css('background-color', '#26C281');
                        personalstatus = true;
                    } else {
                        $("label[for='sky-tab1']").css('background-color', '#F22613');
                        personalstatus = false;
                    }

                    if ($("#section_contact").valid()) {
                        $("label[for='sky-tab2']").css('background-color', '#26C281');
                        contactstatus = true;
                    } else {
                        $("label[for='sky-tab2']").css('background-color', '#F22613');
                        contactstatus = false;
                    }

                    if ($("#section_exam_score").valid()) {
                        $("label[for='sky-tab3']").css('background-color', '#26C281');
                        examscorestatus = true;
                    } else {
                        $("label[for='sky-tab3']").css('background-color', '#F22613');
                        examscorestatus = false;
                    }

                    if ($("#section_reference").valid()) {
                        $("label[for='sky-tab4']").css('background-color', '#26C281');
                        refreestatus = true;
                    } else {
                        $("label[for='sky-tab4']").css('background-color', '#F22613');
                        refreestatus = false;
                    }

                    if ($("#section_additional_info").valid()) {
                        $("label[for='sky-tab5']").css('background-color', '#26C281');
                        additionalinfostatus = true;
                    } else {
                        $("label[for='sky-tab5']").css('background-color', '#F22613');
                        additionalinfostatus = false;
                    }

                    if (personalstatus && contactstatus && examscorestatus && refreestatus && additionalinfostatus && docstatus) {
                        isApplicationValid = true;
                        if (response.status === 'P') {
                            window.location = response.msg + "admin/agreement.php";
                        }
                    } else {
                        isApplicationValid = false;
                        swal({
                            title: "Error!",
                            text: "Please fill all the required fields in each section",
                            type: "error",
                            animation: false
                        });
                    }

                    changeSectionStatus();

                },
                error: function() {
                    $.unblockUI();
                }
            });

        });

        $("#back-button-doc").click(function() {
            $("#sky-tab5").prop("checked", true);
            $("body").scrollTop(0);
        });

        $("#submit-final").click(function() {
            jQuery('#section_submit').ajaxSubmit({
                beforeSubmit: function() {
                    if (!$("#section_submit input[name=iagree]").is(":checked")) {
                        alert('Please agree to comply with the rules of the institute');
                        return false;
                    }
                },
                success: function(responseText) {
                    var response = JSON.parse(responseText);
                    checktimeout(response);
                    if (response.status == 'Y') {
                        var baseurl = $('#baseurl').val();
                        // console.log(baseurl + "admin/done.php");
                        window.location = baseurl + "admin/done.php";
                    } else {}
                }
            });
        });

        if ($('body').is('#dashboard-body')) {
            $.ajax({
                url: '../php/processor-populate.php',
                type: "post",
                beforeSend: function() {
                    $.blockUI();
                },
                success: function(data) {
                    checktimeout(data);
                    if (isValid(data)) {
                        applicantdata = JSON.parse(data);
                        // console.log(applicantdata);
                        baseurl = applicantdata[0];

                        if (isValid(applicantdata[1])) {
                            $('#section_personal').loadJSON(applicantdata[1]);
                        }
                        if (isValid(applicantdata[2])) {
                            $('#section_contact').loadJSON(applicantdata[2]);
                        }
                        if (isValid(applicantdata[3])) {
                            $('#section_exam_score').loadJSON(applicantdata[3]);
                        }
                        if (isValid(applicantdata[4])) {
                            $('#section_reference').loadJSON(applicantdata[4]);
                        }
                        if (isValid(applicantdata[5])) {
                            $('#section_additional_info').loadJSON(applicantdata[5]);
                        }
                        if (isValid(applicantdata[6])) {
                            $('#section_docs').loadJSON(applicantdata[6]);
                        }

                        if (isValid(applicantdata[7])) {
                            if (applicantdata[7].personalstatus == 'true') {
                                personalstatus = true;
                                $("label[for='sky-tab1']").css('background-color', '#26C281');
                            } else {
                                $("label[for='sky-tab1']").css('background-color', '#F22613');
                            }
                            if (applicantdata[7].contactstatus == 'true') {
                                contactstatus = true;
                                $("label[for='sky-tab2']").css('background-color', '#26C281');
                            } else {
                                $("label[for='sky-tab2']").css('background-color', '#F22613');
                            }
                            if (applicantdata[7].examscorestatus == 'true') {
                                examscorestatus = true;
                                $("label[for='sky-tab3']").css('background-color', '#26C281');
                            } else {
                                $("label[for='sky-tab3']").css('background-color', '#F22613');
                            }
                            if (applicantdata[7].refreestatus == 'true') {
                                refreestatus = true;
                                $("label[for='sky-tab4']").css('background-color', '#26C281');
                            } else {
                                $("label[for='sky-tab4']").css('background-color', '#F22613');
                            }
                            if (applicantdata[7].additionalinfostatus == 'true') {
                                additionalinfostatus = true;
                                $("label[for='sky-tab5']").css('background-color', '#26C281');
                            } else {
                                $("label[for='sky-tab5']").css('background-color', '#F22613');
                            }
                            if (applicantdata[7].docstatus == 'true') {
                                docstatus = true;
                                $("label[for='sky-tab6']").css('background-color', '#26C281');
                            } else {
                                $("label[for='sky-tab6']").css('background-color', '#F22613');
                            }
                        }
                    }

                    if (personalstatus && contactstatus && examscorestatus && refreestatus && additionalinfostatus && docstatus) {
                        window.location = baseurl + "admin/agreement.php";
                    } else {

                    }

                    $.unblockUI();

                    // $("ul :input").attr("disabled", true);
                    // $("ul :button").attr("disabled", true);
                },
                error: function(xhr, status, error) {
                    $.unblockUI();
                }
            });
        }

        function changeSectionStatus() {
            $.ajax({
                url: '../php/processor-status.php',
                type: "post",
                data: {
                    personalstatus: personalstatus,
                    contactstatus: contactstatus,
                    examscorestatus: examscorestatus,
                    refreestatus: refreestatus,
                    additionalinfostatus: additionalinfostatus,
                    docstatus: docstatus
                },
                beforeSend: function() {

                },
                success: function(data) {
                    checktimeout(data);
                }
            });
        }

        function checktimeout(response) {
            if (isValid(response)) {
                try {
                    // var response = JSON.parse(text);
                    if (response.status === 'timeout') {
                        alert("Your session timed out. Please login again.");
                        window.open(baseurl + 'login.php', '_self');
                        return false;
                    }
                } catch (e) {
                    alert(e);
                    return false;
                }

            }

        }
    });

});
