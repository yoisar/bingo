
var PageName = 'Pantalla en blanco';
var PageId = 'p99b8a763e1af4ba7bf4cc4367c82751d'
document.title = 'Pantalla en blanco';

if (top.location != self.location)
{
	if (parent.HandleMainFrameChanged) {
		parent.HandleMainFrameChanged();
	}
}

var u2 = document.getElementById('u2');

var u1 = document.getElementById('u1');

var u0 = document.getElementById('u0');

var u4 = document.getElementById('u4');

var u3 = document.getElementById('u3');

u3.style.cursor = 'pointer';
if (bIE) u3.attachEvent("onclick", Clicku3);
else u3.addEventListener("click", Clicku3, true);
function Clicku3(e)
{

if (true) {

	self.location.href="Home.html" + GetQuerystring();

}

}

if (window.OnLoad) OnLoad();
