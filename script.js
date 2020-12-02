function getXMLHTTPRequest(){
  var request = false;
  try{
    // Firefox
    request = new XMLHttpRequest();
  } catch (err){
    try{
      //ie
      request = new ActiveXObject("Msxml2.XMLHTTP");
    }catch(err){
      try{
        //other ie
        request = new ActiveXObject("Microsoft.XMLHTTP");
      }catch(err){
        request = false;
      }
    }
  }
  return request;
}
function changePage(){
  var clist = document.forms[0];
  var filterString = "";
  // var current_page = ","+document.getElementsByClassName("curr-page");

  for(i = 0; i < clist.length; i++){
    if (clist[i].checked) {
      filterString = filterString + clist[i].value + ",";
    }
    else{
      filterString = filterString + ",";
    }
  }
  if(filterString==""){
    document.getElementById("db_display").innerHTML= "";
    return;
  }
  else{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
      if(this.readyState == 4 && this.status ==200){
        document.getElementById("db_display").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("POST","getItems.php?metertype="+filterString+"<?php echo $pageNum ?>",true);
    xmlhttp.send();
  }

}
function pagination(page){
  var clist = document.forms[0];
  var filterString = "";
  // var current_page = ","+document.getElementsByClassName("curr-page");
  page = parseInt(page);
  for(i = 0; i < clist.length; i++){
    if (clist[i].checked) {
      filterString = filterString + clist[i].value + ",";
    }
    else{
      filterString = filterString + ",";
    }
  }
  if(filterString==""){
    document.getElementById("db_display").innerHTML= "";
    return;
  }
  else{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
      if(this.readyState == 4 && this.status ==200){
        document.getElementById("db_display").innerHTML = this.responseText;
      }
    };

    xmlhttp.open("POST","getItems.php?metertype="+filterString+page,true);
    xmlhttp.send();
  }
}
