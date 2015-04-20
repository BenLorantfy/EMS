App.Views.SectionView = Backbone.View.extend({
	animate: function(show,back,howMuch,time,fade){
		var $el = $(this.$el);
		var sign = back ? -1 : 1;
		var animation = { progress: 0 };
		
		if(show){
			if(back){
				var scale = 1 + howMuch;
			}else{
				var scale = 1 - howMuch;		
			}
			if(fade){
				$el.css("opacity",0);
				$el.show();						
			}	
		}else{
			var scale = 1;
			if(fade){
				$el.css("opacity",1);
			}
		}
		
		$el.css("transform","scale(" + scale + "," + scale + ")");
		$(animation).stop().animate({ progress: 1 },{
			 duration:time
			,easing:"easeOutQuart"
			,step:function(progress){
				$el.css("transform","scale(" + (scale + sign*progress*howMuch) + "," + (scale + sign*progress*howMuch) + ")");
				if(fade){
					if(show){
						$el.css("opacity",progress);
					}else{
						$el.css("opacity",1 - progress);
					}					
				}
			}
			,complete:function(){
				if(fade){
					if(!show){
						$el.hide();
					}					
				}
			}
		})			 	
	},
	show: function(){
		this.animate(true,true,0.3,800,true);
	},
	hide: function(){
		this.animate(false,true,0.3,800,true);
	},
	reverseHide:function(){
		this.animate(false,false,0.3,800,true);
	},
	reverseShow:function(){
		this.animate(true,false,0.3,800,true);
	},
	dialogyHide: function(){
		this.animate(false,true,0.05,600,true);
	},
	dialogyShow: function(){
		this.animate(true,false,0.05,600,true);
	},
	blur:function(){
		var cover = $("#cover");
		cover.css("opacity",0);
		cover.insertAfter(this.$el);
		cover.show();
		cover.stop().animate({ opacity:1 },600,"easeOutQuart");
		
		this.animate(false,true,0.05,600,false);
	},
	focus:function(){
		var cover = $("#cover");
		cover.stop().animate({ opacity:0 },600,"easeOutQuart",function(){
			cover.hide();
		});	
		
		this.animate(true,false,0.05,600,false);
	},
	visible:function(){
		return this.$el.is(":visible");
	}
	
});