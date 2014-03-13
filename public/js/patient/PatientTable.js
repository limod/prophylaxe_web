$(document).ready(function() {
    var pt = new PatientTable();

//    $('#btnTest').tooltip({'placement':'right'});
    $('#testi a').tooltip(
            {
                'html': true
            });

});

function PatientTable() {


    var initialize = function() {
        $("#patient_edit_table").dataTable({
            "bProcessing": true,
            "sAjaxSource": '/patient/getpatients/format/json',
            "aoColumns": [
                {"mData": 0},
                {"mData": 1},
                {"mData": 2},
                {"mData": 3},
                {"mData": 4},
                {"mData": null,
                    "mRender": function(data) {
//                        var button = '<a><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button></a>';

                        return data;
                    },
                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
//                        var a = $(nTd).find("a");
                        var tooltip = $('<a class="top" title="" data-placement="top" data-toggle="tooltip" href="#">Fehler anzeigen</a>');
                        var tooltip = $('<button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top">Fehler anzeigen</button>');

                        var row = $(nTd);
                        var errors = oData[6];
//                        alert(errors);
                        if (errors.length > 0) {
//                            row.css('background-color', '#D43F3A');
                            var list=  $('<ul>');
                            for (var i = 0; i < errors.length; i++) {

                                var listEntry = $('<li>');
                                listEntry.text(errors[i]);
                                list.append(listEntry);
//                                html += '<li>';
//                                html += errors[i];
//                                html += '</li>';
                            }
//                            html.append(list);
//                            html += '</ul>';
//                            tooltip.data('original-title', list.prop('outerHTML')); // data-original-title="Tooltip <b>on</b> top";

                            tooltip.tooltip(
                                    {
                                        'html': true,
                                        'title': list.prop('outerHTML'),
                                        'trigger': 'hover'
                                    });
                            row.append(tooltip);
                        }
                        //a.attr("href", "/patient/edit/" + oData[0]);
                    }},
                {// Spalte bearbeiten
                    "mData": null,
                    "sClass": "patient_edit_table_column",
                    "mRender": function(data) {
                        var button = '<a><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button></a>';
                        return button;
                    },
                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                        var a = $(nTd).find("a");

                        a.attr("href", "/patient/edit/" + oData[0]);
                    }
                },
                {// Spalte Notfallkoffer
                    "mData": null,
                    "sClass": "patient_edit_table_column",
                    "mRender": function(data) {
                        var button = '<a><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button></a>';
                        return button;
                    },
                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                        var a = $(nTd).find("a");
                        a.attr("href", "/patient/edit-maxim/" + oData[0]);
                    }

                },
                {// Spalte Sprueche
                    "mData": null,
                    "sClass": "patient_edit_table_column",
                    "mRender": function(data) {
                        var button = '<a><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button></a>';
                        return button;
                    },
                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                        var a = $(nTd).find("a");
                        a.attr("href", "/patient/edit-maxim/" + oData[0]);
                    }
                },
                {// Spalte Ablenkung
                    "mData": null,
                    "sClass": "patient_edit_table_column",
                    "mRender": function(data) {
                        var button = '<a><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span></button></a>';
                        return button;
                    },
                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                        var a = $(nTd).find("a");
                        a.attr("href", "/patient/edit-distraction/" + oData[0]);
                    }
                }
            ]

        });

    };


    this.editButtonClick = function() {
        alert($(this).data("id"));

    }

    initialize();

}