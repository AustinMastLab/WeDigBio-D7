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

        var title = $.trim($article.find("header h2 a").first().text());
        var eventId = $article.attr("id") ? $article.attr("id").replace("node-", "") : "";
        var label = "Google Maps";

        if (title) {
          label += " for " + title;
        }

        if (eventId) {
          label += ", event " + eventId;
        }

        $link.attr({
          "aria-label": label,
          "title": label
        });
      });
    }
  };
})(jQuery, Drupal);