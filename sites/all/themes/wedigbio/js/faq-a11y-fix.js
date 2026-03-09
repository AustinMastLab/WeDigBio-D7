(function ($, Drupal) {
  function cleanFaqAria(context) {
    var $faq = $('#faqfield_field_faq_900', context);

    if (!$faq.length) {
      return;
    }

    // Remove problematic container role.
    $faq.removeAttr('role');

    // Remove nested link + tab ARIA from headers.
    $faq.find('h3[role="tab"], h3.ui-accordion-header').each(function () {
      var $h3 = $(this);
      var $anchor = $h3.find('a[href^="#faq-"]');

      if ($anchor.length) {
        $anchor.replaceWith(document.createTextNode($anchor.text()));
      }

      $h3.removeAttr('role aria-selected aria-expanded aria-controls tabindex');
    });

    // Remove panel ARIA that is invalid once role is gone.
    $faq.find('[role="tabpanel"], .ui-accordion-content').each(function () {
      $(this).removeAttr('role aria-hidden aria-labelledby aria-expanded');
    });
  }

  Drupal.behaviors.wedigbioFaqA11yFix = {
    attach: function (context) {
      cleanFaqAria(context);

      // jQuery UI may re-apply attrs; clean again shortly after.
      setTimeout(function () {
        cleanFaqAria(document);
      }, 250);
    }
  };
})(jQuery, Drupal);