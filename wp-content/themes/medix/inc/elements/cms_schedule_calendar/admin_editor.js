/**
 * Created by Admin on 7/18/2017.
 */
var is_medix_calendar_inited = false;
function medix_calendar_init_trigger() {
    jQuery('textarea[name="medix_calendar_save_data"]').hide();
    var params_member_fields = jQuery('div[data-vc-shortcode-param-name="medix_calendar_members"]');
    medix_calendar_on_remove_params_handlel();
    MedixCalendar.init();
    MedixCalendar.hide();
    jQuery('.medix_calendar_button span').click(function () {
        MedixCalendar.init();
    });
    params_member_fields.find('.vc_param_group-add_content').on('click',function () {
        MedixCalendar.reloadMembers(this);
    });
    params_member_fields.on('click','.column_clone',function () {
        MedixCalendar.duplicateMember(this);
        medix_calendar_on_remove_params_handlel();
    });
    params_member_fields.on('change','input',function () {
        MedixCalendar.hide();
    });
    params_member_fields.on('click','.vc_link-build',function () {
        MedixCalendar.hide();
    });
    function medix_calendar_on_remove_params_handlel() {
        params_member_fields.find('.vc_param').unbind('remove');
        params_member_fields.find('.vc_param').on('remove',function () {
            MedixCalendar.sliceMember(this);
        });
    }
}

var MedixCalendar = {
    element:{
        select: "medix_calendar_select_",
        table:"medix_calendar_table_",
        save_data:"medix_calendar_save_data",
        editor:"medix_calendar_editor_"
    },
    html:{
        table:{
            open:"<table border='1'>",
            close:"</table>"
        },
        thread:{
            open:"<thread>",
            close:"</thread>"
        },
        tbody:{
            open:"<tbody>",
            close:"</tbody>"
        },
        tr:{
            open:"<tr>",
            close:"</tr>"
        },
        th:{
            open:"<th>",
            close:"</th>"
        },
        td:{
            open:"<td>",
            close:"</td>"
        }
    },
    data : {
        'members': [],
        'table':{
            'cols':['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'],
            'rows':['8:00 - 9:00','9:00 - 10:00','10:00 - 11:00','11:00 - 12:00','12:00 - 13:00','13:00 - 14:00','14:00 - 15:00','15:00 - 16:00','16:00 - 17:00','17:00 - 18:00']
        },
        'calendar_map':[]
    },
    hide:function () {jQuery('#'+MedixCalendar.element.editor).hide();
    },
    show:function () {
        jQuery('#'+MedixCalendar.element.editor).show();
    },
    init : function () {
        var _try_load_data = false;
        try{
            var _saved_data = jQuery('textarea[name="'+MedixCalendar.element.save_data+'"]').val();
            _saved_data = JSON.parse(_saved_data);
            MedixCalendar.data = _saved_data;
            _try_load_data = true;
        }
        catch(err)
        {
            _try_load_data = false;
        }
        if(!_try_load_data)
        {
            MedixCalendar.data = {
                'members': [],
                'table':{
                    'cols':['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'],
                    'rows':['8:00 - 9:00','9:00 - 10:00','10:00 - 11:00','11:00 - 12:00','12:00 - 13:00','13:00 - 14:00','14:00 - 15:00','15:00 - 16:00','16:00 - 17:00','17:00 - 18:00']
                },
                'calendar_map':[]
            };
            for(var _row = 0;_row <MedixCalendar.data.table.rows.length;_row++)
            {
                MedixCalendar.data.calendar_map.push(new Array(MedixCalendar.data.table.cols.length));
            }
        }
        MedixCalendar.reloadMembers();
        MedixCalendar.createTable();
        if(_try_load_data)
        {
            MedixCalendar.refillData();
            MedixCalendar.refillStyle();
        }
        MedixCalendar.show();
        return this;
    },
    getIndexOf:function (obj) {
        var param_obj = jQuery(obj)[0];
        var target_index = -1;
        jQuery(obj).parent().find('.vc_param').each(function (index,item) {
             if(param_obj == this)
                 target_index = index;
        });
        return target_index;
    },
    save :function () {
        var _save_value = JSON.stringify(MedixCalendar.data);
        jQuery('textarea[name="'+MedixCalendar.element.save_data+'"]').val(_save_value);
        return this;
    },
    duplicateMember:function (obj) {
        var index = MedixCalendar.getIndexOf(jQuery(obj).parents('li'));
        for (var _row=0;_row<MedixCalendar.data.calendar_map.length;_row++)
            for(var _col=0;_col<MedixCalendar.data.calendar_map[_row].length;_col++)
            {
                if(intval(MedixCalendar.data.calendar_map[_row][_col]) > index)
                    MedixCalendar.data.calendar_map[_row][_col] = intval(MedixCalendar.data.calendar_map[_row][_col]) + 1;
            }
        MedixCalendar.reloadMembers();
        return this;
    },
    sliceMember:function (obj) {
        var index = MedixCalendar.getIndexOf(obj);
        for (var _row=0;_row<MedixCalendar.data.calendar_map.length;_row++)
            for(var _col=0;_col<MedixCalendar.data.calendar_map[_row].length;_col++)
            {
                if(intval(MedixCalendar.data.calendar_map[_row][_col]) == index)
                    MedixCalendar.data.calendar_map[_row][_col]= null;
                if(intval(MedixCalendar.data.calendar_map[_row][_col]) > index)
                    MedixCalendar.data.calendar_map[_row][_col] = intval(MedixCalendar.data.calendar_map[_row][_col])-1;
            }
        MedixCalendar.reloadMembers();
        return this;
    },
    reloadMembers : function () {
        MedixCalendar.hide();
        var medix_calendar_members_names = jQuery('input[name="medix_calendar_members_name"]');
        var medix_calendar_members_clinics = jQuery('input[name="medix_calendar_members_clinic"]');
        var medix_calendar_members_urls = jQuery('input[name="medix_calendar_members_url"]');
        var new_member_data = [];
        var new_select_input = '';
        medix_calendar_members_names.each(function (index,item) {
            var _new_member = {};
            _new_member.name = jQuery(medix_calendar_members_names[index]).val();
            _new_member.clinic = jQuery(medix_calendar_members_clinics[index]).val();
            _new_member.url = jQuery(medix_calendar_members_urls[index]).parent().find('.url-label').text();
            new_member_data.push(_new_member);
            new_select_input += "<option value='"+index+"'>"+_new_member.name+"</option>";
        });
        jQuery('select[id="'+MedixCalendar.element.select+'"]').html(new_select_input);
        MedixCalendar.data.members = new_member_data;
        MedixCalendar.save();
        return this;
    },
    setCalendarCell:function (col,row,member) {
        var target = jQuery('div[id="'+MedixCalendar.element.table+'"] td[data-index-col="'+col+'"][data-index-row="'+row+'"]');
        var _current_member = target.attr('data-attach-member');
        var new_member = 'member_'+member;
        if(_current_member == new_member)
        {
            target.empty();
            target.removeAttr('data-attach-member');
            target.removeClass('medix-has-target');
            target.removeClass('medix-selected');
            return this;
        }
        var _element_html = '';
        _element_html += "<a href='#' >"+MedixCalendar.data.members[member].name+"</a>";
        _element_html += "<p>"+MedixCalendar.data.members[member].clinic+"</p>";
        target.attr('data-attach-member', new_member);
        target.addClass('medix-selected');
        target.html(_element_html);
        return this;
    },
    eventHandle : function () {
        var _element = jQuery('div[id="'+MedixCalendar.element.table+'"] td');
        _element.unbind('click');
        _element.click(function () {
            if(MedixCalendar.data.members.length<1)
                return;
            if(jQuery(this).attr('data-index-col') == null)
                return;
            var _current_member = jQuery('select[id="'+MedixCalendar.element.select+'"]').val();
            var _this_col = jQuery(this).attr('data-index-col');
            var _this_row = jQuery(this).attr('data-index-row');
            MedixCalendar.setCalendarCell(_this_col,_this_row,_current_member);
            MedixCalendar.data.calendar_map[_this_row][_this_col] = (MedixCalendar.data.calendar_map[_this_row][_this_col] != _current_member)?_current_member : null;
            MedixCalendar.save();
        });
        jQuery('select[id="'+MedixCalendar.element.select+'"]').on('change',function () {
            MedixCalendar.refillStyle();
        });
        return this;
    },
    refillData : function () {
        for(var _row=0;_row<MedixCalendar.data.table.rows.length;_row++)
            for(var _col=0;_col<MedixCalendar.data.table.cols.length;_col++)
            {
                var _current_member = MedixCalendar.data.calendar_map[_row][_col];
                if(_current_member == null)
                    continue;
                if(MedixCalendar.data.members[_current_member] == null)
                {
                    MedixCalendar.data.calendar_map[_row][_col] = null;
                    continue;
                }
                MedixCalendar.setCalendarCell(_col,_row,_current_member);
            }
        MedixCalendar.refillStyle();
        return this;
    },
    refillStyle : function () {
        var table =  jQuery('div[id="'+MedixCalendar.element.table+'"]');
        table.find('td').removeClass('medix-has-target');
        table.find('td').removeClass('medix-selected');
        var _current_member = 'member_' + jQuery('select[id="'+MedixCalendar.element.select+'"]').val();
        table.find('td[data-attach-member*="member_"]').addClass('medix-has-target');
        table.find('td[data-attach-member*="'+_current_member+'"]').removeClass('medix-has-target');
        table.find('td[data-attach-member*="'+_current_member+'"]').addClass('medix-selected');
    },
    createTable : function () {
        var _html = MedixCalendar.html;
        var _table_html = _html.table.open;
        _table_html += _html.thread.open;
        _table_html += _html.tr.open;
        _table_html += _html.th.open + _html.th.close;
        MedixCalendar.data.table.cols.forEach(function (item,index) {
            _table_html += _html.th.open+item+_html.th.close;
        });
        _table_html += _html.tr.close;
        _table_html += _html.thread.close;
        _table_html += _html.tbody.open;
        for(var _row=0;_row<MedixCalendar.data.table.rows.length ;_row ++)
        {
            _table_html += _html.tr.open;
            _table_html += _html.th.open+MedixCalendar.data.table.rows[_row]+_html.th.close;
            for(var _col=0;_col<MedixCalendar.data.table.cols.length;_col++)
            {
                _table_html += _html.td.open.replace('<td',"<td data-index-col='"+_col+"' data-index-row='"+_row+"'")+_html.td.close;
            }
            _table_html +=_html.tr.close;
        }
        _table_html +=_html.tbody.close;
        _table_html += _html.table.close;
        jQuery('div[id="'+MedixCalendar.element.table+'"]').html(_table_html);
        MedixCalendar.eventHandle();
        return this;
    }
};