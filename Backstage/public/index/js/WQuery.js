Util = {
	getClass: function(tar,parent){
		var parent = parent || document;
		if(document.getElementsByClassName){
			return parent.getElementsByClassName(tar);
		}else{
			var reslut = [],
				arr = [],
				All = document.getElementsByTagName('*'),
				len = All.length;
				for(var i = 0; i < len; i++){
					arr = All[i].className.split(' ');
					for(var j = 0; j < arr.length; j++){
						if(arr[j] === tar){
							reslut.push(All[i]);
						}
					}
				}
				return reslut;
		}
	},

	filter: function(arr,tar){
		if(!arr.push){
			var reslut = [];
			Util.pushArray(reslut,arr);
		}else{
			var reslut = arr;
		}

		if(tar){
			for(var i = 0,len = reslut.length; i < len; i++){
				if(reslut[i] === tar){
					reslut.splice(i,1);
				}
			}
		}else{
			for(var i = 0,len = reslut.length; i < len; i++){
				for(var j = i + 1; j < len; j++){
					if(reslut[j] === arr[i]){
						reslut.splice(j,1);
					}
				}
			}
		}
		return reslut;
	},

	myEvent: function(obj,sEven,fn){
		obj.attachEvent ? obj.attachEvent('on' + sEven,function(){ if(fn.call(obj,event) === false){ event.cancelBubble = true; return false} }) : obj.addEventListener(sEven,function(ev){ if(fn.call(obj,ev) === false){ ev.cancelBubble = true; ev.preventDefault(); } },false);
	},
	
	setStyle: function(obj,attr,value){
		var arr = ['opacity','background','position','cursor','display','zIndex','color'];
		
		for(var i = 0,len = arr.length; i < len;){
			if(attr === arr[i]){
				obj.style[attr] = value;
				return;
			}else{
				i++;
			}
		}

		obj.style[attr] = value + 'px';
	},

	getStyle: function(obj,attr){
		var reslut = [];
		function pushReslut(method){
			for(var i = 0, len = attr.length; i < len; i++){
				var key = attr[i];
				reslut.push(method[key]);
			}
			return reslut;
		}

		return obj.currentStyle ? attr.constructor === Array ? pushReslut(obj.currentStyle) : obj.currentStyle[attr] : attr.constructor === Array ? pushReslut(getComputedStyle(obj,false)) : getComputedStyle(obj,false)[attr];
	},

	myEach: function(elem,action){
		for(var i = 0,len = elem.length; i < len; i++){
			action(elem[i],i)
		}
	},

	pushArray: function(arr1,arr2){
		for(var i = 0,len = arr2.length; i < len; i++){
			arr1.push(arr2[i]);
		}
	},
	//解决把某个数组里面的元素替换掉原来WQ的元素; 空WQ自带一个elements : undefined; 返回值是WQuery;
	pushElemen: function(elements){
		var reslut = [],
			WQ = new WQuery();
		if(elements.constructor === Array || elements.constructor === HTMLCollection){
			Util.myEach(elements,function(obj){
				reslut.push(obj);
			});
		}else{
			reslut.push(elements);
		}
		
		WQ.elements = reslut;
		return WQ;
		
	},

	quickSort: function(arr,boolean){
		if(arr.length <= 1) return arr;
		var num = Math.floor(arr.length / 2),
			numValue = arr.splice(num,1),
			left = [],
			right = [];
			if(!boolean){
				for(var i = 0; i < arr.length; i++){
					if(arr[i] < numValue){
						left.push(arr[i])
					}else{
						right.push(arr[i]);
					}
				}
				return Util.quickSort(left).concat(numValue,Util.quickSort(right));
			}else{
				for(var i = 0; i < arr.length; i++){
					if(arr[i] > numValue){
						left.push(arr[i])
					}else{
						right.push(arr[i]);
					}
				}
				return Util.quickSort(left,boolean).concat(numValue,Util.quickSort(right,boolean));
			}			
	},

	setCookie: function(key, value, t){
		var oDate = new Date();
			oDate.setSeconds(oDate.getSeconds() + t);
			document.cookie = key + '=' + value + ';expires=' + oDate.toGMTString();
	},

	getCookie: function(key){
		var arr1 = document.cookie.split('; ');
			for(var i = 0,len = arr1.length; i < len; i++){
				var arr2 = arr1[i].split('=');
				if(arr2[0] === key){
					return arr2[1];
				}
			}
	},

	removeCookie: function(key){
		Util.setCookie(key,'',-1);
	}
};

window.requestAnimFrame = (function(){
	return window.requestAnimationFrame || 
		   window.webkitRequestAnimationFrame || 
		   window.mozRequestAnimationFrame || 
		   function( callback ){
		   	window.setTimeout(callback,1000/60);
		   }
})();


function WQuery(Arg){
	this.elements = [];
	switch(typeof Arg){
		case 'function' : 
			Util.myEvent(window,'load',Arg);
			break;
		case 'string' :
			var context = this.trim(Arg),
				arr = context.match(/\s+/g);
				if(!arr){
					var firstChar = Arg.charAt(0);
					name = Arg.substr(1);
					switch(firstChar){
						case '#' : 
						this.elements.push(document.getElementById(name));
						break;
						case '.' : 
						var elements = Util.getClass(name);
							this.pushArray(elements);
						break;
						default: 
						var elements = document.getElementsByTagName(Arg);
							this.pushArray(elements);
					}
				}else{
					this.pushArray(document.querySelectorAll(Arg));
				}
			break;
		default:
			this.elements.push(Arg);
	}
};

//一些常用的工具方法吧！！
WQuery.prototype = {
	constructor: WQuery,

	trim: function(str){
		return str.replace(/(^\s+)|(\s+$)/g,'')
	},
	ltrim: function(str){
		return str.replace(/^\s+/,'');
	},
	rtrim: function(str){
		return str.replace(/\s+$/,'');
	},

	toArray: function(){
		var reslut = [];
			Util.pushArray(reslut,this.elements);
			return reslut;
	}
};

WQuery.prototype.pushArray = function(elements){
	var len = elements.length;
		for(var i = 0; i < len; i++){
			this.elements.push(elements[i]);
		}
};

WQuery.prototype.click = function(fn){
	Util.myEach(this.elements,function(obj){
		Util.myEvent(obj,'click',fn)
	});
};

WQuery.prototype.css = function(attr,value){
	var len = arguments.length;
	if(len === 2){
		for(var i = 0, len = this.elements.length; i < len; i++){
			Util.setStyle(this.elements[i],attr,value);
		}
	}else{
		switch(typeof attr){
			case 'string' :
			return Util.getStyle(this.elements[0],attr);
			break;
			default:
				switch(attr.constructor){
					case Array :
					return Util.getStyle(this.elements[0],attr);
					break;
					default :
					for(var i = 0, len = this.elements.length; i < len; i++){
						var elem = this.elements[i];
						for(var key in attr){
							Util.setStyle(elem,key,attr[key]);
						}
					}
				}
		}
	}
	return this;
};

WQuery.prototype.hover = function(fnOver,fnOut){
	// var i = 0,
	// 	len = this.elements.length;
	// while(i < len){
	// 	Util.myEvent(this.elements[i],'mouseenter',fnOver);
	// 	Util.myEvent(this.elements[i],'mouseleave',fnOut);
	// 	i++;
	// }

	if(!fnOut){
		Util.myEach(this.elements,function(obj){
			Util.myEvent(obj,'mouseenter',fnOver);
		});		
	}else{
		Util.myEach(this.elements,function(obj){
			Util.myEvent(obj,'mouseenter',fnOver);
			Util.myEvent(obj,'mouseleave',fnOut);
		});
	}
};

WQuery.prototype.hide = function(){
	Util.myEach(this.elements,function(obj){
		obj.style.display = 'none';
	});
	return this;
};

WQuery.prototype.show = function(){
	Util.myEach(this.elements,function(obj){
		obj.style.display = 'block';
	});
	return this;
};

WQuery.prototype.find = function(children){
	var reslut = [],
		elements = null,
		This = this,
		WQ = new WQuery(),
		firstChar = children.charAt(0),
		name = children.substr(1);
		switch(firstChar){
			case '.': 
			Util.myEach(this.elements,function(obj){
				elements = Util.getClass(name,obj);
				Util.pushArray(reslut,elements);
			});
			break;
			default: 
			Util.myEach(this.elements,function(obj){
				elements = obj.getElementsByTagName(children);
				Util.pushArray(reslut,elements);
			});
		}

		WQ.elements = reslut;
		return WQ;
};

WQuery.prototype.eq = function(n){
	return Util.pushElemen(this.elements[n]);
};

WQuery.prototype.each = function(action){
	Util.myEach(this.elements,function(obj,index){
		action(obj,index)
	});
	return this;
};


WQuery.prototype.index = function(){
	var elem = this.elements[0],
		oBrother = this.elements[0].parentNode.children;
		for(var i = 0,len = oBrother.length; i < len; i++){
			if(oBrother[i] === elem){
				return i;
			}
		}
};


WQuery.prototype.toggle = function(){
	var	len = this.elements.length,
		i = 0,
		_arguments = arguments;
		while(i < len){

			(function(obj){
				var count = 0;
				Util.myEvent(obj,'click',function(){
					_arguments[count++%_arguments.length].call(this);
				});
			})(this.elements[i]);

			i++;
		}
};

WQuery.prototype.anim = function(json,style,callback){
	if(typeof style === 'boolean'){
		if(style){
			Util.myEach(this.elements,function(obj){
				elasMove(obj,json)
			})
		}else{
			Util.myEach(this.elements,function(obj){
				startMove(obj,json,callback);
			})
		}
	}else if(typeof style === 'number'){
		Util.myEach(this.elements,function(obj){
			TimeMove(obj,json,style,callback)
		});
	}else{
		Util.myEach(this.elements,function(obj){
			startMove(obj,json,callback)
		})
	}
	
	function startMove(obj,json,fn){
		clearInterval(obj.timer);
		obj.timer = setInterval(function(){
			var iStop = true;
			for(var attr in json){
				var iCur = attr === 'opacity' ? parseInt(parseFloat(Util.getStyle(obj,attr)) * 100) : parseInt(Util.getStyle(obj,attr)),
				iSpeed = (json[attr] - iCur) / 8;
				iSpeed = iSpeed < 0 ? Math.floor(iSpeed) : Math.ceil(iSpeed);
				
				if(iCur != json[attr]){
					iStop = false;
				}


				iCur += iSpeed;
				if(attr === 'opacity'){
					obj.style[attr] = iCur / 100;
					obj.style.filter = 'alpha(opacity:'+iCur+')';
				}else{
					obj.style[attr] = iCur + 'px';
				}
			};

			if(iStop){
				clearInterval(obj.timer);
				fn && fn();
			}
		},1000/60)
	};

	function elasMove(obj,json){
		for(var key in json){
			(function (obj,attr,tar){
				clearInterval(obj[attr]);
				var left = obj[getKey(attr)],
					iSpeed = 0;
				obj[attr] = setInterval(function(){
					iSpeed += (tar - left) / 5;
					iSpeed *= .75;
					if(Math.abs(iSpeed) < 1 && Math.abs(tar - left) < 1){
						clearInterval(obj.timer);
						obj.style[attr] = tar + 'px';
					}else{
						left += iSpeed;
						obj.style[attr] = left + 'px';
					}
				},1000/60);
			})(obj,key,json[key]);
		};
		
		function getKey(key){
			switch(key){
				case 'left' :
				return 'offsetLeft';
				break;
				case 'top' :
				return 'offsetTop';
				break;
				case 'height' :
				return 'offsetHeight';
				break;
				default :
				return 'offsetWidth';
			}
		}
	};

	function TimeMove(obj,json,time,callback){
		clearInterval(timer);
		var startValue = [],
				endValue = [],
				nowTime = 0,
				timer = null;
		for(var key in json){
			startValue.push(key === 'opacity' ? parseInt(parseFloat(Util.getStyle(obj,key) * 100)) : parseInt(Util.getStyle(obj,key)));
			endValue.push(json[key]);
		}
		nowTime = new Date();

		timer = setInterval(function(){
			var iCurTime = new Date(),
				n = (iCurTime - nowTime) / time;
				var i = 0;

			for(var attr in json){
				if(n >= 1){
						clearInterval(timer);
						obj.style[attr] = endValue[i] + 'px';
					}else{
						var iCurValue = n * (endValue[i] - startValue[i]) + startValue[i];
						Util.setStyle(obj,attr,iCurValue);
					}
				i++;
			}
		},1000/60);
	};

};

WQuery.prototype.myAjax = function(opt){ 
	var opt = opt || {};
	    opt.method = opt.method || 'GET';
	    opt.url = opt.url || '';
	    opt.async = opt.async || true; 
	    opt.data = opt.data || null;
	    opt.dataType = opt.dataType || 'JSON'
	    opt.success = opt.success || function () {
        };
    var xmlHttp = null;
    if (XMLHttpRequest) { 
        xmlHttp = new XMLHttpRequest();
    }
    else {
        xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
    }
    var params = [];
    for (var key in opt.data)params.push(key + '=' + opt.data[key]);
    var postData = params.join('&');
    if (opt.dataType === 'JSONP') {
        creatScript(opt.url, postData);
    } else {
        if (opt.method.toUpperCase() === 'POST') {
            xmlHttp.open(opt.method, opt.url, opt.async);
            xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;charset=utf-8');
            xmlHttp.send(postData);
        }
        else if (opt.method.toUpperCase() === 'GET') {
            xmlHttp.open(opt.method, opt.url + '?' + postData, opt.async);
            xmlHttp.send(null);
        }
        xmlHttp.onreadystatechange = function () {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                if (opt.dataType === 'JSON') {
                	opt.success(JSON.parse(xmlHttp.response));
                }else{
                	 opt.success(xmlHttp.response);
                }
            }
        };
    }
    function creatScript(url, data) {
	    var oScript = document.createElement('script');
	    oScript.src = url + '?' + data + '&callback=getEn';
    	document.body.appendChild(oScript);
	}
};

WQuery.prototype.random = function(num){
	var WQ = new WQuery();
		num ? function(){
			for(var i = 0; i < num; i++){
				var len = this.elements.length,
				ran = ~~(Math.random() * len);
				WQ.elements[i] = (this.elements[ran]);
				this.elements.splice(ran,1);
			}
		}.call(this) : WQ.elements = this.elements[~~(Math.random() * this.elements.length)];
		return WQ;
};	


WQuery.prototype.bind = function(sEven,fn){
	Util.myEach(this.elements,function(obj){
		Util.myEvent(obj,sEven,fn);
	});
};

WQuery.prototype.drag = function(parent){
	var zIndex = Util.getStyle(this.elements[0],'zIndex');
		zIndex = zIndex === 'auto' ? 1 : zIndex;
	Util.myEach(this.elements,function(obj){
		drag(obj);
	})


	function drag(obj){
		var minX,minY,maxX,maxY,dsiX,disY;
		var	W = obj.offsetWidth,
			H = obj.offsetHeight,
			wW = window.innerWidth,
			wH = window.innerHeight;
			if(!parent){
				minX = 0;
				minY = 0;
				maxY = wH - H;
				maxX = wW - W;
			}else{
				var bW = parseInt(Util.getStyle(parent,'borderWidth')),
					oH = parent.clientHeight,
					oW = parent.clientWidth;
				minX = parent.offsetLeft + bW;
				minY = parent.offsetTop + bW;

				maxX = oW - W;
				maxY = bW + oH - H;
			}

			Util.myEvent(window,'resize',function(){
				wW = window.innerWidth;
				wH = window.innerHeight;
				maxY = wH - H;
				maxX = wW - W;
			});

		obj.onmousedown = down;

		function down(ev){
			var ev = ev || window.event;
				disX = ev.clientX - this.offsetLeft;
				disY = ev.clientY - this.offsetTop;
				This = this;
				this.style.zIndex = ++zIndex;
			document.onmousemove = move.bind(this);

			this.onmouseup = stop;
			return false;
		};

		function move(){
			var ev = ev || window.event,
				X = ev.clientX - disX,
				Y = ev.clientY - disY,
				left,top;
				

				// if(ev.clientX < minX || ev.clientY < minY || (ev.clientX - parent.offsetLeft - W) > maxX || (ev.clientY - parent.offsetTop - H) > maxY){
				// 	stop(this);
				// }
				
				if(ev.clientX < 0 || ev.clientX > wW || ev.clientY < 0 || ev.clientY > wH){
					stop(this)
				}

				left = Math.min(Math.max(0,X),maxX);
				top = Math.min(Math.max(0,Y),maxY);
				this.style.left = left + 'px';
				this.style.top = top + 'px';
		};

		function stop(obj){
			obj.onmouseup = null;
			document.onmousemove = null;
		};
	 }
};

WQuery.prototype.move = function(bigTime,smallTime){
	time = bigTime <= 2 ? bigTime * 1000 : bigTime;
	var timer1 = null,
		timer2 = null,
		len = this.elements.length,
		height = this.elements[0].clientHeight / 2,
		i = 0,
		elements = this.elements,
		turn = true;
		timer1 = setInterval(function(){
			turn = !turn;
			timer2 = setInterval(toChange,smallTime);
		},time);

		function toChange(){
			if(i > (len - 1)){
				clearInterval(timer2);
				i = 0;
			}else{
				if(turn){
					$(elements[i++]).anim({top:0})
				}else{
					$(elements[i++]).anim({top:-height})
				}
			}
		};
};

WQuery.prototype.extend = function(name,fn){
	if(typeof this[name] === 'function'){
		if(this[name] === fn){
			return 
		}else{
			if(confirm('是否替换'+ name +'该函数？')){
				WQuery.prototype[name] = fn;
			}else{
				alert('那么请修改函数名！！')
			}
		}
	}
};

WQuery.prototype.extending = function(json){
	//核心继承的方法
	for(var i in json){
		if(typeof this[i] === 'function'){
			alert('已存在'+i+'同名函数,无法重写,请修改');
		}else{
			WQuery.prototype[i] = json[i];
		}
	}
};



//关于样式操作的一些方法
$().extending({
	attr: function(attr,value){
		if(value){
			Util.myEach(this.elements,function(obj){
				obj.setAttribute(attr,value);
			});
		}else{
			return this.elements[0].getAttribute(attr);
		}
	},
	addClass: function(context){
		Util.myEach(this.elements,function(obj){
			obj.className = obj.className + ' ' + context;
		});
	},
	removeClass: function(context){
		//需要改进
		var arr = context.split(' ');
		for(var i = 0, len = arr.length; i < len; i++){
			Util.myEach(this.elements,function(obj){
				obj.className = obj.className.replace(arr[i],'');
			});
		}
	},
	removeAttr: function(attr){
		Util.myEach(this.elements,function(obj,index){
			obj.removeAttribute(attr);
		});
	}
});

//关于操作元素集合的方法
$().extending({
	add: function(context){
		if(!this.elements[0]) this.elements = [];
		if(typeof context ==='string'){
			var WQ = new WQuery(this.trim(context));
				this.pushArray(WQ.elements);
		}else{
			if(context.length){
				this.pushArray(context);
			}else{
				if(!context.constructor === WQuery){
					this.elements.push(context);
				}else{
					this.pushArray(context.elements)
				}
			}
		}
		return this;	
	},

	sibling: function(context){
		var reslut = [];
		if(!context){
			a.call(this,'*');
		}else{
			var firstChat = context.charAt(0),
				name = context.substr(1);
			if(firstChat === '.'){
				console.log(1)
				for(var i = 0,len = this.elements.length; i < len; i++){
					var oParent = this.elements[i].parentNode,
						oChild = Util.getClass(name,oParent);
						Util.pushArray(reslut,Util.filter(oChild,this.elements[i]));
				}
				
			}else{
				a.call(this,context);
			}
		}
		
		return Util.pushElemen(Util.filter(reslut));
		
		function a(style){
			for(var i = 0,len = this.elements.length; i < len; i++){
					var oParent = this.elements[i].parentNode,
						oChild = oParent.getElementsByTagName(style);
						Util.pushArray(reslut,Util.filter(oChild,this.elements[i]));	
				}
		};
	},

	first: function(){
		return Util.pushElemen(this.elements[0]);
	},

	last: function(){
		return Util.pushElemen(this.elements[this.elements.length - 1]);
	},

	prev: function(){

	},

	next: function(){
		
	},

	html: function(text){
		if(!text){
			return this.elements[0].innerHTML;
		}else{
			Util.myEach(this.elements,function(obj){
				obj.innerHTML = text;
			});
			return this;
		}
	},

	val: function(value){
		if(!value){
			return this.elements[0].value;
		}else{
			Util.myEach(this.elements,function(obj){
				obj.value = value;
			});
			return this;
		}
	},

	insertBefore: function(elements){

	},

	insertAfter: function(){

	}
});

//关于尺寸的一些常用方法
$().extending({
	width: function(is){
		//获取纯净的宽度
		var reslut = [];
		if(!is){
			return parseInt(Util.getStyle(this.elements[0],'width'));
		}else{
			Util.myEach(this.elements,function(obj){
				reslut.push(parseInt(Util.getStyle(obj,'width')));
			});

			return reslut;
		}
	},
	height: function(is){
		//获取纯净的高度
		var reslut = [];
		if(!is){
			return parseInt(Util.getStyle(this.elements[0],'height'));
		}else{
			Util.myEach(this.elements,function(obj){
				reslut.push(parseInt(Util.getStyle(obj,'height')));
			});

			return reslut;
		}
	},
	innerWidth: function(is){
		//获取带内边距的宽度
		var reslut = [];
		if(!is){
			return this.elements[0].clientWidth;
		}else{
			Util.myEach(this.elements,function(obj){
				reslut.push(obj.clientWidth);
			});

			return reslut;
		}
	},
	innerHeight: function(){
		//获取带内边距的高度
		var reslut = [];
		if(!is){
			return this.elements[0].clientHeight;
		}else{
			Util.myEach(this.elements,function(obj){
				reslut.push(obj.clientHeight);
			});

			return reslut;
		}
	},
	outerHeight: function(is){
		//获取带边框以及内边距的高度
		var reslut = [];
		if(!is){
			return this.elements[0].offsetHeight;
		}else{
			Util.myEach(this.elements,function(obj){
				reslut.push(obj.offsetHeight);
			});

			return reslut;
		}
	},
	outerWidth: function(is){
		//获取带边框以及内边距的宽度
		var reslut = [];
		if(!is){
			return this.elements[0].offsetWidth;
		}else{
			Util.myEach(this.elements,function(obj){
				reslut.push(obj.offsetWidth);
			});

			return reslut;
		}
	}
});

//关于一些效果的操作
$().extending({
	//逐渐改变被选元素的不透明度，从隐藏到可见
	//关于深度淡入: 一个元素本来是透明1。如果开启深度淡入。即从0开始淡入; 不开启则一动不动
	fadeIn: function(time,boolean){
		var time = time || 1000,
			newTime = new Date();
		Util.myEach(this.elements,function(obj){
			clearInterval(obj.timer);
			var opacity = parseInt(parseFloat(Util.getStyle(obj,'opacity')) * 100),
				endValue = 100;
				opacity = opacity == 100 ? boolean ? 0 : 100 : opacity;

				if(boolean){
					obj.style.opacity = opacity / 100;
					obj.style.filter = 'alpha(opacity'+opacity+')';
				}

				obj.style.display = 'block';
			obj.timer = setInterval(function(){
				var curTime = new Date(),
					n = (curTime - newTime) / time;
					if(n >= 1){
						clearInterval(obj.timer);
						obj.style.opacity = endValue / 100;
						obj.style.filter = 'alpha(opacity:'+endValue+')';
						return;
					}else{
						var iCurValue =　n * (endValue - opacity) + opacity;
							obj.style.opacity = iCurValue / 100;
							obj.style.filter = 'alpha(opacity:'+iCurValue+')';
					}
			},1000/60);
		});
	},
	//逐渐改变被选元素的不透明度，从可见到隐藏
	//关于深度淡出: 一个元素本来是透明0。如果开启深度淡出。即从1开始淡出; 不开启则一动不动； fade时间到了会隐藏元素
	fadeOut: function(time,boolean){
		var time = time || 1000,
			newTime = new Date();
		Util.myEach(this.elements,function(obj){
			clearInterval(obj.timer);
			var opacity = parseInt(parseFloat(Util.getStyle(obj,'opacity')) * 100),
				endValue = 0;
				opacity = opacity == 0 ? boolean ?  100 : 0 : opacity;
				if(boolean){
					obj.style.opacity = opacity / 100;
					obj.style.filter = 'alpha(opacity'+opacity+')';
					obj.style.display = 'block';
				}
			obj.timer = setInterval(function(){
				var curTime = new Date(),
					n = (curTime - newTime) / time;
					if(n >= 1){
						clearInterval(obj.timer);
						obj.style.opacity = endValue / 100;
						obj.style.filter = 'alpha(opacity:'+endValue+')';
						obj.style.display = 'none';
						return;
					}else{
						var iCurValue =　n * (endValue - opacity) + opacity;
							obj.style.opacity = iCurValue / 100;
							obj.style.filter = 'alpha(opacity:'+iCurValue+')';
					}
			},1000/60);
		});
	},
	//可以指定透明质值
	fadeTo: function(value,time){
		var time = time || 0,
			newTime = new Date();
		Util.myEach(this.elements,function(obj){
			clearInterval(obj.timer);
			obj.style.display = 'block';
			var opacity = parseInt(parseFloat(Util.getStyle(obj,'opacity')) * 100),
				endValue = value;
			obj.timer = setInterval(function(){
				var curTime = new Date(),
					n = (curTime - newTime) / time;
					if(n >= 1){
						clearInterval(obj.timer);
						obj.style.opacity = endValue / 100;
						obj.style.filter = 'alpha(opacity:'+endValue+')';
						if(endValue === 0){
							obj.style.display = 'none';
						}
						return;
					}else{
						var iCurValue =　n * (endValue - opacity) + opacity;
							obj.style.opacity = iCurValue / 100;
							obj.style.filter = 'alpha(opacity:'+iCurValue+')';
					}
			},1000/60);
		});
	}	
});

function $(Arg){
	return new WQuery(Arg);
};

if(!Function.prototype.bind){
    Function.prototype.bind = function(){
        if(typeof this !== 'function'){
　　　　　　throw new TypeError('Function.prototype.bind - what is trying to be bound is not callable');
　　　　}
        var _this = this;
        var obj = arguments[0];
        var ags = Array.prototype.slice.call(arguments,1);
        return function(){
            _this.apply(obj,ags);
        };
    };
}