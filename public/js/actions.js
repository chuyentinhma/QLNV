$(document).ready(function () {
    $('#sidebar .navigation li.openable > a').on('click', function () {
        var $root = $(this).parent();
        if ($root.hasClass('open')) {
            $root.removeClass('open');
        } else {
            $root.addClass('open');
        }
        return false;
    });

    $('a.c_screen').on('click', function () {
        var $wrapper = $('#wrapper');
        if ($wrapper.hasClass('screen_wide')) {
            $wrapper.removeClass('screen_wide');
        } else {
            $wrapper.addClass('screen_wide');
        }
        return false;
    });

    /* Toggle sidebar */
    $('a.c_layout').on('click', function () {
        var $wrapper = $('#wrapper');
        if ($wrapper.hasClass('sidebar_off')) {
            $wrapper.removeClass('sidebar_off');
        } else {
            $wrapper.addClass('sidebar_off');
        }
        return false;
    });

    /* Toggle block content */
    $('.block').on('click', '.block_toggle', function () {
        var _$this = $(this);
        var $arrow = $(this).children('i');
        var $parent = $(this).closest('.block');
        $parent.children('.content').slideToggle();
        if (_$this.hasClass('open')) {
            $arrow.addClass('i-arrow-down-3');
            $arrow.removeClass('i-arrow-up-3');
            _$this.removeClass('open');
        } else {
            $arrow.addClass('i-arrow-up-3');
            $arrow.removeClass('i-arrow-down-3');
            _$this.addClass('open');
        }
        return false;
    });

})