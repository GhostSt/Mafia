/**
 * Created by Victor Diditskiy on 19.03.17.
 */

function PrototypeHandler(logger) {
    this.logger = logger;
    this.template_prototype = '';
    this.prototypeSelector = '';
    this.targetSelector = '';
    this.itemsSelector = '';

    this.setPrototypeSelector = function (selector) {
        this.prototypeSelector = selector
    };

    this.setTargetSelector = function (selector) {
        this.targetSelector = selector
    };

    this.setItemsSelector = function (selector) {
        this.itemsSelector = selector
    };

    this.process = function () {
        if (this.validate()) {
            this.setPrototype();
            this.parse();
            this.addDomElement();
        }
    };

    this.validate = function () {
        var result = true;
        if (!$(this.targetSelector).length) {
            this.logger.warning('Invalid target selector');

            result = false;
        }

        if (!$(this.itemsSelector).length) {
            this.logger.warning('Invalid items selector');

            result = false;
        }

        if (!$(this.prototypeSelector).length) {
            this.logger.warning('Invalid prototype selector');

            result = false;
        }

        return result;
    };

    this.setPrototype = function () {
        this.template_prototype = $(this.prototypeSelector).data('prototype');
    };

    this.parse = function () {
        var length = $(this.prototypeSelector).data('length');

        this.template_prototype = this.template_prototype.replace(/__name__/g, length);
    }

    this.addDomElement = function () {
        $(this.targetSelector).before(this.template_prototype);
        $(this.itemsSelector + ' select').select2();

        var length = $(this.prototypeSelector).data('length');
        $(this.prototypeSelector).data('length', length + 1);
    }
}

function Log() {
    this.warning = function (message) {
        console.warn(message);
    }
}

$(function () {
    $(document).on({
        click: function () {
            var log = new Log();
            var PropotypeHandler = new PrototypeHandler(log);

            PropotypeHandler.setPrototypeSelector('div.players div.panel-body');
            PropotypeHandler.setItemsSelector('div.players div.panel-body > div.row');
            PropotypeHandler.setTargetSelector('div.players div.panel-body > div.button-add');
            PropotypeHandler.process();
        }
    }, 'div.players div.panel-body > div.row.button-add span');

    $(document).on({
        click: function () {
            var log = new Log();
            var PropotypeHandler = new PrototypeHandler(log);

            PropotypeHandler.setPrototypeSelector('div.days div.panel-body');
            PropotypeHandler.setItemsSelector('div.days div.panel-body > div');
            PropotypeHandler.setTargetSelector('div.days div.panel-body > div.button-add');
            PropotypeHandler.process();
        }
    }, 'div.days div.panel-body > div.row.button-add span');
});
