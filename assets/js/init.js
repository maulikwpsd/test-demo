// Add Margin same as header height

function setHeaderSpacing() {
  var $header = jQuery(".site-header");
  var $main = jQuery(".site-main");
  if (!$header.length || !$main.length) return;
  var headerHeight = $header.outerHeight();
  $main.css("margin-top", headerHeight + "px");
}
jQuery(document).ready(setHeaderSpacing);
jQuery(window).on("load", setHeaderSpacing);
jQuery(window).on("resize orientationchange", setHeaderSpacing);
if (window.ResizeObserver) {
  const header = document.querySelector(".site-header");
  if (header) {
    const observer = new ResizeObserver(setHeaderSpacing);
    observer.observe(header);
  }
}

jQuery(document).ready(function () {
  if (!jQuery(".projects-slider").length) {
    return;
  }

  if (typeof window.tns !== "function") {
    console.warn("Tiny Slider (tns) is not loaded.");
    return;
  }

  let slider;

  try {
    slider = tns({
      container: ".projects-slider",
      gutter: 15,
      mouseDrag: true,
      slideBy: 1,
      autoplay: false,
      autoplayButtonOutput: false,
      controls: false,
      nav: false,
      loop: true,
      items: 1,
      responsive: {
        768: {
          items: 2,
          gutter: 30,
        },
        1599: {
          items: 2,
          gutter: 30,
        }
      }
    });
  } catch (error) {
    console.error("Failed to initialize projects slider:", error);
    return;
  }

  jQuery(".custom-button .prev-btn").on("click", function () {
    slider.goTo("prev");
  });

  jQuery(".custom-button .next-btn").on("click", function () {
    slider.goTo("next");
  });
});



if (jQuery(".trust-factor-logo-sliders").length) {
  if (typeof window.tns !== "function") {
    console.warn("Tiny Slider (tns) is not loaded.");
  } else {
    try {
      tns({
        container: ".trust-factor-logo-sliders",
        center: true,
        autoWidth: true,
        items: 1,
        gutter: 140,
        slideBy: 1,
        nav: false,
        controls: false,
        mouseDrag: true,
        autoplay: false,
        autoplayButtonOutput: false,
        responsive: {
          1: {
            gutter: 60,
          },
          350: {
            gutter: 60,
          },
          992: {
            gutter: 90,
          },
        },
      });
    } catch (error) {
      console.error("Failed to initialize trust factor logo slider:", error);
    }
  }
}
