// assign-site-groups

$(".select2").select2();

vodafoneAPI(dna.GET, api + 'SysOfferingGroups', function(r) {
    if(r.currentTarget['readyState'] == 4 && r.currentTarget['status'] == 200) {
        var data = JSON.parse(r.currentTarget.response || r.target.responseText);

        for (var i in data) {
            if (data.hasOwnProperty(i)) {
                var option = '<option  value='+ data[i].offeringGroupId +'>'+ data[i].offeringGroupName +'</option>';
                offeringGroupDescription.insertAdjacentHTML('beforeEnd', option);
            }
        }
    }
});


//datable slect all function

//exampleTableSearch
            function updateDataTableSelectAllCtrl(table) {
                var $table = table.table().node();
                var $chkbox_all = $('tbody input[type="checkbox"]', $table);
                var $chkbox_checked = $('tbody input[type="checkbox"]:checked', $table);
                var chkbox_select_all = $('thead input[name="select_all"]', $table).get(0);
                // If none of the checkboxes are checked
                if ($chkbox_checked.length === 0) {
                    chkbox_select_all.checked = false;
                    if ('indeterminate' in chkbox_select_all) {
                        chkbox_select_all.indeterminate = false;
                    }

                    // If all of the checkboxes are checked
                } else if ($chkbox_checked.length === $chkbox_all.length) {
                    chkbox_select_all.checked = true;
                    if ('indeterminate' in chkbox_select_all) {
                        chkbox_select_all.indeterminate = false;
                    }

                    // If some of the checkboxes are checked
                } else {
                    chkbox_select_all.checked = true;
                    if ('indeterminate' in chkbox_select_all) {
                        chkbox_select_all.indeterminate = true;
                    }
                }
            }


//populate DataTable


vodafoneAPI(dna.GET, api + 'SysSites', function(r) {
  // console.log(r);

  if(r.currentTarget['readyState'] == 4 && r.currentTarget['status'] == 200) {
        console.log('Success 200');
         data = JSON.parse(r.currentTarget.response || r.target.responseText),
        dataSet = document.getElementById('dataSet');
        console.log(data);

        for (var i in data) {
          if(data.hasOwnProperty(i)) {
            console.log(data[i]);
            var row = '<tr>' +
                '<td></td>' +
            '<td>'+ data[i].siteId +'</td>' +
            '<td>'+ data[i].siteCode +'</td>' +
            '<td>'+ data[i].siteDescription +'</td>' +
            '<td>'+ data[i].location +'</td>' +

            '</tr>';
            // console.log(rowNew);
          }
          dataSet.insertAdjacentHTML('beforeEnd', row);
        }


        var titles_selected = [];
               // Array holding selected row IDs
               var rows_selected = [];
               // var title_selected =[];
               var table = $('#assignSiteGroupsTbl').DataTable({
                 paging: true,
                 lengthChange: true,
                 searching: true,
                 ordering: true,
                 info: true,
                 autoWidth: false,
                 'columnDefs': [

                     {
                         'targets': 0,
                         'searchable': false,
                         'orderable': false,
                         'width': '1%',
                         'className': 'dt-body-center',
                         'render': function (data, type, full, meta) {
                             return '<input type="checkbox">';
                         }
                     }, {
                           "targets": 1,
                           "visible": false,
                           "searchable": false
                       }
],
                   'order': [[1, 'asc']],
                   'rowCallback': function (row, data, dataIndex) {
                       // Get row ID
                       var rowId = data[1];

                       // If row ID is in the list of selected row IDs
                       if ($.inArray(rowId, rows_selected) !== -1) {
                           $(row).find('input[type="checkbox"]').prop('checked', true);
                           $(row).addClass('selected');
                       }
                     }
               });


               // Handle click on checkbox
                                             $('#assignSiteGroupsTbl tbody').on('click', 'input[type="checkbox"]', function (e) {
                                                 var $row = $(this).closest('tr');

                                                 // Get row data
                                                 var data = table.row($row).data();

                                                 // Get row ID
                                                 var rowId = data[1];
                                                 var titleid = data[3];
                                                 // Determine whether row ID is in the list of selected row IDs
                                                 var index = $.inArray(rowId, rows_selected);

                                                 // If checkbox is checked and row ID is not in list of selected row IDs
                                                 if (this.checked && index === -1) {
                                                     rows_selected.push(rowId);
                                                     titles_selected.push(titleid);

                                                     // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
                                                 } else if (!this.checked && index !== -1) {
                                                     rows_selected.splice(index, 1);
                                                     titles_selected.splice(index, 1);
                                                 }

                                                 if (this.checked) {
                                                     $row.addClass('selected');
                                                 } else {
                                                     $row.removeClass('selected');
                                                 }

                                                 // Update state of "Select all" control
                                                 updateDataTableSelectAllCtrl(table);

                                                 // Prevent click event from propagating to parent
                                                 e.stopPropagation();
                                             });

                                             // Handle click on table cells with checkboxes
                                             $('#assignSiteGroupsTbl').on('click', 'tbody td, thead th:first-child', function (e) {
                                                 $(this).parent().find('input[type="checkbox"]').trigger('click');
                                             });

                                             // Handle click on "Select all" control
                                             $('thead input[name="select_all"]', table.table().container()).on('click', function (e) {
                                                 if (this.checked) {
                                                     $('#assignSiteGroupsTbl tbody input[type="checkbox"]:not(:checked)').trigger('click');
                                                 } else {
                                                     $('#assignSiteGroupsTbl tbody input[type="checkbox"]:checked').trigger('click');
                                                 }

                                                 // Prevent click event from propagating to parent
                                                 e.stopPropagation();
                                             });

                                             // Handle table draw event
                                             table.on('draw', function () {
                                                 // Update state of "Select all" control
                                                 updateDataTableSelectAllCtrl(table);
                                             });




        $(document).on('click', 'button[type="submit"]', function(e) {
          e.preventDefault();

            var offeringselected = document.getElementById('offeringGroupDescription');
              var offeringselectedValue = document.getElementById('offeringGroupDescription').value;
            var offeringselectedText = offeringselected.options[offeringselected.selectedIndex].text;
            console.log('text is '+offeringselectedText);
                      $("#siteOfferings ul").html('');
                        var selected = "" + rows_selected + "";
                        var title = "" + titles_selected + "";
                        var array = title.split(",");
                        $.each(array, function (i) {
                            $("#siteOfferings ul").append("<li>" + array[i] + "</li>");

                        });

                document.getElementById('offeringid').value = offeringselectedValue;
                document.getElementById('offeringGroupName').innerHTML = offeringselectedText;

            $('#assignSiteGroupModal').modal('show');
          });

// assign site groups to offering
       $('#ssignSiteGroupbtn').on('click', function (e) {
                var sitesselected = "" + rows_selected + "";
                var offeringselected = document.getElementById('offeringid').value;
                var offeringName =   document.getElementById('offeringGroupName').innerHTML;

                var parameters = [];

                var sitesselectedarr = sitesselected.split(',');
                for(i=0; i < sitesselectedarr.length; i++){

                  parameters.push({

                    "siteId": sitesselectedarr[i],
                    "offeringGroupId": offeringselected,
                     "modBy": "aba"
                   });

                }


//send params to middleware - SysOfferingGroupSites
var params = JSON.stringify(parameters);
vodafoneAPI(dna.POST, api + 'SysOfferingGroupSites', function(r) {
                  console.log(r);

                  console.log(params);

                  if (r.currentTarget['readyState'] == 4 && r.currentTarget['status'] == 200) {
                    $(".select2").select2('val','');
                    $('#assignSiteGroupModal').modal('hide');
                    document.getElementById('addSiteGroupForm').reset();

                    dna.notification('The Offering  has been assigned  successfully.', 'success');
                    console.log(JSON.parse(r.currentTarget.response || r.target.responseText));
                  }

                  if (r.currentTarget['readyState'] == 4 && r.currentTarget['status'] == 404) {
                    dna.notification('Oops! Something went wrong. (404)', 'danger');
                  }

                  if (r.currentTarget['readyState'] == 4 && r.currentTarget['status'] == 422) {
                    dna.notification('Oops! Something went wrong. (422)', 'danger');
                  }

                  if (r.currentTarget['readyState'] == 4 && r.currentTarget['status'] == 500) {
                    dna.notification('Oops! Something went wrong, please contact system administrator. (500)', 'warning');
                  }

                }, params);


       });
  }

  if(r.currentTarget['readyState'] == 4 && r.currentTarget['status'] == 404) {
  //     //   console.log(r.currentTarget['statusText']);
        console.log('Not Found 404');

        console.log(r);
  }

  if(r.currentTarget['readyState'] == 4 && r.currentTarget['status'] == 422) {
  //     //   console.log(r.currentTarget['statusText']);
        console.log('Unprocessable Entity 422');
        var data = JSON.parse(r.currentTarget.response || r.target.responseText);

        console.log(data);
  }

});
