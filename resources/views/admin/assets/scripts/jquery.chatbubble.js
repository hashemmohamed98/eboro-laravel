;(function ( $, window, document, undefined ) {

    var chatBubble = "chatBubble",

        defaults = {
            typingSpeed: 40, // speed in words per minute
            delay: 1000 // delay between adding messages
        };

    function Plugin( element, options )
    {
        this.element = element;
        this.options = $.extend( {}, defaults, options) ;
        this._defaults = defaults;
        this._name = chatBubble;

        this.init();
    }

    Plugin.prototype = {

        init: function() {
            var self = this;

            $(self.element).addClass('cb__list');

            var messages = this.options.messages;
            var Master = this.options.Master;
            var ID = this.options.ID;
            var time = this.options.time;
            var count = messages.length;
            var typingSpeed = this.options.typingSpeed || this.defaults.typingSpeed;
            var delay = this.options.delay || this.defaults.delay;

            var i = 0;
            function addMessage() {
                self.addMessage(self.element, messages[i],ID[i],time[i],Master, typingSpeed).then(function() {
                    window.setTimeout(function() {
                        i++;
                        if (i < count) addMessage();
                    },delay);
                });
            }

            addMessage();
        },
        destroy: function () {
            $.Widget.prototype.destroy.call(this);
        },
        addMessage: function(el, message, ID,time,Master, typingSpeed) {

            var $listItem = $('<li></li>');
            var $bubble = $('<div class="bubble typing">...</div>');
            if(ID == Master)
                $bubble = $('<div class="bubble text text-l typing a">...</div>');
            else
                $bubble = $('<div class="bubble text text-r typing b">...</div>');
            var words = message.split(' ').length;
            var speed = (words / typingSpeed) * 6000;

            if (speed < 1000) speed = 1000;
            if (speed > 10000) speed = 10000;

            $listItem.html($bubble);
            $(el).animate({scrollTop: 1000000});
            $(el).append($listItem);

            return new Promise(function(resolve, reject) {
                window.setTimeout(function() {

                    $bubble.html(' <p>'+message+'</p><p><small>'+time+'</small></p>').removeClass('typing');
                    resolve(true);
                },speed);

            });
        }
    };

    $.fn[chatBubble] = function ( options )
    {
        return this.each(function () {
            if (!$.data(this, "plugin_" + chatBubble))
            {
                $.data(this, "plugin_" + chatBubble, new Plugin( this, options ));
            }
        });
    };

})( jQuery, window, document );
