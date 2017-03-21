/**
 * Created by Victor Diditskiy on 19.03.17.
 */

function AbstractHandler() {
    this.logger = new Log();
    this.template_prototype = '';
    this.prototypeSelector = '';
    this.targetSelector = '';
    this.itemsSelector = '';
    this.max_voting_members = 10;
    this.max_players = 11;

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

        if (!$(this.prototypeSelector).length) {
            this.logger.warning('Invalid prototype selector');

            result = false;
        }

        if (!$(this.itemsSelector).length) {
            this.logger.warning('Invalid items selector');

            result = false;
        }

        if (!$(this.targetSelector).length) {
            this.logger.warning('Invalid target selector');

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

    this.remove = function (selector) {
        if (!$(selector).length) {
            this.logger.warning('Invalid remove selector');

            return false;
        }

        $(selector).remove();
    }
}

function PlayerHandler() {
    this.__proto__ = new AbstractHandler();

    this.addDomElement = function () {
        if ($(this.itemsSelector).not('div.row.button-add').length >= this.max_players) {
            alert($(this.prototypeSelector).data('length-warning'));

            return 0;
        }

        $(this.targetSelector).before(this.template_prototype);
        $(this.itemsSelector + ' select').select2();

        var length = $(this.prototypeSelector).data('length');
        $(this.prototypeSelector).data('length', length + 1);
    };
}

function DayHandler() {
    this.__proto__ = new AbstractHandler();
}

function VotingHandler() {
    this.__proto__ = new AbstractHandler();

    this.setPrototype = function () {
        this.template_prototype = $(this.prototypeSelector).data('voting-prototype');
    };

    this.parse = function () {
        var length = this.itemsSelector.data('length');
        var row_number = this.targetSelector.data('index');

        this.template_prototype = this.template_prototype.replace(/\[days\]\[0\]/g, '[days]['+ row_number +']');
        this.template_prototype = this.template_prototype.replace(/__name__/g, length);
    }

    this.addDomElement = function () {
        if ($(this.itemsSelector).children().length >= this.max_voting_members) {
            alert($(this.targetSelector).data('length-warning'));

            return 0;
        }
        var div = document.createElement('div');
        div.setAttribute('id', 'voting-prototype');
        div.setAttribute('class', 'hide');
        div.innerHTML = '<div id="voting-prototype hide">' + this.template_prototype + '</div>';
        document.body.appendChild(div);

        var voting_remove = $('#voting-prototype div.remove').html();
        var voting_position = $('#voting-prototype div.position').html();
        var voting_vote = $('#voting-prototype div.vote').html();

        $(this.targetSelector)
            .find('div.head.buttons div.vote-remove-buttons > div.row')
            .append(voting_remove);

        $(this.targetSelector)
            .find('div.voting div.position div.vote-box')
            .before(voting_position);

        $(this.targetSelector)
            .find('div.voting div.position select')
            .select2();

        $(this.targetSelector)
            .find('div.voting div.vote')
            .append(voting_vote);

        $(this.targetSelector)
            .find('div.voting div.vote select')
            .select2();

        var length = this.itemsSelector.data('length');
        this.itemsSelector.data('length', length + 1);
        div.remove();
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
            var playerHandler = new PlayerHandler();

            playerHandler.setPrototypeSelector('div.players div.panel-body');
            playerHandler.setItemsSelector('div.players div.panel-body > div.row');
            playerHandler.setTargetSelector('div.players div.panel-body > div.button-add');
            playerHandler.process();
        }
    }, 'div.players div.panel-body > div.row.button-add span');

    $(document).on({
        click: function () {
            var playerHandler = new PlayerHandler();
            var selector = $(this)
                .parent()
                .parent();

            playerHandler.remove(selector);

        }
    }, 'div.players div.panel-body > div.row span.remove');

    $(document).on({
        click: function () {
            var dayHandler = new DayHandler();

            dayHandler.setPrototypeSelector('div.days div.panel-body');
            dayHandler.setItemsSelector('div.days div.panel-body > div');
            dayHandler.setTargetSelector('div.days div.panel-body > div.button-add');
            dayHandler.process();
        }
    }, 'div.days div.panel-body > div.row.button-add span');

    $(document).on({
        click: function () {
//            alert(1);

            var dayHandler = new DayHandler();
            var selector = $(this)
                .parent()
                .parent()
                .parent()
                .parent();

            dayHandler.remove(selector);
        }
    }, 'div.days div.panel-body > div.row div.head.title span.remove');

    $(document).on({
        click: function () {
            var votingPrototypeHandler = new VotingHandler();

            rowElement = $(this)
                .parent()
                .parent()
                .parent()
                .parent()
                .parent();

            items = rowElement
                .find('div.voting div.row.vote');

            votingPrototypeHandler.setPrototypeSelector(rowElement.parent());
            votingPrototypeHandler.setItemsSelector(items);
            votingPrototypeHandler.setTargetSelector(rowElement);
            votingPrototypeHandler.process();
        }
    }, 'div.days div.voting div.vote-box span');

    $(document).on({
        click: function () {
            var votingHandler = new VotingHandler();
            var index = $(this).data('index');
            var removeSelector = $(this)
                .parent();

            var row_selector = $(this)
                .parent()
                .parent()
                .parent()
                .parent()
                .parent();

            var positionSelector = row_selector
                .find('div.position div.index-'+ index);

            var voteSelector = row_selector
                .find('div.vote div.index-'+ index);

            votingHandler.remove(removeSelector);
            votingHandler.remove(positionSelector);
            votingHandler.remove(voteSelector);
        }
    }, 'div.days div.head.buttons > div.vote-remove-buttons span.remove');
});
