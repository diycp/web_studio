Util.myEvent(window,'load',function(){
	//导航的弹性滚动
	(function(){
		// var oLi = Util.getClass('proto')[0].getElementsByTagName('li'),
		// 	oCover = Util.getClass('cover')[0],
		// 	oUl = oCover.getElementsByTagName('ul')[0],
		// 	len = oLi.length;
		// 	init();
		// 	function init(){
		// 		for(var i = 0; i < len; i++){
		// 			oLi[i].index = i;
		// 			oLi[i].onmouseenter = function(){
		// 				var h = this.offsetLeft;
		// 				zero(h + 1);
		// 			};
		// 		};
		// 	};

		// 	function zero(value){
		// 		$(oCover).anim({left: value},true);
		// 		$(oUl).anim({left: -value},true);
		// 	}

	})();

	//头部顶部的字体特效
	(function(){
		var oP = Util.getClass('text')[0].getElementsByTagName('p'),
			oP1 = oP[0],
			oP2 = oP[1],
			oText1 = oP[0].innerText.substr(2),
			oText2 = oP[1].innerText,
			timer = null,
			i = 0,
			j = 0,
			len1 = oText1.length - 1,
			len2 = oText2.length - 1;


			oP[0].innerHTML = '<span class="dream">梦</span><span class="think">想</span>';
			oP[1].innerHTML = '';
			var html = oP[0].innerHTML,
				str = '';
			timer = setInterval(function(){
					if(i < len1){
						oP1.innerHTML = html + oText1[i++] + '_';
						html = oP1.innerHTML.replace(/_?/g,'');
					}else{
						if(j < len2){
							oP1.innerHTML = oP1.innerHTML.replace(/_?/g,'');
							oP2.innerHTML = str + oText2[j++] + '_';
							str = oP2.innerHTML.replace(/_?/g,'');
						}else{
							oP[1].innerHTML = oP2.innerHTML.replace(/_?/g,'');
							clearInterval(timer);
						}
					}
			},500);
	})();

	//选项卡的实例
	(function(){
		// var tab1 = new Tab('login');
		// 	tab1.init();
	})();

	//这个是底部的点击效果
	(function(){
		$('.selectbox').click(function(){
			$('.selectbox').find('.hide').hide().each(function(item,index){
				item.isbtn = false;
			});

			if(!this.isbtn){
				$(this).find('.hide').show();
				this.isbtn = true;
			}else{
				$(this).find('.hide').hide();
				this.isbtn = false;
			}
		});
		bind('.selectone');
		bind('.selecttwo');
		bind('.selectthree');

		//点击选择框内容替换当前内容
		function bind(parClass){
			$(parClass).find('.select').click(function(){
				$(parClass).find('.cur').html($(this).html());
			});
		};
	})();

	//登陆效果的特效
	// (function(){
	// 	//登陆部分核心特效
		
	// 	var startWidth = 150,
	// 		startHeight = 48,
	// 		endWidth = 240,
	// 		loginEndHeight = 200,
	// 		registerEndHeight = 200;

	// 	$('.fixed').find('.userstate').bind('mouseenter',function(){
	// 		var This = this;
	// 		$(this).find('.iconfont').addClass('on');
	// 		$(this).anim({width:endWidth},function(){},function(){
	// 			$('.fixed').find('.userstate').anim({height:loginEndHeight},function(){},function(){
	// 				This.style = '';
	// 				This.className = 'userstate box end';
	// 			});
	// 		});
	// 	});

	// 	$('.fixed').find('.userstate').bind('mouseleave',function(){
	// 		var This = this;
	// 		Util.getClass('user_title')[0].getElementsByTagName('i')[0].className = 'iconfont icon-menu-down';
			
	// 		$(this).anim({height:startHeight},function(){},function(){
	// 			$('.fixed').find('.userstate').anim({width:startWidth},function(){},function(){
	// 				This.style = '';
	// 				This.className = 'userstate box start';
	// 			})
	// 		});
	// 	});

	// 	// $('.fixed').find('.register').bind('mouseenter',function(){
	// 	// 	var This = this;
	// 	// 	$(This).anim({width:endWidth},function(){},function(){
	// 	// 		$(This).anim({height:registerEndHeight},function(){},function(){
	// 	// 			This.style = '';
	// 	// 			This.className = 'register box end';
	// 	// 		});
	// 	// 	});
	// 	// });

	// 	// $('.fixed').find('.register').bind('mouseleave',function(){
	// 	// 	var This = this;
	// 	// 	$(This).anim({height:startHeight},function(){},function(){
	// 	// 		$(This).anim({width:startWidth},function(){},function(){
	// 	// 			This.style = '';
	// 	// 			This.className = 'register box start';
	// 	// 		})
	// 	// 	})
	// 	// });
	// })();

	//导航数据渲染
	(function(){
		var xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function(){
			if(xhr.readyState == 4){
				var arr = JSON.parse(xhr.responseText);
				nav = new Nav(arr['data']);
				nav.bind();								
			}
		}
		xhr.open('get', js_var.categoryUrl);
		xhr.send(null);				
	})();

	//用户登陆状态的框框
	(function(){
		
	})();

	//首页登陆按钮的点击
	(function(){
		var oCover = Util.getClass('cover')[0],
			user_manage = Util.getClass('user_manage')[0],
			user_box_close1 = Util.getClass('icon-close1')[0];

		$('.login').click(function(){
			if(!oCover || !user_manage || !user_box_close1) return;
			$(oCover).show();
			$(user_manage).show().anim({right:0});
			$(user_box_close1).click(function(){
				$(oCover).hide();
				$(user_manage).anim({right:-730},function(){},function(){
					$(user_manage).hide();
				});
			});

			$(user_manage).find('.user_box_nav').find('li').each(function(item,index){
				var width = $(item).outerWidth();

					$(item).click(function(){
						var leftX = (width - $(user_manage).find('.cur_line').outerWidth()) / 2;
						$(user_manage).find('.cur_line').anim({left: (index * width) + leftX});
					});
			});

			return false;
		});
	})();

	//遮罩层随着窗口缩放变化
	(function(){
		var oCover = Util.getClass('cover')[0];
		window.onresize = BindReSize();

		function BindReSize(){
			oCover.style.height = document.body.scrollHeight + 'px';
			oCover.style.width = document.body.scrollWidth + 'px';
			return BindReSize;
		};

	})();
});




function Tab(id){
	this.oDemo = document.getElementById(id) || Util.getClass(id)[0];
	this.oTab = this.oDemo.getElementsByTagName('ul')[0].getElementsByTagName('li');
	this.oForm = this.oDemo.getElementsByTagName('form');
	this.len = this.oTab.length;
	this.oDemo = document.getElementById(id) || Util.getClass(id)[0];
	this.oCon = Util.getClass('con',this.oDemo)[0];
	this.turn = true;
	this.timer = null;
	this.index = 0;
}

Tab.prototype.init = function(){
	for(var i = 0; i < this.len; i++){
		this.oTab[i].index = i;
		this.oTab[i].onclick = this.change.bind(this,this.oTab[i]);
	}
};

Tab.prototype.change = function(obj){
	if(this.index == obj.index) return;
	this.turn = !this.turn;
	for(var i = 0; i < this.len; i++){
		this.oTab[i].className = this.turn ? 'gradient fr' : 'gradient fl';
	}
	obj.className = this.turn ? 'active fl' : 'active fr';
	this.index = obj.index;
};


function Nav(arr){
	this.one = [];
	this.two = [];
	for(var key in arr){
		this.one.push(arr[key]);
		this.two.push(arr[key]["subCatName"]);
	}
}

Nav.prototype.bind = function(){
	var oDiv = Util.getClass('proto')[0].getElementsByTagName('ul')[0],
		html = '',
		arr = ['one','two','three','four','six','seven','eight','night'];
		html += '<li class="oparent">';
		html +=	'<a href="'+js_var.homeUrl+'" title="首页">首页</a>';
		html += '</li>';
		for(var i = 0,len = this.one.length; i < len; i++){
			var subNav = this.two[i];
			html += '<li class="oparent">';
				if(subNav.length > 0){
					html +=	'<a href="#">'+this.one[i]['catName']+'</a>';
				} else {
				html +=	'<a href="'+js_var.newListUrl+'?id='+this.one[i]["cid"]+'&name='+this.one[i]['catName']+'" title="'+this.one[i]['catName']+'">'+this.one[i]['catName']+'</a>';
				}
				html += '<div class="hide">';			
					html += '<ul class="position">';			
						for(var j = 0; j < subNav.length; j++){
							html += '<li class='+arr[j]+'><a href="'+js_var.newListUrl+'?id='+subNav[j]["cid"]+'&name='+subNav[j]['catName']+'" title="'+subNav[j]['catName']+'" >'+subNav[j]['catName']+'</a></li>';						}	
					html += '</ul>';
				html += '</div>';
			html += '</li>';
		}
		html += '<li class="oparent">';
		html +=	'<a href="'+js_var.joinUrl+'" title="申请加入">申请加入</a>';
		html += '</li>';
	oDiv.innerHTML = html;
}

