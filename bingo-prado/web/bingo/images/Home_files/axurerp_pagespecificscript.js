
var PageName = 'Home';
var PageId = 'pee87f086e57d44d292a8934a87154646'
document.title = 'Home';

if (top.location != self.location)
{
	if (parent.HandleMainFrameChanged) {
		parent.HandleMainFrameChanged();
	}
}

var u5 = document.getElementById('u5');

var u0 = document.getElementById('u0');

var u3 = document.getElementById('u3');

var u6 = document.getElementById('u6');

var u1 = document.getElementById('u1');

var u4 = document.getElementById('u4');

var u7 = document.getElementById('u7');

var u2 = document.getElementById('u2');

u2.style.cursor = 'pointer';
if (bIE) u2.attachEvent("onclick", Clicku2);
else u2.addEventListener("click", Clicku2, true);
function Clicku2(e)
{

if (true) {

	self.location.href="Juego.html" + GetQuerystring();

}

}

var u8 = document.getElementById('u8');

if (window.OnLoad) OnLoad();
