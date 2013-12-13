$(document).ready(function() {
    var pt = new PatientTable();

});

function PatientTable() {

    var _editButton = $('<button>Edit</button>');
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
                {"mData": 5},
                {
                    "mData": null,
                    "mRender": function(data) {
                        var button = '<a><button type="button" class="btn btn-primary">Bearbeiten</button></a>';
                        return button;
                    },
                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                        var a = $(nTd).find("a");
                  
//                        a.data("id", oData[0]);
                        a.attr("href", "/patient/edit/" + oData[0]);
                        
//                        button.bind('click', function() {
//                            
//                            alert($(this).data("id"));
//                        });
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