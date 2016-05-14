////////////////////////
// tabs.js 1.0.1      //
// 2012-10-08         //
// SYNCK GRAPHICA     //
// www.synck.com      //
////////////////////////

function addEventSet(elm,listener,fn){
	try {
		elm.addEventListener(listener,fn,false);
	}
	catch(e){
		elm.attachEvent("on"+listener,fn);
	}
}

var tabs = new Object();
var current_hash = location.hash;
function tabs_init(){
	var n = navigator.userAgent;
	if(n.indexOf('Mobile') == -1 || n.indexOf('iPad') > -1){
		var tagObj = document.getElementsByTagName('div');
		for(var i=0;i<tagObj.length;i++){
			if(tagObj[i].className == "tabs")
				tabs[tagObj[i].id] = new Tabs(tagObj[i]);
		}
		setInterval("tabs_check()",300);
	}
}
function tabs_check(){
	if(current_hash != location.hash){
		for(var prop in tabs)
			tabs[prop].change(location.hash.substring(1,location.hash.length));
		current_hash = location.hash;
	}
}
function Tabs(obj){
	this.init = function(obj){
		this.Default = {"default": null,"mobile": false};
		this.DefaultTab = this.att(obj,"data-default");
		this.Mobile = this.att(obj,"data-mobile");
		this.TabDisabled = true;
		if(this.mobile){
			this.TabDisabled = false;
			this.container = obj;
			this.Tabs = new Array();
			this.CurrentTab = location.hash.substring(1,location.hash.length);
			var childs = this.container.childNodes;
			for(var i=0;i<childs.length;i++){
				if(childs[i].className == "tab_inner"){
					if(!this.DefaultTab && !this.CurrentTab) this.DefaultTab = childs[i].id;
					this.Tabs[childs[i].id] = true;
					childs[i].style.display = "none";
					if(document.getElementById('button_'+childs[i].id)){
						document.getElementById('button_'+childs[i].id).style.display = "block";
						document.getElementById('button_'+childs[i].id).style.cursor = "pointer";
					}
				}
			}
			if(!this.Tabs[this.CurrentTab])
				this.CurrentTab = this.DefaultTab;
			this.change(this.CurrentTab);
		}
	}
	this.change = function(tabid){
		if(this.Tabs[tabid] && !this.TabDisabled){
			if(document.getElementById(this.CurrentTab))
				document.getElementById(this.CurrentTab).style.display = "none";
			document.getElementById(tabid).style.display = "block";
			if(document.getElementById('button_'+this.CurrentTab))
				document.getElementById('button_'+this.CurrentTab).className = "";
			if(document.getElementById('button_'+tabid))
				document.getElementById('button_'+tabid).className = "current_tab";
			this.CurrentTab = tabid;
		}
	}
	this.att = function(obj,att){
		if(obj.getAttribute(att)!=undefined)
			return obj.getAttribute(att);
		else
			return this.Default[att.replace("data-","")];
	}
	this.mobile = function(){
		var n = navigator.userAgent;
		if(n.indexOf('Mobile') > -1 && n.indexOf('iPad') == -1){
			if(this.Mobile)
				return true;
			else
				return false;
		}
		else
			return true;
	}
	this.init(obj);
}
try {
	$(document).ready(tabs_init);
}
catch(e){
	addEventSet(window,"load",function(){tabs_init();});
}
