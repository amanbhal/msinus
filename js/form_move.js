$(document).ready(function(){
	$('.n_one').click(function(){
					$('.div1').removeClass('show_div');
					$('.div1').addClass('hide');
					$('.div2').removeClass('hide');
					$('.div2').addClass('show_div');
					});
					
				$('.p_two').click(function(){
					$('.div1').removeClass('hide');
					$('.div1').addClass('show_div');
					$('.div2').removeClass('show_div');
					$('.div2').addClass('hide');
					});
				
				$('.n_two').click(function(){
					$('.div2').removeClass('show_div');
					$('.div2').addClass('hide');
					$('.div3').removeClass('hide');
					$('.div3').addClass('show_div');
					});
				
				$('.p_three').click(function(){
					$('.div2').removeClass('hide');
					$('.div2').addClass('show_div');
					$('.div3').removeClass('show_div');
					$('.div3').addClass('hide');
				});
});



/*
$(document).ready(function(){
				$('.n_one').click(function(){
					$('.div1').animate({left:"-79%"},500);
					$('.div2').animate({left:"6%"},500);
					$('.div3').animate({left:"91%"},500);
					});
					
				$('.p_two').click(function(){
					$('.div1').animate({left:"6%"},600);
					$('.div2').animate({left:"91%"},600);
					$('.div3').animate({left:"176%"},600);
					});
				
				$('.n_two').click(function(){
					$('.div1').animate({left:"-164%"},600);
					$('.div2').animate({left:"-79%"},600);
					$('.div3').animate({left:"6%"},600);
					});
				
				$('.p_three').click(function(){
					$('.div1').animate({left:"-79%"},600);
					$('.div2').animate({left:"6%"},600);
					$('.div3').animate({left:"91%"},600);
					});
				});
*/