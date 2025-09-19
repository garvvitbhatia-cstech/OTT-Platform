$(document).ready(function() {

$('.owl-carousel').owlCarousel({

	loop: true,

	margin: 0,

	responsiveClass: true,

	items: 9,
	
	slideBy: 4,

	nav: true,

	loop: false,

	responsive: {

	  0: {

	    items: 3,

	    nav: false

	  },

	   700: {

	    items:4,

	    nav: false

	  },

	  992: {

	    items: 5,

	    nav: true

	  },

	  993: {

	    items: 6,

	    nav: true

	  },

	  1201: {

	    items: 8,

	    nav: true

	  },

	  

	}

	})



$('.owl-carousel-tv').owlCarousel({

	loop: true,

	margin: 0,

	responsiveClass: true,

	items: 6,

	nav: true,

	loop: false,

	responsive: {

	  0: {

	    items: 2,

	    nav: false

	  },

	   700: {

	    items:3,

	    nav: false

	  },

	  992: {

	    items: 4,

	    nav: true

	  },

	  

	  1201: {

	    items: 6,

	    nav: true

	  },

	  

	}

	})



})



document.addEventListener("DOMContentLoaded", function(){

  window.addEventListener('scroll', function() {

      if (window.scrollY > 20) {

        document.getElementById('sticky-header').classList.add('fixed-top');

        // add padding top to show content behind navbar

        navbar_height = document.querySelector('.navbar').offsetHeight;

        document.body.style.paddingTop = navbar_height + 'px';

      } else {

        document.getElementById('sticky-header').classList.remove('fixed-top');

         // remove padding top from body

        document.body.style.paddingTop = '0';

      } 

  });

}); 

