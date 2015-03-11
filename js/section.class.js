var Section = function(selector){	
	var section = $(selector);
	var cover = $("#cover");
	
	function hide(){
		$({ progress:0 }).animate({ progress: 1},{
			 duration:800
			,easing:"easeOutQuart"
			,step:function(progress){
				section.css("transform","scale(" + (1 - progress*0.3) + "," + (1 - progress*0.3) + ")");
				section.css("opacity",1 - progress);
			}
		})
	}
	
	function show(){
		section.css("opacity",0);
		section.show();
		$({ progress:0 }).animate({ progress: 1},{
			 duration:800
			,easing:"easeOutQuart"
			,step:function(progress){
				section.css("transform","scale(" + (1.3 - progress*0.3) + "," + (1.3 - progress*0.3) + ")");
				section.css("opacity",progress);
			}
		})	
	}
	
	function blur(){
		cover.css("opacity",0);
		cover.insertAfter(section);
		cover.stop().animate({ opacity:1 },400,"easeOutQuart");
	}
	
	function focus(){
		cover.stop().animate({ opacity:0 },400,"easeOutQuart");			
	}
	
	return{
		 hide:hide
		,show:show
		,blur:blur
		,focus:focus
	}
}

