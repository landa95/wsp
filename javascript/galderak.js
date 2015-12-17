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
	alert("sdfsd");
	var saiakera= "pepa";	
	var ondo = "Oker";
	if(zuzena == saiakera){
		ondo= "Zuzen";
	}else{
		ondo = "Zuzen";
	}	
	XMLHttpRequestObject.open("GET", 'php/emaitza.php?ondo='+ondo, true);
	XMLHttpRequestObject.send();
}