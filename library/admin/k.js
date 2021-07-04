var k=document.getElementById('kategoria');
function a_validim(){
    var letters = /^[A-Za-z0-9 ]*$/;
    if(letters.test(k.value))
    {
        document.getElementById('kError').innerHTML = "";
        return true;
    }
    else
    {
        document.getElementById('kError').innerHTML = "Kategoria nuk duhet te permbaje simbole.";
        k.focus();
        return false;
    }
}
k.addEventListener("input", a_validim);