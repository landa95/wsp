XMLHttpRequestObject = new XMLHttpRequest();
XMLHttpRequestObject.onreadystatechange = function(){
if (XMLHttpRequestObject.readyState==4)
{var obj = document.getElementById('anonim');
obj.innerHTML = XMLHttpRequestObject.responseText;}
}

function nickName() {
	var nickname = document.getElementById('nickname').value;
	XMLHttpRequestObject.open("GET", 'php/anonimoa.php?nickname='+nickname, true);
	XMLHttpRequestObject.send();
}

XMLHttpRequestObject2 = new XMLHttpRequest();
XMLHttpRequestObject2.onreadystatechange = function(){
if (XMLHttpRequestObject2.readyState==4)
{var obj = document.getElementById('zuzen');
obj.innerHTML = XMLHttpRequestObject2.responseText;}
}

function emaitza(){
	var saiakera= document.getElementById('erantzuna').value;
	var erantzuna= document.getElementById('emaitza').value;
	alert(saiakera);
	alert(erantzuna);
	
	var ondo = "false";
	if(erantzuna == saiakera){
		alert("Zuzen");
	}else{
		alert("OKER");
	}	
}