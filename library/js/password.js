var pass_ri = document.getElementById('pass1');
var pass_ri_k = document.getElementById('pass2');

function validatePassword() {
    if (pass_ri.value != pass_ri_k.value) {
        pass_ri.focus();
        document.getElementById("passE").innerHTML = "Passwordi dhe konfirmimi nuk perputhen.";
        return false;
    } else if (pass_ri.value.length > 12 || pass_ri.value.length < 8) {
        document.getElementById("passE").innerHTML = "Passwordi duhet te permbaje 8 deri ne 12 karaktere.";
        return false;
    } else {
        return true;
    }
}