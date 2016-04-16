var currentYear = (new Date()).getFullYear();
var isApplicationValid = true;
var baseurl = '';
var personalstatus = false;
var contactstatus = false;
var academicestatus = false;
var workexstatus = false;
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

        $('#academic-clone').cloneya({
            removeRequired: true,
            isNumberPresent: true
        });

        $('#workex-clone').cloneya({
            limit: 3
        });

        $("#add-extra-academic").click(function() {
            $('#section_academic .toclone').css('display', 'block');
            $('#extraacademiccount').val('1');
            $("#add-extra-academic").css('display', 'none');
        });

        $("#add-extra-academic-delete").click(function() {
            $('#section_academic .toclone').css('display', 'none');
            $("#add-extra-academic").css('display', 'block');
        });

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

        $("#tenthboard").change(function() {
            if ($("#tenthboard").val() == 'Others' || $("#tenthboard").val() == 'State Board') {
                $("#tenthboardothers-div").addClass('irequire');
                $("#tenthboardothers").removeAttr('disabled');
            } else {
                $("#tenthboardothers-div").removeClass('irequire');
                $("#tenthboardothers").val('');
                $("#tenthboardothers").attr('disabled', 'disabled');
            }
        });

        $("#twelfthboard").change(function() {
            if ($("#twelfthboard").val() == 'Others' || $("#twelfthboard").val() == 'State Board') {
                $("#twelfthboardothers-div").addClass('irequire');
                $("#twelfthboardothers").removeAttr('disabled');
            } else {
                $("#twelfthboardothers-div").removeClass('irequire');
                $("#twelfthboardothers").val('');
                $("#twelfthboardothers").attr('disabled', 'disabled');
            }
        });

        $("#gradutationunversity").change(function() {
            if ($("#gradutationunversity").val() == '523' || $("#gradutationunversity").val() == '335' || $("#gradutationunversity").val() == '100') {
                $("#graduationuniversityothers-div").addClass('irequire');
                $("#graduationuniversityothers").removeAttr('disabled');
            } else {
                $("#graduationuniversityothers-div").removeClass('irequire');
                $("#graduationuniversityothers").val('');
                $("#graduationuniversityothers").attr('disabled', 'disabled');
            }
        });

        $("#graduationdiscipline").change(function() {
            if ($("#graduationdiscipline").val() == '28') {
                $("#graduationdisciplineother-div").addClass('irequire');
                $("#graduationdisciplineother").removeAttr('disabled');
            } else {
                $("#graduationdisciplineother-div").removeClass('irequire');
                $("#graduationdisciplineother").val('');
                $("#graduationdisciplineother").attr('disabled', 'disabled');
            }
        });

        $("#graduationcompleted").change(function() {
            if ($("#graduationcompleted").val() == 'Yes') {
                $("#gradationcompletionyear-div").addClass('irequire');
                $("#gradationcompletionyear").removeAttr('disabled');
            } else {
                $("#gradationcompletionyear-div").removeClass('irequire');
                $("#gradationcompletionyear").val('');
                $("#gradationcompletionyear").attr('disabled', 'disabled');
            }
        });

        $('input[name=graduationgpaorpercentage]', '#section_academic').change(function() {
            if (this.value == 'Percentage') {
                $('#graduationgpa-div').css('display', 'none');
                $('#graduationpercentage-div').css('display', 'block');
            } else if (this.value == 'GPA') {
                $('#graduationpercentage-div').css('display', 'none');
                $('#graduationgpa-div').css('display', 'block');
            }
        });

        $('input[name=isworkex]', '#section_workex').change(function() {
            if (this.value == 'Yes') {
                $('#workex-super-div').css('display', 'block');
            } else if (this.value == 'No') {
                $('#workex-super-div').css('display', 'none');
            }
        });

        $('#workstarted').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            yearRange: '1950:' + currentYear
        });

        $('#workcompleted').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            yearRange: '1950:' + (currentYear + 1)
        });

        $(".modal, .overlay").hide();

        $("#save-button-personal").click(function() {
            jQuery('#section_personal').ajaxSubmit();
        });

        $("#save-button-contact").click(function() {
            jQuery('#section_contact').ajaxSubmit();
        });

        $("#save-button-academic").click(function() {
            jQuery('#section_academic').ajaxSubmit();
        });

        $("#save-button-workex").click(function() {
            jQuery('#section_workex').ajaxSubmit();
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

        $("#continue-button-academic").click(function() {
            var section_academic = $('#section_academic');
            var disabled;
            jQuery('#section_academic').ajaxSubmit({
                beforeSubmit: function() {
                    disabled = section_academic.find(':input:disabled').removeAttr('disabled');
                },
                success: function(responseText, statusText, xhr, $form) {
                    checktimeout(responseText);
                    disabled.attr('disabled', 'disabled');
                    if ($("#section_academic").valid()) {
                        academicestatus = true;
                        $("label[for='sky-tab3']").css('background-color', '#26C281');
                    } else {
                        $("label[for='sky-tab3']").css('background-color', '#F22613');
                        academicestatus = false;
                    }
                    $("#sky-tab4").prop("checked", true);
                    $("body").scrollTop(0);

                    changeSectionStatus();
                },
            });

        });

        $("#back-button-academic").click(function() {
            $("#sky-tab2").prop("checked", true);
            $("body").scrollTop(0);
        });

        $("#continue-button-workex").click(function() {
            var section_workex = $('#section_workex');
            var disabled;
            jQuery('#section_workex').ajaxSubmit({
                beforeSubmit: function() {
                    disabled = section_workex.find(':input:disabled').removeAttr('disabled');
                },
                success: function(responseText, statusText, xhr, $form) {
                    checktimeout(responseText);
                    disabled.attr('disabled', 'disabled');
                    if ($("#section_workex").valid()) {
                        workexstatus = true;
                        $("label[for='sky-tab4']").css('background-color', '#26C281');
                    } else {
                        $("label[for='sky-tab4']").css('background-color', '#F22613');
                        workexstatus = false;
                    }
                    $("#sky-tab5").prop("checked", true);
                    $("body").scrollTop(0);

                    changeSectionStatus();
                },
            });

        });

        $("#back-button-workex").click(function() {
            $("#sky-tab3").prop("checked", true);
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
                        $("label[for='sky-tab5']").css('background-color', '#26C281');
                    } else {
                        $("label[for='sky-tab5']").css('background-color', '#F22613');
                        refreestatus = false;
                    }
                    $("#sky-tab6").prop("checked", true);
                    $("body").scrollTop(0);

                    changeSectionStatus();
                },
            });
        });

        $("#back-button-refree").click(function() {
            $("#sky-tab4").prop("checked", true);
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
                        $("label[for='sky-tab6']").css('background-color', '#26C281');
                    } else {
                        $("label[for='sky-tab6']").css('background-color', '#F22613');
                        additionalinfostatus = false;
                    }
                    $("#sky-tab7").prop("checked", true);
                    $("body").scrollTop(0);

                    changeSectionStatus();
                },
            });
        });

        $("#back-button-additional").click(function() {
            $("#sky-tab5").prop("checked", true);
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
                        $("label[for='sky-tab7']").css('background-color', '#26C281');
                        docstatus = true;
                    } else {
                        $("label[for='sky-tab7']").css('background-color', '#F22613');
                        docstatus = false;
                    }

                    if (response.status === 'F') {
                        swal({
                            title: "Error!",
                            text: response.msg,
                            type: "error",
                            animation: false
                        });

                        $("label[for='sky-tab7']").css('background-color', '#F22613');
                        docstatus = false;
                    } else if (response.status === 'P') {
                        swal({
                            title: "Success!",
                            text: "Documents uploaded!!",
                            type: "success",
                            animation: false
                        });
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

                    if ($("#section_academic").valid()) {
                        $("label[for='sky-tab3']").css('background-color', '#26C281');
                        academicestatus = true;
                    } else {
                        $("label[for='sky-tab3']").css('background-color', '#F22613');
                        academicestatus = false;
                    }

                    if ($("#section_workex").valid()) {
                        $("label[for='sky-tab4']").css('background-color', '#26C281');
                        workexstatus = true;
                    } else {
                        $("label[for='sky-tab4']").css('background-color', '#F22613');
                        workexstatus = false;
                    }

                    if ($("#section_reference").valid()) {
                        $("label[for='sky-tab5']").css('background-color', '#26C281');
                        refreestatus = true;
                    } else {
                        $("label[for='sky-tab5']").css('background-color', '#F22613');
                        refreestatus = false;
                    }

                    if (personalstatus && contactstatus && academicestatus && workexstatus && refreestatus && docstatus) {
                        // if (docstatus) {
                        isApplicationValid = true;
                        if (response.status === 'P') {
                            window.location = response.msg + "admin/agreement.php";
                        }
                    } else {
                        isApplicationValid = false;
                    }

                    changeSectionStatus();

                },
                error: function() {
                    $.unblockUI();
                }
            });

        });

        $("#back-button-doc").click(function() {
            $("#sky-tab6").prop("checked", true);
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
                            if (applicantdata[3].extraacademiccount > 0) {
                                $('#section_academic .toclone').css('display', 'block');
                                $('#extraacademiccount').val('1');
                                $("#add-extra-academic").css('display', 'none');
                            }
                            for (var i = 0; i < applicantdata[3].extraacademiccount - 1; i++) {
                                $('#academic-clone').triggerHandler('clone_clone', [$('#academic-clone .clone:first')]);
                            }
                            setTimeout(function() {
                                $('#section_academic').loadJSON(applicantdata[3]);
                            }, 1000);
                        }
                        if (isValid(applicantdata[4])) {
                            for (var i = 0; i < applicantdata[4].extraworkexcount; i++) {
                                $('#workex-clone').triggerHandler('clone_clone', [$('#workex-clone .clone:first')]);
                            }
                            setTimeout(function() {
                                $('#section_workex').loadJSON(applicantdata[4]);
                            }, 1000);
                        }
                        if (isValid(applicantdata[5])) {
                            $('#section_reference').loadJSON(applicantdata[5]);
                        }
                        if (isValid(applicantdata[6])) {
                            $('#section_additional_info').loadJSON(applicantdata[6]);
                        }
                        if (isValid(applicantdata[7])) {
                            $('#section_docs').loadJSON(applicantdata[7]);
                        }

                        if (isValid(applicantdata[8])) {
                            if (applicantdata[8].personalstatus == 'true') {
                                personalstatus = true;
                                $("label[for='sky-tab1']").css('background-color', '#26C281');
                            } else {
                                $("label[for='sky-tab1']").css('background-color', '#F22613');
                            }
                            if (applicantdata[8].contactstatus == 'true') {
                                contactstatus = true;
                                $("label[for='sky-tab2']").css('background-color', '#26C281');
                            } else {
                                $("label[for='sky-tab2']").css('background-color', '#F22613');
                            }
                            if (applicantdata[8].academicestatus == 'true') {
                                academicestatus = true;
                                $("label[for='sky-tab3']").css('background-color', '#26C281');
                            } else {
                                $("label[for='sky-tab3']").css('background-color', '#F22613');
                            }
                            if (applicantdata[8].workexstatus == 'true') {
                                workexstatus = true;
                                $("label[for='sky-tab4']").css('background-color', '#26C281');
                            } else {
                                $("label[for='sky-tab4']").css('background-color', '#F22613');
                            }
                            if (applicantdata[8].refreestatus == 'true') {
                                refreestatus = true;
                                $("label[for='sky-tab5']").css('background-color', '#26C281');
                            } else {
                                $("label[for='sky-tab5']").css('background-color', '#F22613');
                            }
                            if (applicantdata[8].additionalinfostatus == 'true') {
                                additionalinfostatus = true;
                                $("label[for='sky-tab6']").css('background-color', '#26C281');
                            } else {
                                $("label[for='sky-tab6']").css('background-color', '#F22613');
                            }
                            if (applicantdata[8].docstatus == 'true') {
                                docstatus = true;
                                $("label[for='sky-tab7']").css('background-color', '#26C281');
                            } else {
                                $("label[for='sky-tab7']").css('background-color', '#F22613');
                            }
                        }
                    }

                    if (personalstatus && contactstatus && academicestatus && workexstatus && refreestatus && additionalinfostatus && docstatus) {
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
                    academicestatus: academicestatus,
                    workexstatus: workexstatus,
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
