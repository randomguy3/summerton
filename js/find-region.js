var find_region = (function ($, Drupal, window, document, undefined) {
    return (function (el) {
        var classes = $(el).closest('.region').attr('class').split(' ');
        for (var i = 0; i < classes.length; i++) {
            if (classes[i].substr(0,7) == 'region-') {
                return classes[i].substr(7);
            }
        }
        return 'unknown location';
    });
})(jQuery, Drupal, this, this.document);
// vim:sw=4:sts=4:et
