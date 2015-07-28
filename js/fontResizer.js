jQuery.noConflict();
jQuery(function($) {	
	function changeSize(element,size)
	{
		var fsize;
		var current=parseInt(element.css('font-size'));
		if(size=="smaller")
		{
			fsize=current-1;
			if(fsize>=8)
			{
				element.css('font-size',fsize+'px');
			}
		}
		if(size=="bigger")
		{
			fsize=current+1;
			if(fsize<=40)
			{
				element.css('font-size',fsize+'px');
			}
		}	
	}

	$('.fa-plus').on('click',function(){
		changeSize($('body'),'bigger');
	})
	$('.fa-minus').on('click',function(){
		changeSize($('body'),'smaller');
	})
	$('.fa-font').on('click',function(){
		$('html body').css('font-size','');
	})
});
