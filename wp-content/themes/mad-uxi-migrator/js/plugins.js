// Avoid `console` errors in browsers that lack a console.
(function() {
  var method;
  var noop = function () {};
  var methods = [
    'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
    'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
    'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
    'timeStamp', 'trace', 'warn'
  ];
  var length = methods.length;
  var console = (window.console = window.console || {});

  while (length--) {
    method = methods[length];

    // Only stub undefined methods.
    if (!console[method]) {
        console[method] = noop;
    }
  }
}());

// A fix for iPhone viewport scale bug
// http://www.blog.highub.com/mobile-2/a-fix-for-iphone-viewport-scale-bug/
// Rewritten version
// By @mathias, @cheeaun and @jdalton

(function(doc) {

  var addEvent = 'addEventListener',
      type = 'gesturestart',
      qsa = 'querySelectorAll',
      scales = [1, 1],
      meta = qsa in doc ? doc[qsa]('meta[name=viewport]') : [];

  function fix() {
    meta.content = 'width=device-width,minimum-scale=' + scales[0] + ',maximum-scale=' + scales[1];
    doc.removeEventListener(type, fix, true);
  }

  if ((meta = meta[meta.length - 1]) && addEvent in doc) {
    fix();
    scales = [0.25, 1.6];
    doc[addEvent](type, fix, true);
  }

}(document));

/*  =========================================================================================
  place any jQuery/helper plugins in here, instead of separate, slower script files.
========================================================================================== */

// dropdowns for primary navigation
(function($) {
  var dropdownToggle = $('.dropdown-toggle');
  var dropdown = $('.dropdown');
  dropdownToggle.click(function() {
    $(this).parent('.dropdown').toggleClass('open').siblings().removeClass('open');
    return false;
  });
  $('html').click(function() {
    dropdown.removeClass('open');
  });
})( jQuery );

// mobile nav button to show and hide navigation
(function($) {
  var nav = $('.mobile .main-nav-wrap');
  nav.hide();
  $('.mobile .header .btn-navbar').click(function () {
    nav.slideToggle(250);
  });
})( jQuery );

// arlerts
(function($) {
  $('.alert .close').click(function () {
    $(this).parent().fadeOut(250);
  });
})( jQuery );
(function($) {
  $('.alert.fade-in').hide().fadeIn(250);
})( jQuery );
