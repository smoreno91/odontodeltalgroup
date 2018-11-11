var fc_type = $('select.fc_type'), number, count, addbutton = $('#add-field');

function selectchange(type) {
    type.change(function () {
        number = $(this)[0].name.split('[');
        number = number[1].split(']');
        number = number[0];

        if ($(this)[0].value == 'select') {
            $("#fc_fields-" + number + "-placeholder").remove();
            $(this).parents('.row').after('<div class="row clearfix " id="fc_fields-' + number + '-values"> <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label"> <label> Values: </label> </div> <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7"> <div class="form-group"> <div class="form-line"> <div class="form-line"> <input type="text" class="form-control" name="fc_fields[' + number + '][values]" placeholder="Example: a | b | c"> </div></div> </div> </div> </div>');
        }

        if ($(this)[0].value == 'input') {
            $("#fc_fields-" + number + "-values").remove();
            $(this).parents('.row').after('<div class="row clearfix " id="fc_fields-' + number + '-placeholder"> <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label"> <label> Placeholder: </label> </div> <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7"> <div class="form-group"> <div class="form-line"> <div class="form-line"> <input type="text" class="form-control" name="fc_fields[' + number + '][placeholder]" placeholder="Example: a | b | c"> </div></div> </div> </div> </div>');
        }

        if ($(this)[0].value == 'checkbox') {
            $("#fc_fields-" + number + "-placeholder").remove();
            $("#fc_fields-" + number + "-values").remove();
        }

    });
}

function deletePanel(b) {
    b.click(function () {
        $(this).parents('.panel').remove();
    });
}

function changeLabel(input) {
    input.change(function () {
        number = $(this)[0].name.split('[');
        number = number[1].split(']');
        number = number[0];
        $('#fc_fields-' + number + '-label')[0].innerText = $(this)[0].value;
    })
}

addbutton.click(function () {
    count = $('select.fc_type:last')[0];
    if (count) {
        count = count.name.split('[');
        count = count[1].split(']');
        count = parseInt(count[0]) + 1;
    } else {
        count = 0;
    }

    $('#accordion_1').append('<div class="panel panel-primary"><div class="panel-heading" role="tab" id="heading-' + count + '"><h4 class="panel-title"><a id="fc_fields-' + count + '-label" role="button" data-toggle="collapse" data-parent="#accordion_1" href="#field-' + count + '" aria-expanded="false" aria-controls="field-' + count + '">Field #' + (count + 1) + '</a></h4><ul class="header-dropdown m-r--5"><li class="dropdown"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="material-icons">more_vert</i></a><ul class="dropdown-menu pull-right"><li><a href="javascript:void(0);" class="delete waves-effect waves-block">Delete</a></li></ul></li></ul></div><div id="field-' + count + '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading" aria-expanded="true"><div class="panel-body"><div class="row clearfix " id=""><div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label"><label>Label: </label></div><div class="col-lg-10 col-md-10 col-sm-8 col-xs-7"><div class="form-group"><div class="form-line"><div class="form-line"><input type="text" class="input-label form-control" name="fc_fields[' + count + '][label]" placeholder=""></div></div></div></div></div><div class="row clearfix " id=""> <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label"> <label>Description: 		</label> </div> <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7"> <div class="form-group"> <div class="form-line"> <div class="form-line"> <input type="text" class="form-control " name="fc_fields[' + count + '][description]" placeholder=""> </div>			</div> </div> </div> </div><div class="row clearfix " id=""><div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label"><label>Name: </label></div><div class="col-lg-10 col-md-10 col-sm-8 col-xs-7"><div class="form-group"><div class="form-line"><div class="form-line"><input type="text" class="form-control " name="fc_fields[' + count + '][name]" placeholder=""></div></div></div></div></div><div class="row clearfix " id=""><div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label"><label>Type: </label></div><div class="col-lg-10 col-md-10 col-sm-8 col-xs-7"><div class="form-group"><div class="form-line"><select class="form-control show-tick fc_type" name="fc_fields[' + count + '][type]"><option value="input">input</option><option value="select">select</option><option value="checkbox">checkbox</option></select></div></div></div></div><div class="row clearfix " id="fc_fields-' + count + '-placeholder"><div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label"><label> Placeholder: </label></div><div class="col-lg-10 col-md-10 col-sm-8 col-xs-7"><div class="form-group"><div class="form-line"><div class="form-line"><input type="text" class="form-control" name="fc_fields[' + count + '][placeholder]" placeholder=""></div></div></div></div></div></div></div></div>');
    $.AdminBSB.select.activate();
    fc_type_last = $('select.fc_type:last');
    selectchange(fc_type_last);
    deletePanel($('a.delete:last'));
    changeLabel($('input.input-label:last'));
});

selectchange(fc_type);
changeLabel($('input.input-label'));
deletePanel($('a.delete'))


