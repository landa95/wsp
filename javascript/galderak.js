XMLHttpRequestObject = new XMLHttpRequest();
XMLHttpRequestObject.onreadystatechange = function(){
if (XMLHttpRequestObject.readyState==4)
{var obj = document.getElementById('emaitza');
obj.innerHTML = XMLHttpRequestObject.responseText;}
}