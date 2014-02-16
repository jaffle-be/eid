if(typeof app === 'undefined')
{
    app = {};
}

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