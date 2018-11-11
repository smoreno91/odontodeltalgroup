jQuery(function ($) {
    var fieldsInitial = {
        init: function () {
            this.tags_input.init();
            this.checkbox();
        },
        checkbox: function () {
            var objCheckbox = $(document).find('input[type="checkbox"]:not(.notchange)');
            objCheckbox.each(function () {
                $(this).change(function (e) {
                    var checked = $(this).is(":checked");
                    if (checked === true) {
                        $(this).val('yes');
                        var name = $(this).attr('name');
                        $('input[name="' + name + '_checkbox' + '"]').val('yes');
                    } else {
                        $(this).val('no');
                        var name = $(this).attr('name');
                        $('input[name="' + name + '_checkbox' + '"]').val('no');
                    }
                });
            });
        },
        tags_input: {
            init: function () {
                var $this = this;
                var elt   = $("input.tagsinput");
                elt.each(function () {
                    var tags = $(this).attr('data-tags');
                    if ((tags == '' || tags == null)) return false;
                    try {
                        tags = atob(tags);
                        console.log('tags data: ', tags);
                        tags = JSON.parse(tags);
                        $this.init_tag_input($(this), tags);
                    } catch (err) {
                        return false;
                    }
                });
            },
            init_tag_input: function (objInput, objTags) {
                var $this = this;
                var tags  = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('text'),
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: objTags
                });
                tags.initialize();
                objInput.tagsinput({
                    itemValue: 'value',
                    itemText: 'text',
                    typeaheadjs: {
                        name: 'cities',
                        displayKey: 'text',
                        source: tags.ttAdapter()
                    }
                });
                // Parsing old value
                var old_value = objInput.attr('data-value');
                
                if (old_value == '' || old_value == null) return false;
                
                try {
                    old_value = old_value.split(',');
                    for (key in old_value) {
                        var value_tags = fieldsInitial.get_object_from_value_elements(old_value[key], objTags);
                        
                        objInput.tagsinput('add', value_tags);
                    }
                    
                } catch (err) {
                    console.log('Somethings wrong with old value processing!');
                }
            }
        },
        // Helpers
        get_object_from_value_elements: function (value, object) {
            
            for (key in object) {
                if (object[key].value == value) return object[key];
            }
        }
    };
    fieldsInitial.init();
});