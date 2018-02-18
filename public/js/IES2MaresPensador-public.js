(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
    $(function() {
        $.fn.commentCards = function () {


            return this.each(function () {

                var $this = $(this),
                    $cards = $this.find('.card'),
                    $current = $cards.filter('.card--current'),
                    $next;

                $cards.on('click', function () {
                    if (!$current.is(this)) {
                        $cards.removeClass('card--current card--out card--next');
                        $current.addClass('card--out');
                        $current = $(this).addClass('card--current');
                        $next = $current.next();
                        $next = $next.length ? $next : $cards.first();
                        $next.addClass('card--next');
                    }
                });

                if (!$current.length) {
                    $current = $cards.last();
                    $cards.first().trigger('click');
                }

                $this.addClass('cards--active');

            })

        };

        $('.cards').commentCards();

        $('.widget_form_respuesta').on('submit', function (e) {
            e.preventDefault();

            var $form = $(this);

            $.post($form.attr('action'), $form.serialize(), function (data) {
                $('.message-respuesta').append(data.message);
                $('.message-respuesta').css('visibility', 'visible');
            }, 'json');
        });


    });


})( jQuery );
