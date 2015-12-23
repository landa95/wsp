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



function emaitza(id){
	XMLHttpRequestObject2 = new XMLHttpRequest();
	XMLHttpRequestObject2.onreadystatechange = function(){
	if (XMLHttpRequestObject2.readyState==4)
	{var obj = document.getElementById('zuzen'+id);
	obj.innerHTML = XMLHttpRequestObject2.responseText;}
	}
	var saiakera= document.getElementById('erantzuna'+id).value;
	var galdera = document.getElementById('galdera'+id).innerHTML;
	XMLHttpRequestObject2.open("GET", 'php/erantzunzuzen.php?saiakera='+saiakera+'&galdera='+galdera, true);
	XMLHttpRequestObject2.send();
}
