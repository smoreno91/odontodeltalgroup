/**
 * Created by Quan on 4/5/2017.
 */
jQuery(function ($) {
    $('.optgroup').multiSelect({selectableOptgroup: true, cssClass: 'select_box'});
    $('.optgroup-hidden').multiSelect({selectableOptgroup: true, cssClass: 'hidden select_box'});
});