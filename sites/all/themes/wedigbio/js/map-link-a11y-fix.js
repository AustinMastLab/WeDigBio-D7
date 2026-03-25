(function ($, Drupal) {
  Drupal.behaviors.wedigbioMapLinkA11yFix = {
    attach: function (context) {
      $(".location-locations-display", context).each(function () {
        var $display = $(this);
        var $link = $display.find(".location.map-link a").first();

        if (!$link.length) {
          return;
        }

        var locationName = $.trim($display.find(".fn").first().text());
        var label = "Google Maps";

        if (locationName) {
          label += " for " + locationName;
        }

        $link.attr({
          "aria-label": label,
          "title": label
        });
      });
    }
  };
})(jQuery, Drupal);