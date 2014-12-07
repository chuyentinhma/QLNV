/*
 * This file contains the common scripts, example: datepicker, select2, texteditor ... 
 * Please do not using DOM id here
 */
$(function() {
    //wysiwyg
    tinymce.init({
        selector: ".editor",
        menubar: false,
        statusbar: false,
        toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright"
    });
    /* width:resolve option for makes select2 same width with select tag*/
    $(".select2").each(function() {
        options = {
            width: 'resolve'
        };
        if ($(this).attr('data-no-search'))
            options['minimumResultsForSearch'] = -1; // Hide the seach box
        $(this).select2(options);
    });

    /* Auto hide error text and color if user typed */
    $('.control-group.error').on('keydown', 'input', function() {
        $(this).closest('.control-group').removeClass('error').find('.help-inline').fadeOut(300);
    });

    /* Date picket input */
    $('.datepicker').each(function() {
        $_this = $(this);
        var options = {};
        if ($_this.data('min-date')) {
            options.minDate = new Date($_this.data('min-date'));
        }
        options = jQuery.extend(AppConfig.defaultDatepickerOptions, options);
        $('.datepicker').datepicker(options);
    });


    $(document).on('change', '.submit-on-change', function() {
        $(this).closest('form').trigger('submit');
    });

    /* Check forms with at-least-one checkboxes */
    $('form').submit(function() {
        $_thisForm = $(this);
        var valid = true;
        $_atLeastCheckboxes = $_thisForm.find('.at-least-one');
        if ($_atLeastCheckboxes.length !== 0) {
            valid = false;
            $_atLeastCheckboxes.each(function() {
                if ($(this).is(':checked') === true) {
                    valid = true;
                }
            });
        }
        if (!valid) {
            bootbox.alert('Vui lòng chọn ít nhất 1 một mục');
        }
        return valid;
    });

    /* Handler checkall checkboxes */
    $(document).on('change', '.checkall', function() {
        $_this = $(this);
        $_checkboxesContainer = $($_this.data('checkall-for'));
        $_checkboxesContainer.find('input[type="checkbox"]').each(function() {
            $(this).prop('checked', $_this.is(':checked'));
        });
    });

    /* Export excel buttons */
    $(document).on('click', '.btn-export-excel', function() {
        $_thisButton = $(this);
        if ($_thisButton.data('table')) {
            ExcellentExport.excel(this, $_thisButton.data('table'), 'Sheet1');
        }
    });

    /* Toggle loading indicator */
    $(document).ajaxStart(function() {
        Helper.togglePageLoadingIndicator(true);
    });
    $(document).ajaxComplete(function() {
        Helper.togglePageLoadingIndicator(false);
    });
});

