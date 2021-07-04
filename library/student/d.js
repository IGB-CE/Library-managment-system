function valdata() {
    var d1 = document.getElementById('d1');
    var d2 = document.getElementById('d2');
    var date1=d1.value.split('-');
    var date2=d2.value.split('-');
    var year1=date1[0];
    var year2=date2[0];
    var month1=date1[1];
    var month2=date2[1];
    var day1=date1[2];
    var day2=date2[2];
    var dt1 = new Date(year1, month1, day1);
    var dt2 = new Date(year2, month2, day2);
    var diff = dt2-dt1;
    diff = diff / (1000*60*60*24);
    if (diff<0 || diff>28){
        document.getElementById('dE').innerHTML = "Ju lutem jepni data te vlefshme!";
        return false;
    }
    else{
        document.getElementById('dE').innerHTML = "";
        return true;
    }
}