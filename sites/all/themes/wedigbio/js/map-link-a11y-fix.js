(function ($, Drupal) {
  Drupal.behaviors.wedigbioMapLinkA11yFix = {
    attach: function (context) {
      $(".location-locations-display", context).each(function () {
        var $display = $(this);
        var $article = $display.closest("article");
        var $link = $display.find(".location.map-link a").first();

        if (!$link.length) {
          return;
        }

        var label = "Google Maps";
        var eventTitle = $.trim($article.find("header h2 a").first().text());

        if (eventTitle) {
          label += " for " + eventTitle;
        }

        $link.attr({
          "aria-label": label,
          "title": label
        });
      });
    }
  };
})(jQuery, Drupal);