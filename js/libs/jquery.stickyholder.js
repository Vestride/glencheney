/**
 * Stickyholder by Glen Cheney
 * http://glencheney.com
 */
;(function($) {
    $.fn.stickyholder = function() {
        var $collection = this,
        methods = {
            keydown : function($label) {
                if (this.value === '') {
                    $label.removeClass('has-text');
                } else {
                    $label.addClass('has-text');
                }
            },

            blur : function($label) {
                if (this.value === '') {
                    $label.removeClass('has-text');
                }
            },

            reset : function($label) {
                $label.removeClass('has-text');
            }
        };
        return $collection.each(function(index, self){
            var $this = $(this),
                text = $this.attr('data-placeholder'),
                $label = $('<label for="' + this.id + '" class="sticky-placeholder">' + text + '</label>');


            $this.after($label);

            if (index == 0) {
                $(this.form).on('reset', function() {
                    $collection.each(function(i, el){
                        methods.reset($(el).next());
                    });
                });
            }

            $this.keydown(function(evt){
                // We use set timeout to make sure that this is called after the native code.
                setTimeout(function() {
                    methods.keydown.call(self, $label);
                }, 0);

            });

            $this.blur(function(){
                methods.blur.call(self, $label);
            });
        });
    };
})(jQuery);