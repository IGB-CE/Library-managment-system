var autor=document.getElementById('autori');

function a_validim(){
    var letters = /^[A-Za-z ]+$/;
    if(letters.test(autor.value))
    {
        document.getElementById('auError').innerHTML = "";
        return true;
    }
    else
    {
        document.getElementById('auError').innerHTML = "Autori duhet te permbaje vetem karaktere.";
        autor.focus();
        return false;
    }
}
autor.addEventListener("input", a_validim);