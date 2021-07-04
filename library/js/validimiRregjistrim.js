document.getElementById("emri").addEventListener("input", e_validimi);
document.getElementById("mbiemri").addEventListener("input", m_validimi);
document.getElementById("email").addEventListener("input", em_validimi);
document.getElementById("password").addEventListener("input", f_validimi);
document.getElementById('regj').addEventListener("input", validimiFormes);
var emri = document.getElementById('emriE');
var mbiemri = document.getElementById('mbiemriE');
var email = document.getElementById('emailE');
var password = document.getElementById('passwordE');

function validimiFormes()
{
    if(e_validimi()){
        if(m_validimi()){
            if(em_validimi()){
                if(f_validimi(8,12)){
                    document.getElementById('rregjE').innerHTML = "";
                    return true;
                }
            }
        }
    }
    document.getElementById('rregjE').innerHTML = "Ju lutem plotesoni fushat sipas rregjullave te mesiperme!";
    return false;
}

function e_validimi()
{
    var value = document.getElementById("emri").value;
    var pattern = /^[A-Za-z]*$/;
    if (pattern.test(value)){
        emri.innerHTML = "";
        return true;
    }
    else{
        emri.innerHTML = "Emri duhet te permabje vetem shkronja!";
        return false;
    }
}
function m_validimi()
{
    var value = document.getElementById("mbiemri").value;
    var pattern = /^[A-Za-z]*$/;
    if (pattern.test(value)){
        mbiemri.innerHTML = "";
        return true;
    }
    else{
        mbiemri.innerHTML = "Mbiemri duhet te permabje vetem shkronja!";
        return false;
    }
}
function em_validimi()
{
    var value = document.getElementById("email").value;
    var mailformat =/^[_a-z0-9-.]+@fti.edu.al$/i;
    if(mailformat.test(value))
    {
        email.innerHTML = "";
        return true;
    }
    else{
        email.innerHTML = "Emaili nuk eshte ne formatin e sakte!";
        return false;
    }
}
function f_validimi()
{
    var passid_len = document.getElementById("password").value.length;
    if (passid_len > 12 || passid_len < 8)
    {
        password.innerHTML = "Passwordi duhet te permbaje 8 deri ne 12 karakere!";
        return false;
    }
    else
        password.innerHTML = "";
    return true;
}