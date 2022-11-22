//Check if IE
var bIE = false;
if ((index = navigator.userAgent.indexOf("MSIE")) >= 0) 
{
	bIE = true;
}

//Make insertAdjacentElement work for Netscape
if(typeof HTMLElement!="undefined" && !HTMLElement.prototype.insertAdjacentElement)
{
	HTMLElement.prototype.insertAdjacentElement = function(where,pnode)
	{
		switch (where)
		{
			case 'beforeBegin':
				this.parentNode.insertBefore(pnode,this)
				break;
			case 'afterBegin':
				this.insertBefore(pnode,this.firstChild);
				break;
			case 'beforeEnd':
				this.appendChild(pnode);
				break;
			case 'afterEnd':
				if (this.nextSibling) this.parentNode.insertBefore(pnode,this.nextSibling);
				else this.parentNode.appendChild(pnode);
				break;
		}
	}

	HTMLElement.prototype.insertAdjacentHTML = function(where,html)
	{
		var range = this.ownerDocument.createRange();
		range.setStartBefore(this);
		var phtml = range.createContextualFragment(html);
		this.insertAdjacentElement(where,phtml)
	}
}

var MaxZIndex = 1000;

//Get the id of the Workflow Dialog belonging to element with id = id
function Workflow(id) {
	return id+'WF';
}

//Get the id of the Workflow Description Box belonging to element with id = id
function WorkflowDescBox(id) {
	return id+'WFDesc';
}

//Get the id of the Element Description belonging to element with id = id			
function WorkflowElementDesc(id) 
{
	return id+'d';
}

function BringToFront(id)
{
	var target = document.getElementById(id);
	MaxZIndex = MaxZIndex + 1;
	target.style.zIndex = MaxZIndex ;
}

function HideElement(id)
{
	var source = document.getElementById(id);
	source.style.visibility = "hidden";
	RefreshScreen();
}

function RefreshScreen()
{
	var oldColor = document.body.style.backgroundColor
	var setColor = (oldColor=="rgb(0,0,0)")?"#FFFFFF":"#000000";
	document.body.style.backgroundColor = setColor
	document.body.style.backgroundColor = oldColor
}

function getAbsoluteLeft(node)
{
   var currentNode=node;
   var left=0;
   while(currentNode.tagName!="BODY"){
      left+=currentNode.offsetLeft;
      currentNode=currentNode.offsetParent;
   }
   return left;
}

function getAbsoluteTop(node)
{
   var currentNode=node;
   var top=0;
   while(currentNode.tagName!="BODY"){
      top+=currentNode.offsetTop;
      currentNode=currentNode.offsetParent;
   }
   return top;
}

function ToggleWorkflow(event, id, width, height, hasWorkflow)
{
	SuppressBubble(event);
	var target = document.getElementById(Workflow(id));
	if (target.style.visibility == "visible") {HideElement(Workflow(id));}
	else 
	{
		var source = document.getElementById(id + "Note");
		BringToFront(target.id);
		var bufferH = 10;
		var bufferV = 10;
		var blnLeft = false;
		var blnAbove = false;
		height = height + 30;
		var sourceLeft = getAbsoluteLeft(source) + (source.offsetWidth/2);
		var sourceTop = getAbsoluteTop(source) + (source.offsetHeight/2);
		if (sourceLeft > width + bufferH + document.body.scrollLeft) 
		{
			blnLeft = true;
		}
		if (sourceTop > height + bufferV + document.body.scrollTop)
		{
			blnAbove = true;
		}
		DrawAnnotation(target.id, width, height);
		var descBox = document.getElementById(WorkflowDescBox(id));
		if (descBox.innerHTML == '') ShowDescription(id, id + 'base', '');
		if (blnAbove) target.style.top = sourceTop - height;
		else target.style.top = sourceTop;
		if (blnLeft) target.style.left = sourceLeft - width;
		else target.style.left = sourceLeft;
	}
	RefreshScreen();
}

function DrawAnnotation(id, width, height) 
{
	var target = document.getElementById(id);
	target.style.width = width;
	target.style.height = height;
	var btnClose = document.getElementById(id+'Close');
	var crop = document.getElementById(id+'Crop');
	var desc = document.getElementById(id+'Desc');
	var label = document.getElementById(id+'Label');
	var resize = document.getElementById(id+'Resize');
	var heightCell = document.getElementById(id+'Height');
	label.style.left = 10;
	label.style.top = 4;
	label.style.width = width - 30;
	if(bIE)
	{
		btnClose.style.left = width - 18;
		btnClose.style.top = 7;
		desc.style.left = 4;
		desc.style.top = 24;
		desc.style.width = width - 8;
		desc.style.height = height - 28;
		resize.style.left = width - 15;
		resize.style.top = height - 15;
	}
	else
	{
		heightCell.style.height = height - 40;
		btnClose.style.left = width - 18;
		btnClose.style.top = 7;
		desc.style.left = 4;
		desc.style.top = 24;
		desc.style.width = width - 20;
		desc.style.height = height - 40;
		resize.style.left = width - 15;
		resize.style.top = height - 15;
	}
	target.style.visibility = "visible";
}

function ShowDescription(id, WFE, CurrentWFE)
{
	var source = document.getElementById(WorkflowElementDesc(WFE));
	var target = frames[WorkflowDescBox(id)];
	target.document.body.innerHTML = source.innerHTML;
	//var element = document.getElementById(WFE);
	//if (element != null) {element.style.border = "thin solid yellow"};
}

function ToggleLinks(event, linksid)
{
	var links = document.getElementById(linksid);
	if (links.style.visibility == "visible") {HideElement(linksid);}
	else {
		if (bIE) 
		{
			links.style.top = window.event.y + document.body.scrollTop;
			links.style.left = window.event.x + document.body.scrollLeft;
		}
		else
		{
			links.style.top = event.pageY;
			links.style.left = event.pageX;
		}
		links.style.visibility = "visible";
		BringToFront(linksid);
	}
	RefreshScreen();
}

var objDrag = new Object();
objDrag.zIndex = 0;

function StartDrag(event, id) 
{
	var x, y;
	objDrag.elNode = document.getElementById(id);
	if (bIE) 
	{
		x = window.event.clientX + document.documentElement.scrollLeft + document.body.scrollLeft;
		y = window.event.clientY + document.documentElement.scrollTop + document.body.scrollTop;
	}
	else
	{
		x = event.pageX;
		y = event.pageY;
	}
	objDrag.cursorStartX = x;
	objDrag.cursorStartY = y;
	objDrag.elStartLeft  = parseInt(objDrag.elNode.style.left, 10);
	objDrag.elStartTop   = parseInt(objDrag.elNode.style.top,  10);
	BringToFront(objDrag.elNode.id);
	if (bIE) 
	{
		document.attachEvent("onmousemove", Drag);
		document.attachEvent("onmouseup",   StopDrag);
	}
	else
	{
		document.addEventListener("mousemove", Drag, true);
		document.addEventListener("mouseup", StopDrag, true);
	}
	SuppressBubble(event);
}

function Drag(event)
{
	var x, y;
	if (bIE) 
	{
		x = window.event.clientX + document.documentElement.scrollLeft + document.body.scrollLeft;
		y = window.event.clientY + document.documentElement.scrollTop + document.body.scrollTop;
	}
	else
	{
		x = event.pageX;
		y = event.pageY;
	}
	objDrag.elNode.style.left = (objDrag.elStartLeft + x - objDrag.cursorStartX) + "px";
	objDrag.elNode.style.top  = (objDrag.elStartTop  + y - objDrag.cursorStartY) + "px";
	SuppressBubble(event);
}

function StopDrag(event) 
{
	objDrag.elNode = null;
	if (bIE)
	{
		document.detachEvent("onmousemove", Drag);
		document.detachEvent("onmouseup",   StopDrag);
	}
	else
	{
		document.removeEventListener("mousemove", Drag,   true);
		document.removeEventListener("mouseup",   StopDrag, true);
    }
}

var objResize = Object();

function StartResize(event, id)
{
	var el;
	var x, y;
	var element = document.getElementById(id);
	if(bIE)
	{
		x = window.event.clientX + document.documentElement.scrollLeft + document.body.scrollLeft;
		y = window.event.clientY + document.documentElement.scrollTop + document.body.scrollTop;
	}
	else
	{
		x = event.pageX;
		y = event.pageY;
	}
	objResize.id = id;
	objResize.cursorStartX = x;
	objResize.cursorStartY = y;
	objResize.startWidth = parseInt(element.style.width);
	objResize.startHeight = parseInt(element.style.height);
	if (bIE)
	{
		document.attachEvent("onmousemove", Resize);
		document.attachEvent("onmouseup",   StopResize);
	}
	else
	{
		document.addEventListener("mousemove", Resize, true);
		document.addEventListener("mouseup",   StopResize, true);
	}
}

function Resize(event)
{
	var x, y;
	if(bIE)
	{
		x = window.event.clientX + document.documentElement.scrollLeft + document.body.scrollLeft;
		y = window.event.clientY + document.documentElement.scrollTop + document.body.scrollTop;
	}
	else
	{
		x = event.pageX;
		y = event.pageY;
	}
	width = objResize.startWidth + x - objResize.cursorStartX;
	if (width < 100) {width = 100};
	height = objResize.startHeight + y - objResize.cursorStartY;
	if (height < 100) {height = 100};
	DrawAnnotation(objResize.id, width, height);
	SuppressBubble(event);
}

function StopResize(event)
{
	objResize.id = null;
	if(bIE)
	{
		document.detachEvent("onmousemove", Resize);
		document.detachEvent("onmouseup",   StopResize);
	}
	else
	{
		document.removeEventListener("mousemove", Resize, true);
		document.removeEventListener("mouseup",   StopResize, true);
	}
}

var Forms = document.getElementsByTagName("FORM");
for (var i = 0; i < Forms.length; i++) 
{
	var Form = Forms(i);
	Form.onclick = SuppressBubble;
}

function SuppressBubble(event)
{
	if (bIE)
	{
		window.event.cancelBubble = true;
		window.event.returnValue = false;
	}
	else
	{
		if (event) {
			event.stopPropagation();
		}
	}
}

function IsTrueMouseOut(idNoSpace, e)
{
    if (!e) var e = window.event;
	var tg = (window.event) ? e.srcElement : e.target;
	if (tg.id != idNoSpace && tg.id != 'o' + idNoSpace) return false;

    while (tg.nodeName != 'HTML') {
        if (tg.style.visibility == 'hidden') return false;
        tg = tg.parentNode;
    }

	var reltg = (e.relatedTarget) ? e.relatedTarget : e.toElement;
	while (reltg != null && reltg.nodeName != 'HTML') {
		var id = reltg.id
		var i = id.indexOf('Links')
		if (i > 0) {
			if (id.substring(0,i) == tg.id) {
				return false;
			}
		}
		reltg = reltg.parentNode;
		if (reltg.id == idNoSpace) return false;
	}
	return true;
}

function IsTrueMouseOver(idNoSpace, e)
{
    if (!e) var e = window.event;
	var tg = (window.event) ? e.srcElement : e.target;
	if (tg.id != idNoSpace && tg.id != 'o' + idNoSpace) return false;
	var reltg = (e.relatedTarget) ? e.relatedTarget : e.fromElement;
	while (reltg != null && reltg.nodeName != 'HTML') {
		var id = reltg.id
		var i = id.indexOf('Links')
		if (i > 0) {
			if (id.substring(0,i) == tg.id) {
				return false;
			}
		}
		reltg= reltg.parentNode
		if (reltg.id == idNoSpace) return false;
	}
	return true;
}

function NewWindow(hyperlink, name, features, center, width, height)
{
	if(center)
	{
		var winl = (screen.width - width) / 2;
		var wint = (screen.height - height) / 2;
		features = features + ', left=' + winl + ', top=' + wint;
	}
	window.open(hyperlink, name, features);
}

function getQueryVariable(variable) {
  var query = window.location.hash.substring(1);
  var vars = query.split("&");
  for (var i=0;i<vars.length;i++) {
    var pair = vars[i].split("=");
    if (pair[0] == variable) {
      return decodeURI(pair[1]);
    }
  } 
}

var OnLoadVariable = getQueryVariable('ol');

function GetQuerystring() {
    return encodeURI('#ol=' + OnLoadVariable);
}
