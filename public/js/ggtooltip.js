
!function ($) {

    "use strict"; // jshint ;_;

    var ggTooltip = function (element, options) {
        this.init('ggtooltip', element, options)
    }

    ggTooltip.prototype = {
        constructor: ggTooltip,

        init: function (type, element, options) {
            var eventIn, eventOut;

            this.type = type;
            this.$element = $(element);
            this.options = this.getOptions(options);
            this.enabled = true;

            if (this.options.trigger == 'click') {
                this.$element.on('click.' + this.type, this.options.selector, $.proxy(this.toggle, this));
            } else if (this.options.trigger != 'manual') {
                eventIn = this.options.trigger == 'hover' ? 'mouseenter' : 'focus';
                eventOut = this.options.trigger == 'hover' ? 'mouseleave' : 'blur';
                this.$element.on(eventIn + '.' + this.type, this.options.selector, $.proxy(this.enter, this))
                this.$element.on(eventOut + '.' + this.type, this.options.selector, $.proxy(this.leave, this));;
            }

            this.options.selector ?
              (this._options = $.extend({}, this.options, { trigger: 'manual', selector: '' })) :
              this.fixTitle();
        },

        getOptions: function (options) {
            options = $.extend({}, $.fn[this.type].defaults, options, this.$element.data());

            if (options.delay && typeof options.delay == 'number') {
                options.delay = {
                    show: options.delay
                , hide: options.delay
                };
            }

            return options;
        },

        enter: function (e) {
            var self = $(e.currentTarget)[this.type](this._options).data(this.type);

            if (!self.options.delay || !self.options.delay.show) return self.show();

            clearTimeout(this.timeout);
            self.hoverState = 'in';
            this.timeout = setTimeout(function () {
                if (self.hoverState == 'in') self.show();
            }, self.options.delay.show);
        },

        leave: function (e) {
            var self = $(e.currentTarget)[this.type](this._options).data(this.type);

            if (this.timeout) clearTimeout(this.timeout);
            if (!self.options.delay || !self.options.delay.hide) return self.hide();

            self.hoverState = 'out';
            this.timeout = setTimeout(function () {
                if (self.hoverState == 'out') self.hide();
            }, self.options.delay.hide);
        },

        show: function () {
            var $tip
              , inside
              , pos
              , actualWidth
              , actualHeight
              , placement
              , tp;

            if (this.hasContent() && this.enabled) {
                $tip = this.tip();
                this.setContent();

                if (this.options.animation) {
                    $tip.addClass('fade');
                }

                placement = typeof this.options.placement == 'function' ?
                  this.options.placement.call(this, $tip[0], this.$element[0]) :
                    this.options.placement;

                inside = /in/.test(placement);

                $tip
                  .detach()
                  .css({ top: 0, left: 0, display: 'block' })
                  .insertAfter(this.$element);

                pos = this.getPosition(inside);

                actualWidth = $tip[0].offsetWidth;
                actualHeight = $tip[0].offsetHeight;

                switch (inside ? placement.split(' ')[1] : placement) {
                    case 'bottom':
                        tp = { top: pos.top + pos.height, left: pos.left + pos.width / 2 - actualWidth / 2 }
                        break;
                    case 'top':
                        tp = { top: pos.top - actualHeight, left: pos.left + pos.width / 2 - actualWidth / 2 }
                        break;
                    case 'left':
                        tp = { top: pos.top + pos.height / 2 - actualHeight / 2, left: pos.left - actualWidth }
                        break;
                    case 'right':
                        tp = { top: pos.top + pos.height / 2 - actualHeight / 2, left: pos.left + pos.width }
                        break;
                }

                $tip
                  .offset(tp)
                  .addClass(placement)
                  .addClass('in');
            }
        },

        setContent: function () {
            var $tip = this.tip(), title = this.getTitle();

            $tip.find('.ggtooltip-inner').css({ 'background': this.options.backcolor, 'color': this.options.textcolor, 'border-color' : this.options.bordercolor  });
            $tip.find('.ggtooltip-arrow').css('border-' + this.options.placement + '-color', this.options.backcolor);
            $tip.find('.ggtooltip-arrow-shadow').css('border-' + this.options.placement + '-color', this.options.bordercolor);
            $tip.find('.ggtooltip-inner')[this.options.html ? 'html' : 'text'](title);
            $tip.removeClass('fade in top bottom left right');
        },

        hide: function () {
            var that = this
              , $tip = this.tip();

            $tip.removeClass('in');

            function removeWithAnimation() {
                var timeout = setTimeout(function () {
                    $tip.off($.support.transition.end).detach();
                }, 500);

                $tip.one($.support.transition.end, function () {
                    clearTimeout(timeout);
                    $tip.detach();
                });
            }

            $.support.transition && this.$tip.hasClass('fade') ?
              removeWithAnimation() :
              $tip.detach();

            return this;
        },

        fixTitle: function () {
            var $e = this.$element;
            if ($e.attr('title') || typeof ($e.attr('data-original-title')) != 'string') {
                $e.attr('data-original-title', $e.attr('title') || '').removeAttr('title');
            }
        },

        hasContent: function () {
            return this.getTitle();
        },

        getPosition: function (inside) {
            return $.extend({}, (inside ? { top: 0, left: 0 } : this.$element.offset()), {
                width: this.$element[0].offsetWidth
            , height: this.$element[0].offsetHeight
            });
        },

        getTitle: function () {
            var title
              , $e = this.$element
              , o = this.options;

            title = $e.attr('data-original-title')
              || (typeof o.title == 'function' ? o.title.call($e[0]) : o.title);

            return title;
        },

        tip: function () {
            return this.$tip = this.$tip || $(this.options.template);
        },

        validate: function () {
            if (!this.$element[0].parentNode) {
                this.hide();
                this.$element = null;
                this.options = null;
            }
        },

        enable: function () {
            this.enabled = true;
        },

        disable: function () {
            this.enabled = false;
        },

        toggleEnabled: function () {
            this.enabled = !this.enabled;
        },

        toggle: function (e) {
            var self = $(e.currentTarget)[this.type](this._options).data(this.type);
            self[self.tip().hasClass('in') ? 'hide' : 'show']();
        },

        destroy: function () {
            this.hide().$element.off('.' + this.type).removeData(this.type);
        }
    }

    var old = $.fn.ggtooltip;

    $.fn.ggtooltip = function (option) {
        return this.each(function () {
            var $this = $(this)
              , data = $this.data('ggtooltip')
              , options = typeof option == 'object' && option
            if (!data) $this.data('ggtooltip', (data = new ggTooltip(this, options)))
            if (typeof option == 'string') data[option]()
        });
    }

    $.fn.ggtooltip.Constructor = ggTooltip;

    $.fn.ggtooltip.defaults = {
        animation: true,
        placement: 'top',
        selector: false,
        template: '<div class="ggtooltip"><div class="ggtooltip-arrow-shadow"></div><div class="ggtooltip-arrow"></div><div class="ggtooltip-inner"></div></div>',
        trigger: 'hover',
        title: '',
        delay: 0,
        html: false,
        backcolor: '#00ffcc',
        textcolor: '#000000',
        bordercolor: '#0066cc'
    }


    $.fn.ggtooltip.noConflict = function () {
        $.fn.ggtooltip = old;
        return this;
    }

}(window.jQuery);