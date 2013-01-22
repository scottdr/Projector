(function ($) {

    function isstr(obj) {
        return Object.prototype.toString.call(obj) === '[object String]';
    };

    $.definePlugin = function (name, definition, defaults) {

        var instanceKey = name + '_instance';
        
        $.fn[name] = function (arga, argb) {

            var method = isstr(arga) ? arga : null;
            var options = isstr(arga) ? argb : arga;
            var isget = options === undefined;

            function getInstance(element) {
                return element.data(instanceKey) || (function () {
                    var instance = new definition(element[0], method ? defaults : $.extend({}, defaults, options));
                    element.data(instanceKey, instance);
                    return instance;
                })();
            };

            if (method && isget) {
                var instance = getInstance(this.eq(0), options);
                return instance[method]();
            };

            return this.each(function () {

                var el = $(this), instance = getInstance(el);
                if (method) return instance[method].apply(instance, [options]);

            });

        };

        $.fn[name].defaults = defaults;

    };

})(jQuery);

(function ($) {

    function getset(getter, setter) {
        return function () {
            if (arguments.length) return setter.apply(this, arguments);
            return getter.apply(this);
        }
    };

    function Point(x, y) {
        this.x = x;
        this.y = y;
    };

    Point.prototype.minus = function (other) {
        return new Point(this.x - other.x, this.y - other.y);
    };

    Point.fromTouches = function (touches) {
        return new Point(
            touches[0].pageX,
            touches[0].pageY
        );
    };

    function getViewport(root, selector) {
        return selector ? root.closest(selector) : root.parent();
    };

    function Plugin(element, options) {
        this._element = element;
        this._options = options;
        this._activePosition = 0;

        var plugin = this;

        var root = $(element);
        var viewport = getViewport(root);

        var wantsHorizontal = options.orientation === 'horizontal';
        var hasHorizontal, startTime, startPosition;
        var istouch = 'ontouchstart' in document, pointerCapture, abortClick;
        var hasStandardEvents = 'addEventListener' in document;
        var activePage;

        function start(position, e) {
            abortClick = false;
            startPosition = position;
            startTime = +new Date;
            activePage = plugin.position();
            root.addClass('dragging');
        };

        function finish(position, e) {

            root.removeClass('dragging');

            if (hasHorizontal) {

                var now = +new Date;
                var delta = now - startTime;
                
                if (options.tolerance >= delta) {

                    var vp = viewport.width() * .05;

                    var delta = position.minus(startPosition);
                    var dir = position.x > startPosition.x;

                    if (Math.abs(delta.x) > vp) {
                        plugin.position(activePage + (dir ? -1 : 1))
                    } else {
                        plugin.position(activePage)
                    };

                } else {

                    var vp = viewport.width() * .3;

                    var delta = position.minus(startPosition);
                    var dir = position.x > startPosition.x;

                    if (Math.abs(delta.x) > vp) {
                        plugin.position(activePage + (dir ? -1 : 1))
                    } else {
                        plugin.position(activePage)
                    };
                }

                e.stopPropagation();
            }

            hasHorizontal = null;

        };

        function move(position, e) {

            var delta = startPosition.minus(position);

            // if we've not yet determined if this touch should be captured, work this out now
            if (hasHorizontal == null)
                abortClick = hasHorizontal = !wantsHorizontal ^ Math.abs(delta.x) > Math.abs(delta.y);

            // ok so this is certainly our move event, update the ui
            if (hasHorizontal) {

                var children = root.children();
                var morethanafeeling = delta.x;
                var dir = position.x > startPosition.x;

                if ((activePage === 0 && dir) || (activePage === children.length - 1 && !dir))
                    morethanafeeling *= options.squishFactor;

                var baseOffset = root.width() * plugin._activePosition;

                root.css('transform', 'translate3d(' + -~~(baseOffset + morethanafeeling) + 'px,0,0)');

                e.preventDefault();
            }
        };

        root.on('touchstart touchmove touchend', function (e) {

            e = e.originalEvent;

            if (e.type === 'touchstart' && (e.touches.length - e.changedTouches.length) === 0) {
                start(Point.fromTouches(e.touches), e);
            } else if (e.type === 'touchend' && e.touches.length === 0) {
                finish(Point.fromTouches(e.changedTouches), e);
            } else if (e.type === 'touchmove') {
                move(Point.fromTouches(e.touches), e);
            }

        });

        // pointer events don't prevent clicks occuring on lift, we cancel any clicks (in tunneling phase) if we've captured a drag
        hasStandardEvents && root[0].addEventListener('click', function (e) {
            abortClick && e.stopPropagation();
        }, true);

        root.on('dragstart MSPointerDown MSPointerMove MSPointerUp', function (e) {

            e = e.originalEvent;

            if (e.type === 'MSPointerDown') {
                pointerCapture = true;
                root[0].msSetPointerCapture(e.pointerId);
                start(new Point(e.pageX, e.pageY), e);
            } else if (e.type === 'MSPointerUp') {
                pointerCapture = false;
                finish(new Point(e.pageX, e.pageY), e);
            } else if (e.type === 'MSPointerMove' && pointerCapture) {
                move(new Point(e.pageX, e.pageY), e);
            } else if (e.type === 'dragstart') {
                return false;
            }

        });

    };

    Plugin.prototype.position = getset(		
        function () { return this._page || (this._page = 0); },
        function (page) {

            var root = $(this._element);
            var children = root.children(),
			p = this._page;

            // clamp the page position so it isn't out of range
            page = this._page = Math.min(Math.max(page, 0), children.length - 1);
			
			if(page != p){
				root.trigger('snap');
			};

            var offset = this._activePosition = page / children.length;

            root.css('transform', 'translate3d(' + -(offset * 100) + '%, 0, 0)');

        }
    );

    //var cout = $('<textarea>').css({ position: 'absolute', 'z-index': 999, bottom: 0, left: 0, width: '100%', height: '200px', color: '#000' }).prependTo('body');

    //console.log = function () {
    //    cout.val(cout.val() + '\n' + [].join.call(arguments, ','));
    //};

    $.definePlugin('snapview', Plugin, {
        orientation: 'horizontal',
        tolerance: 450,
        squishFactor: .4
    });


})(jQuery);