let $mo = jQuery;
function preventSubmitButton(e, o, t, s) {
    $mo(e).click(function (n) {
        n.preventDefault(), $mo("#mo_message" + t + s).empty(), $mo("#mo_message" + t + s).append(img), $mo("#mo_message" + t + s).hide();
        var i = o.val();
        $mo.ajax({
            url: customform.siteURL,
            type: "POST",
            data: { user_phone: i, otpType: t, action: customform.saction },
            crossDomain: !0,
            dataType: "json",
            success: function (o) {
                "success" == o.result
                    ? $mo(e).unbind("click").click()
                    : ($mo("#mo_message" + t + s).empty(),
                      $mo("#mo_message" + t + s).show(),
                      $mo("#mo_message" + t + s).append(o.message),
                      $mo("#mo_message" + t + s).css("border-top", "3px solid red"),
                      $mo("#mo_message" + t + s)
                          .focus()
                          .keyup());
            },
            error: function (e) {},
        });
    });
}
function moAjaxInitializer(e, o, t, s, n, i, a) {
    addButtonAndFields(e, o, t, s, n, i, a), bindSendOTPButton(e, o, t, s, n, i, a), bindVerifyButton(e, o, t, s, n, i, a), addValidatedIcon();
}
function addValidatedIcon() {
    setTimeout(function () {
        $mo(".mo-validated+.mo-validated-icon").length || $mo('<span class="dashicons dashicons-yes mo-validated-icon"></span>').insertAfter(".mo-validated");
    }, 250);
}
function is_already_verified(e, o, t, s, n, i, a) {
    a.validated[i] &&
        (e
            .find("#mo_send_otp_" + i + o)
            .attr("disabled", !0)
            .hide(),
        s.addClass("mo-validated"));
}
function addButtonAndFields(e, o, t, s, n, i, a) {
    let m =
        '<div id="mo_verify_field_container' +
        i +
        o +
        '" style="display:none;" class="row mo_verify_field_container"><div class="col-sm-12  single"><div data-field-wrapper="' +
        t +
        '" class="form-group" id="' +
        i +
        o +
        '-wrap"><label id="' +
        i +
        o +
        'Label" for="' +
        i +
        o +
        '" class="control-label">' +
        a.fieldText +
        '<span class="mo-field-message" style="color:#ee0000;">*</span></label><div class=""><input class=" form-control" id="mo_verify_otp_' +
        i +
        o +
        '" name="mo_verify_otp_' +
        i +
        o +
        '" value=""></div></div></div></div>';
    $mo(
        '<div id = "mo_send_otp_button-container' +
            i +
            o +
            '" class = "mo_send_otp_button-container" ><input  type = "button" name = "mo_send_otp_' +
            i +
            o +
            '" class = "btn btn-default mo_send_otp_button" id = "mo_send_otp_' +
            i +
            o +
            '" value = "' +
            a.buttontext +
            '"/></div >' +
            ('<div  class="mo_message_box" id="mo_message' + i) +
            o +
            '" ></div>' +
            m +
            ('<div id = "mo_verify_otp_button-container' +
                i +
                o +
                '" style="display:none;" class = "mo_verify_otp_button-container" ><input  type = "button" name = "mo_verify_button_' +
                i +
                o +
                '" class = "btn btn-default mo_verify_otp_button"  id = "mo_verify_button_' +
                i) +
            o +
            '"  value = "Verify OTP"/></div >'
    ).insertAfter(n);
}
function bindSendOTPButton(e, o, t, s, n, i, a) {
    (img = "<img alt='' src='" + a.imgURL + "'>"),
        $mo("#mo_send_otp_" + i + o).click(function () {
            var e = s.val();
            $mo("#mo_message" + i + o).empty(),
                $mo("#mo_message" + i + o).append(img),
                $mo("#mo_message" + i + o).show(),
                disableOTPButton(),
                $mo.ajax({
                    url: a.siteURL,
                    type: "POST",
                    data: { user_email: e, user_phone: e, otpType: i, action: a.gaction, nonce: a.gnonce },
                    crossDomain: !0,
                    dataType: "json",
                    success: function (e) {
                        "success" === e.result
                            ? (disableOTPButton(),
                              $mo("#mo_message" + i + o).empty(),
                              $mo("#mo_message" + i + o).append("An One Time Passcode has been sent successfully.<br><b>Please note this is only a trial version and is not fully compatible.</b>"),
                              $mo("#mo_message" + i + o).css("border-top", "3px solid green"),
                              $mo("#mo_verify_otp_button-container" + i + o).show(),
                              $mo("#mo_verify_field_container" + i + o).show())
                            : (disableOTPButton(), $mo("#mo_message" + i + o).empty(), $mo("#mo_message" + i + o).append(e.message), $mo("#mo_message" + i + o).css("border-top", "3px solid red"));
                    },
                    error: function (e) {},
                });
        });
}
function bindVerifyButton(e, o, t, s, n, i, a) {
    (img = "<img alt='' src='" + a.imgURL + "'>"),
        $mo("#mo_verify_button_" + i + o).click(function () {
            var e = $mo("#mo_verify_otp_" + i + o).val(),
                t = s.val();
            $mo("#mo_message" + i + o).empty(),
                $mo("#mo_message" + i + o).append(img),
                $mo("#mo_message" + i + o).show(),
                $mo.ajax({
                    url: a.siteURL,
                    type: "POST",
                    data: { user_email: t, user_phone: t, otp_token: e, otpType: i, action: a.vaction, nonce: a.gnonce },
                    crossDomain: !0,
                    dataType: "json",
                    success: function (e) {
                        "success" === e.result
                            ? ($mo("#mo_message" + i + o).hide(),
                              $mo("#mo_verify_otp_button-container" + i + o).hide(),
                              $mo("#mo_verify_field_container" + i + o).hide(),
                              $mo("#mo_send_otp_" + i + o).val("Resend OTP"),
                              s.addClass("mo-validated"),
                              s.focus().keyup(),
                              addValidatedIcon())
                            : ($mo("#mo_message" + i + o).empty(), $mo("#mo_message" + i + o).append(e.message), $mo("#mo_message" + i + o).css("border-top", "3px solid red"));
                    },
                    error: function (e) {},
                });
        });
}
function disableOTPButton() {
    $mo.isFunction(window.moDisableOTPbutton) && moDisableOTPbutton();
}
jQuery(document).ready(function () {
    let e = customform.otpType,
        o = customform.fieldSelector.includes(".") ? $mo(customform.fieldSelector.replace(/ /g, ".")) : $mo(customform.fieldSelector),
        t = customform.submitSelector.includes(".") ? $mo(customform.submitSelector.replace(/ /g, ".")) : $mo(customform.submitSelector),
        s = $mo(t).closest("form");
    void 0 === s && (s = $mo(o).closest("form"));
    let n = $mo(s),
        i = $mo(customform.fieldSelector);
    n.find(i).length > 0 && n.find(t).length > 0 && (moAjaxInitializer(n, "1", "phone", o, i, e, customform), preventSubmitButton(t, o, e, "1"));
});
