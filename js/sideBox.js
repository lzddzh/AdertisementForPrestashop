
window.onload = function(){
  var email="";
  var slogan="Drink me!";
  var name="Amazon";
  var address="www.amazon.com";
  var backgroundURL="images-na.ssl-images-amazon.com/images/I/818i%2BQm07UL._SX522_.jpg";
  var linkURL="https://www.amazon.com/Coca-Cola-12-PK-Fl-Cans/dp/B000T9WLTK/ref=lp_16318231_1_11_s_it?s=grocery&ie=UTF8&qid=1486018359&sr=1-11";
  var where = "home"; // home, itemInfo, usrInfo
  var who = "";
  var whoNow = "loginFalse"; // loginTrue, loginFalse

  var path = window.location.pathname;
  if (path.endsWith("prestashop/")) {
    where = "home";
  } else if (path.endsWith("history.php")) {
    where = "usrInfo";
  } else if (path.split('?')[0].endsWith("product.php")) {
    where = "itemInfo";
  } else {
    where = "+";
  }
$.post("/prestashop/addAdv/adContent.php",{ where1: where, who1: who},function(data) {
if (data == "0 results") {
  // for debug.
  //alert(data);
  return;
}
//alert(data);
var items = data.split('|');   

  slogan=items[0];
  name=items[1];
  address=items[2]; backgroundURL=items[3];
  linkURL=items[4];
  who=items[10];
  email=items[11];
  whoNow=items[items.length - 1];
  if (!(who.indexOf(whoNow) > -1)) { // if who doesn't contains whoNow
     //alert(who);
     //alert(whoNow);
     //alert(email);
     return;
  } 

  if (backgroundURL.indexOf('https:') <= -1) backgroundURL = "https://" + backgroundURL;
  if (linkURL.indexOf('https:') <= -1) linkURL = "https://" + linkURL;
  document.body.innerHTML += '<div id="adleft" onclick=\"window.open(\''+linkURL+'\')\"; style="width:70px; height:100px; padding:20px; overflow: auto; text-overflow: ellipsis; font:15px/20px arial; background-color:#06c; background-image:url(' + backgroundURL + '); background-size: 100% auto; position:absolute; cursor:pointer; color:#000; left:0; top:150px;"><div style="text-align:center;"><h4>'+slogan+'</h4></div><div style="position:absolute; bottom:0px;"><p style="font:10px/20px arial;">'+name+'<br />'+address+'</p></div></div>';
  document.body.innerHTML += '<div id="adright" onclick=\"window.open(\''+linkURL+'\')\"; style="width:70px; height:100px; padding:20px; overflow: auto; text-overflow: ellipsis; font:15px/20px arial; background-color:#06c; background-image:url(' + backgroundURL + '); background-size: 100% auto; position:absolute; cursor:pointer; color:#000; right:0; top:150px;"><div style="text-align:center;"><h4>'+slogan+'</h4></div><div style="position:absolute; bottom:0px;"><p style="font:10px/20px arial;">'+name+'<br />'+address+'</p></div></div>';

  $('#adleft').click(function(){
    $.post("/prestashop/addAdv/adUpdate.php",{ command1: 'updateClickCount', email1: email},function(data) { /*alert (data);*/ })
  });
  $('#adright').click(function(){
    $.post("/prestashop/addAdv/adUpdate.php",{ command1: 'updateClickCount', email1: email},function(data) { /*alert (data);*/ })
  });

  var adleft = document.getElementById("adleft");
  var adright = document.getElementById("adright");
  
  var adtop = adleft.offsetTop;
  window.onscroll = function(){

    adleft.style.top = adtop + (document.documentElement.scrollTop || document.body.scrollTop) +"px"; 
    adright.style.top = adtop + (document.documentElement.scrollTop || document.body.scrollTop) +"px"; 
  }
  // Count the view times.
  //alert(email);
  $.post("/prestashop/addAdv/adUpdate.php",{ command1: 'updateViewCount', email1: email},function(data) {
 //alert(data);
});
});
}  

