if(typeof app === 'undefined')
{
    app = {};
}

/**
 * CONFIRMATION MODAL
 */

(function($, app)
{
    'use strict';

    var Confirmation = function () {
        this.$modal = $("#confirmation-modal");
        this.callback = false;
        this.events();
    };

    Confirmation.prototype = {
        events: function () {
            var that = this;
            this.$modal.on('click', '.modal-footer .btn-primary', function () {
                if (typeof that.callback === 'function') {
                    that.callback();
                }
                that.$modal.modal('hide');
            });
        },
        open: function (callback) {
            if (typeof callback === 'function') {
                this.callback = callback;
            }
            this.$modal.modal('show');
        },
        close: function () {
            this.$modal.modal('hide');
        }
    };

    var confirm = new Confirmation();

    app.confirmation = confirm;


})(window.jQuery, window.app);


(function($, app)
{
    'use strict';

    var localhost = /local\.eid/;

    if(localhost.test(window.location.href))
    {
        app.environment = 'local.eid';
    }
    else
    {
        app.environment = 'eid.jaffle.be';
    }

})(window.jQuery, window.app);


/**
 * LANGUAGE HELPERS
 */

(function($, app){

    'use strict';

    var Language = function()
    {
        var href = window.location.href,
            pattern = new RegExp(app.environment + '\/fr');

        if(pattern.test(href)){
            this.language = 'fr';
        }
        else
        {
            this.language = 'nl';
        }
    }

    Language.prototype = {
        get : function()
        {
            return this.language;
        }
    }

    app.language = new Language();

})(window.jQuery, window.app);