$(document).ready(function(){

	$('.next').live('click', function(event){
		var page = $(this).attr('rel');
		$(this).parent().remove();
		$.get('library/booklist/' + page, function(data) {
			$('#books tr:last').after(data);
		});
	});

	$('.book').live('click', function(event){
		var book = $(this).find('td:first').text();
		$.get('library/bookinfo/' + book, function(data) {
			$('#window .text').html(data);
			var maskHeight = $(document).height();
			var maskWidth = $(window).width();
			$('#mask').css({'width':maskWidth,'height':maskHeight});
			var winH = $(window).height();
			var winW = $(window).width();
			$('#window').css('top',  winH/2-$('#window').height()/2);
			$('#window').css('left', winW/2-$('#window').width()/2);
			$('#mask').fadeIn(200,function(){
				$('#mask').fadeTo("slow",0.8);
			});
			$('#window').fadeIn(200);
			$('#window').fadeTo("slow",1);
		});
	});

	$('#window .close, #mask').click(function() {
		$('#mask, #window').fadeTo("slow",0,function(){
			$('#window, #mask').hide();
		});
	});

});