jQuery($);
// UPDATE - ALTERAR SENHA
function showWithSwitch(reference, val) {
    if (val) {
        $("." + reference).attr("disabled", false);
        $("#" + reference).show();
    } else {
        $("." + reference).attr("disabled", true);
        $("#" + reference).hide();
    }
}

function comparePwds(pwd1, pwd2) {
    if (pwd1 === pwd2) return true;

    return false;
}

let updatePwd = false;

$("#switchPwd").on("click", function() {
    updatePwd = !updatePwd;
    showWithSwitch("password", updatePwd);
});

$("#save").on("click", function(event) {
    event.preventDefault();

    const pwd = $("#password1");

    const confirm = $("#password2");

    if (comparePwds(pwd.val(), confirm.val())) {
        $("#register").submit();
    } else {
        pwd.addClass("is-invalid");

        confirm.addClass("is-invalid");
    }
});
