 $(document).ready(function(){
  $('.plan-carousel').owlCarousel({
    loop:true,
    margin:10,
	autoplay:false,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
	dots:false,
    nav:false,
	 
	             navText:["<div class='nav-btn prev-slide'><i class='fa fa-arrow-left text-white'></i></div>","<div class='nav-btn next-slide'><i class='fa text-white fa-arrow-right'></i></div>"],
	 
    responsive:{
        0:{
            items:1
        },
		200:{
            items:1
        },
		300:{
            items:1
        },
		480:{
            items:1
        },
        600:{
            items:1
        },
		767:{
            items:1
        },
		991:{
            items:2
        },
        1200:{
            items:3
        } 
		 
    }
});
 
});	 


 $(document).ready(function(){
  $('.deposit-carousel').owlCarousel({
    loop:true,
    margin:10,
	autoplay:false,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
	dots:false,
    nav:false,
	 
	             navText:["<div class='nav-btn prev-slide'><i class='fa fa-arrow-left text-white'></i></div>","<div class='nav-btn next-slide'><i class='fa text-white fa-arrow-right'></i></div>"],
	 
    responsive:{
        0:{
            items:1
        },
		200:{
            items:1
        },
		300:{
            items:1
        },
		480:{
            items:1
        },
        600:{
            items:1
        },
		767:{
            items:1
        },
		991:{
            items:2
        },
        1200:{
            items:3
        } 
		 
    }
});
 
});	 

$(document).ready(function(){
  $('.acct-list').owlCarousel({
    loop:true,
    margin:30,
	autoplay:false,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
	dots:false,
    nav:false,
	 
	 
    responsive:{
        0:{
            items:1
        },
		320:{
            items:1
        },
		480:{
            items:1
        },
        600:{
            items:1
        },
		767:{
            items:2
        },
		991:{
            items:2
        },
        1200:{
            items:5
        } 
		 
    }
});
 
});	


/********************************** Inner Pages **********************************/


 function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  document.execCommand("copy");
}
$(".err_msg").on("click", function() {
    $(".alert").removeClass("in").show();
	$(".alert").delay(200).addClass("in").fadeOut(2000);
});


 $(document).ready(function(){
  $('.acct-nots').owlCarousel({
    loop:true,
    margin:20,
	autoplay:false,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
	dots:false,
    nav:false,
	 
	 
	 
    responsive:{
        0:{
            items:1
        },
		200:{
            items:1
        },
		300:{
            items:1
        },
		480:{
            items:1
        },
        600:{
            items:2
        },
		767:{
            items:2
        },
		991:{
            items:3
        },
        1200:{
            items:5
        } 
		 
    }
});
 
});	 