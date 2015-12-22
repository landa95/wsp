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

function emaitza(id){
	var saiakera= document.getElementById('erantzuna'+id).value;
	alert(saiakera);
	var galdera = document.getElementById('galdera'+id).innerHTML;
	alert(galdera);
	XMLHttpRequestObject2.open("GET", 'php/erantzunzuzen.php?saiakera='+saiakera+'&galdera='+galdera, true);
	alert("Iepa!");
	XMLHttpRequestObject2.send();
}
