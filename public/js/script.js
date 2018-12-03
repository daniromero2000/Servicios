function showLoader(){
	$('body').append('<div class="ex-loader"><div id="loader"></div></div>');
}
function hideLoader(){				
	$('#ex-global-content').removeClass('ex-loader-blur'); 
	$(".ex-loader").fadeOut(1000,function(){
		$(".ex-loader").remove();
		
	}); 
};
$( document ).ready(function() {


	var heightWindow= $(window).height();
		var heightPreheader = $('#preHeader').height();
		var heightHeaderImage = $('.headerImage').height();
		var heigthToggleResponsive = $('.toggleResponsive').height();
		var scrollWidth =  window.innerWidth - document.documentElement.clientWidth;
		$('.slick-track').css('width','100% !important');
		var heigthToggle= heightWindow - (heightPreheader + heightHeaderImage+heigthToggleResponsive	);
		
		if(window.innerWidth < 991){
			$('.header-containerItemsResponsive').height(heigthToggle);
			var click=1;
			$('.buttonResponsive').click(function(){
				$(this).toggleClass('open');
				if(click==0){				
					$('.header-containerItemsResponsive').css('display','none');
					$(this).css('margin-right','0px');
					$("body").removeClass("no_scroll");
					click=1;
				}else{
					$('.header-containerItemsResponsive').css({'display':'block','margin-top':heigthToggleResponsive+'px'});
					$(this).css('margin-right',scrollWidth+'px');
					$("body").addClass("no_scroll");
					click=0;
				}
			});
		}

		var clickGrayCard=0;
		var clickBlackCard=0;
		var clickBlueCard=0;



		$('.buttonCreditCardGray').on('click',function(){
			if(clickGrayCard==0){
				$('.cardImageGray').css('transform','rotateY(180deg)');
				$('.cardImageBlue').css('transform','rotateY(0deg)');
				$('.cardImageBlack').css('transform','rotateY(0deg)');	
				clickGrayCard=1;
				clickBlueCard=0;
				clickBlackCard=0;
			}else{
				$('.cardImageGray').css('transform','rotateY(360deg)');	
				clickGrayCard=0;
			}

			console.log('Gray '+clickGrayCard);
			
		});

		
		$('.buttonCreditCardBlue').on('click',function(){
			if(clickBlueCard==0){
				$('.cardImageBlue').css('transform','rotateY(180deg)');
				$('.cardImageGray').css('transform','rotateY(0deg)');
				$('.cardImageBlack').css('transform','rotateY(0deg)');		
				clickBlueCard=1;
				clickGrayCard=0;
				clickBlackCard=0;
			}else{
				$('.cardImageBlue').css('transform','rotateY(360deg)');	
				clickBlueCard=0;
			}

			console.log('Blue '+clickBlueCard);
			
		});

		
		$('.buttonCreditCardBlack').on('click',function(){
			if(clickBlackCard==0){
				$('.cardImageBlack').css('transform','rotateY(180deg)');
				$('.cardImageBlue').css('transform','rotateY(0deg)');
				$('.cardImageGray').css('transform','rotateY(0deg)');		
				clickBlackCard=1;
				clickGrayCard=0;
				clickBlueCard=0;
			}else{
				$('.cardImageBlack').css('transform','rotateY(360deg)');	
				clickBlackCard=0;
			}

			console.log('Black '+clickBlackCard);
			
		});

		
	var clikSideBar=0;

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    	

    	$('ul#dashboardList li').click(function(){
    		var tab_id = $(this).find('a').attr('href');
    		console.log(tab_id);

    		
			$('.tab-content').removeClass('current');

			
			$(tab_id).addClass('current');

    	});


    	$('ul#dashboardListIcons li').click(function(){
    		var tab_id = $(this).find('a').attr('href');
    		console.log(tab_id);

    		
			$('.tab-content').removeClass('current');

			
			$(tab_id).addClass('current');

    	});


    

	
});