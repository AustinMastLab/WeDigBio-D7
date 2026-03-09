(function ($, Drupal) {
  Drupal.behaviors.wedigbioTeamCarouselA11yFix = {
    attach: function (context) {
      var $controls = $(
        '.jcarousel-prev, .jcarousel-next, .jcarousel-prev-horizontal, .jcarousel-next-horizontal',
        context
      );

      $controls.each(function () {
        var $el = $(this);
        var isPrev = $el.hasClass('jcarousel-prev') || $el.hasClass('jcarousel-prev-horizontal');
        var label = isPrev ? 'Previous team members' : 'Next team members';

        // Replace javascript: URL
        if (($el.attr('href') || '').indexOf('javascript:void(0)') === 0) {
          $el.attr('href', '#');
        }

        // Add accessible name
        $el.attr({
          'role': 'button',
          'aria-label': label,
          'title': label
        });

        // If visually icon-only, add sr-only text once
        if ($.trim($el.text()) === '') {
          $el.append('<span class="sr-only">' + label + '</span>');
        }

        // Avoid jumping to top when href="#"
        $el.off('click.wedigbioA11y').on('click.wedigbioA11y', function (e) {
          e.preventDefault();
        });
      });
    }
  };
})(jQuery, Drupal);