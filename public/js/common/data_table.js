/*
 * Copyright © 2017 NyCard S.A.R.L, All Rights Reserved
 *
 * [Nymcard Admin Panel]
 * $id: data_table.js
 * Created:        @tassaad    May 24, 2017 | 11:55:03 AM
 * Last Update:    @tassaad    Jyne 2, 2017 | 11:55:03 AM
 */
/*object Datatable*/

class dataTable {
    constructor() {
        this.drawTable = function (url, columns_data, account_id, unordered_columns, dom_object, page_length) {
            if(typeof page_length == 'undefined') {
                page_length = 10;
            }
            if(typeof ajax_options == null) {
                dom_object
                ajax_options = null;
            }
            var columns_array = [];
            var column_defs = [];
            /*parse the columns to meet columns Datatable pattern*/
            if($.isArray(parseDataColumns(dom_object))) {
                $.each(parseDataColumns(dom_object), function (key, val) {
                    columns_array.push({"data": val});
                });
            }
            if($.isArray(unordered_columns)) {
                $.each(unordered_columns, function (column_id, val) {
                    column_defs.push(val);
                });
            }
            this.table = $("#" + dom_object).DataTable({
                pageLength: page_length,
                "processing": true,
                "serverSide": true,
                "tabIndex": 1,
                "deferRender": true,
                "destroy": true,
                "pagingType": "simple",
                "searching": true,
                "aaSorting": [],
                "search": {
                    "smart": true
                },
//             "language": {
//            	"sZeroRecords":  "searching....",
//             },
                "ajax": {
                    "url": url,
                    error: function (error, thrown, response) {
                        window.sharedFunctions.redirectWithError(error);
                    },
                    "dataSrc": function (jsonData) {
                        return(jsonData.data);
                    },
                    "data": function (d) {
                        d.data_param = account_id;
                    }
                },
                "columns": columns_array,
                columnDefs: [
                    {
                        targets: column_defs,
                        orderable: false
                    },
                ],
                responsive: true,
            });
        }
    }

}

/*
 *  Bind the columns needed by the Datatable
 *  by taking the columns from the Table Dom created  in the Blade template
 * @param {type} dom_object
 * @returns {Array|parseDataColumns.columnsFields}
 */
function parseDataColumns(dom_object) {
    var columnsFields = [];
    $('#' + dom_object).find('thead > tr > th').each(function (key, val) {
        columnsFields.push(key);
    });
    return columnsFields;
}