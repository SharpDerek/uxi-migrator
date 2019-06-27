// collapse javascript

jQuery(document).ready(function(jQuery) {
  //activate accordion for gallery page
  jQuery('.accordion').find('.accordion-toggle').click(function(){

    //Expand or collapse this panel
    jQuery(this).next().slideToggle('fast');

    //Hide the other panels
    jQuery(".accordion-content").not(jQuery(this).next()).slideUp('fast');
    });

});