//Scroll Animations
const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      // console.log(entry);
      if (entry.isIntersecting) {
        entry.target.classList.add('animations-show-item');
        observer.unobserve(entry.target);
      } else {
        entry.target.classList.remove('animations-show-item');
      }
    });
  });
  
  const hiddenElements = document.querySelectorAll('.animations-hidden-item');
  hiddenElements.forEach((el) => observer.observe(el));

jQuery('document').ready(function(){

  var owl = jQuery('.our-projects .owl-carousel');
    owl.owlCarousel({
    margin:25,
    stagePadding: 5,
    nav: false,
    autoplay : true,
    lazyLoad: true,
    autoplayTimeout: 3000,
    loop: true,
    dots:false,
    navText : ['<span class="dashicons dashicons-arrow-left-alt2"></span>','<span class="dashicons dashicons-arrow-right-alt2"></span> '],
    responsive: {
      0: {
        items: 1,
        nav: false,
      },
      600: {
        items: 2,
        nav: false,
      },
      1000: {
        items: 3
      },
      1200: {
        items: 4
      }
    },
    autoplayHoverPause : true,
    mouseDrag: true
  });
});
