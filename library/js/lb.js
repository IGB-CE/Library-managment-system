var isbn = document.getElementById('isbn');
var check = document.getElementById('isbnError');

function checkInput() {
    var value = isbn.value;
    var pattern = /^[0-9]{10}$|^[0-9]{13}$/;
    if (pattern.test(value)){
        check.innerHTML = "";
        return true;
    }
    else{
        check.innerHTML = "ISBN duhet te permbaje 10 ose 13 shifra!";
        return false;
    }
}

isbn.addEventListener("input", checkInput);