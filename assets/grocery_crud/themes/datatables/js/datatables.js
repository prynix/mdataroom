var default_per_page = typeof default_per_page !== 'undefined' ? default_per_page : 25;
var oTable = null;
var oTableArray = [];
var oTableMapping = [];

function supports_html5_storage()
{
	try {
		JSON.parse("{}");
		return 'localStorage' in window && window['localStorage'] !== null;
	} catch (e) {
		return false;
	}
}

var use_storage = supports_html5_storage();

var aButtons = [];
var mColumns = [];

$(document).ready(function() {
        //$('table.groceryCrudTable').dataTable({"bDestroy":true,"sScrollX": "100%","sScrollXInner": "100%","bScrollCollapse": true});
        /*$('table.groceryCrudTable').dataTable( {
            "sScrollX": "100%",
            "bScrollCollapse": true
        } );*/
        $('table.groceryCrudTable').on('draw.dt', function() {
            var iTotalClickCount = 0;
            var iTotalImpressionCount = 0;
            var iTotalRequestCount = 0;
            var iTotalCTR = 0;
            var idcpm=0, idcpc=0, iascpm=0, iascpc=0, idb=0, iasc=0, itc=0;
            //'Display CPM', 'Display CPC',  'Ad Server CPM', 'Ad Server CPC', 'Display Budget', 'Ad Server Cost', 'Total Cost'
            var arr = ['Display_Budget', 'Ad_Server_Cost', 'Total_Cost'];//'Display_CPM', 'Display_CPC',  'Ad_Server_CPM', 'Ad_Server_CPC',
            var tr = [0,0,0];
            for (index = 0; index < arr.length; ++index) {
                $('.'+arr[index]).each(function(i){
                        if (isNaN(+($(this).text().replace(',','')))){
                            //
                        } else {
                            tr[index] += +($(this).text().replace(',',''));
                        }
                });
                $('#'+arr[index]).html(''+tr[index].toFixed(2));
            }
            $('.click').each(function(index){
                    iTotalClickCount += +($(this).text().replace(',',''));;
            });
            $('.impression').each(function(index){
                    iTotalImpressionCount += +($(this).text().replace(',',''));;
            });
            $('.request').each(function(index){
                    iTotalRequestCount += +($(this).text().replace(',',''));;
            });
            if(iTotalImpressionCount == 0) {
                        iTotalCTR = 0;
            } else {
                iTotalCTR = iTotalClickCount / iTotalImpressionCount;
            }
            $('#click').html(''+iTotalClickCount);
            $('#impression').html(''+iTotalImpressionCount);
            $('#request').html(''+iTotalRequestCount);
            $('#CTR').html(''+iTotalCTR.toFixed(4) + "%");
        });

	$('table.groceryCrudTable thead tr th').each(function(index){
		if(!$(this).hasClass('actions'))
		{
			mColumns[index] = index;
		}
	});

	if(!unset_export)
	{
		aButtons.push(    {
	         "sExtends":    "xls",
	         "sButtonText": export_text,
	         "mColumns": mColumns
	     });
	}

	if(!unset_print)
	{
		aButtons.push({
	         "sExtends":    "print",
	         "sButtonText": print_text,
	         "mColumns": mColumns,
                 "bShowAll": true,
                 "sMessage": "Generated by Adserver"
	     });
	}

	//For mutliplegrids disable bStateSave as it is causing many problems
	if ($('.groceryCrudTable').length > 1) {
		use_storage = false;
	}

	$('.groceryCrudTable').each(function(index){
		if (typeof oTableArray[index] !== 'undefined') {
			return false;
		}

		oTableMapping[$(this).attr('id')] = index;

		oTableArray[index] = loadDataTable(this);
	});

	$(".groceryCrudTable tfoot input").keyup( function () {

		chosen_table = datatables_get_chosen_table($(this).closest('.groceryCrudTable'));

		chosen_table.fnFilter( this.value, chosen_table.find("tfoot input").index(this) );

		if(use_storage)
		{
			var search_values_array = [];

			chosen_table.find("tfoot tr th").each(function(index,value){
				search_values_array[index] = $(this).children(':first').val();
			});

			localStorage.setItem( 'datatables_search_'+ unique_hash ,'["' + search_values_array.join('","') + '"]');
		}
	} );

	var search_values = localStorage.getItem('datatables_search_'+ unique_hash);

	if( search_values !== null)
	{
		$.each($.parseJSON(search_values),function(num,val){
			if(val !== '')
			{
				$(".groceryCrudTable tfoot tr th:eq("+num+")").children(':first').val(val);
			}
		});
	}

	$('.clear-filtering').click(function(){
		localStorage.removeItem( 'DataTables_' + unique_hash);
		localStorage.removeItem( 'datatables_search_'+ unique_hash);

		chosen_table = datatables_get_chosen_table($(this).closest('.groceryCrudTable'));

		chosen_table.fnFilterClear();
		$(this).closest('.groceryCrudTable').find("tfoot tr th input").val("");
	});

	loadListenersForDatatables();

	$('a[role=button],button[role=button]').live("mouseover mouseout", function(event) {
		  if ( event.type == "mouseover" ) {
			  $(this).addClass('ui-state-hover');
		  } else {
			  $(this).removeClass('ui-state-hover');
		  }
	});

	$('th.actions').unbind('click');
	$('th.actions>div .DataTables_sort_icon').remove();

} );

function loadListenersForDatatables() {

	$('.refresh-data').click(function(){
		var this_container = $(this).closest('.dataTablesContainer');

		var new_container = $("<div/>").addClass('dataTablesContainer');

		this_container.after(new_container);
		this_container.remove();

		$.ajax({
			url: $(this).attr('data-url'),
			success: function(my_output){
				new_container.html(my_output);

				loadDataTable(new_container.find('.groceryCrudTable'));

				loadListenersForDatatables();
			}
		});
	});
}

function loadDataTable(this_datatables) {
	return $(this_datatables).dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"bStateSave": use_storage,
        "fnStateSave": function (oSettings, oData) {
            localStorage.setItem( 'DataTables_' + unique_hash, JSON.stringify(oData) );
        },
    	"fnStateLoad": function (oSettings) {
            return JSON.parse( localStorage.getItem('DataTables_'+unique_hash) );
    	},
		"iDisplayLength": default_per_page,
		"aaSorting": datatables_aaSorting,
		"oLanguage":{
		    "sProcessing":   list_loading,
		    "sLengthMenu":   show_entries_string,
		    "sZeroRecords":  list_no_items,
		    "sInfo":         displaying_paging_string,
		    "sInfoEmpty":   list_zero_entries,
		    "sInfoFiltered": filtered_from_string,
		    "sSearch":       search_string+":",
		    "oPaginate": {
		        "sFirst":    paging_first,
		        "sPrevious": paging_previous,
		        "sNext":     paging_next,
		        "sLast":     paging_last
		    }
		},
		"bDestory": true,
		"bRetrieve": true,
		"fnDrawCallback": function() {
			$('.image-thumbnail').fancybox({
				'transitionIn'	:	'elastic',
				'transitionOut'	:	'elastic',
				'speedIn'		:	600,
				'speedOut'		:	200,
				'overlayShow'	:	false
			});
			add_edit_button_listener();
		},
		"sDom": 'T<"clear"><"H"lfr>t<"F"ip>',
	    "oTableTools": {
	    	"aButtons": aButtons,
	        "sSwfPath": base_url+"assets/grocery_crud/themes/datatables/extras/TableTools/media/swf/copy_csv_xls_pdf.swf"
	    }
	});
}

function datatables_get_chosen_table(table_as_object)
{
	chosen_table_index = oTableMapping[table_as_object.attr('id')];
	return oTableArray[chosen_table_index];
}

function delete_row(delete_url , row_id)
{
	if(confirm(message_alert_delete))
	{
		$.ajax({
			url: delete_url,
			dataType: 'json',
			success: function(data)
			{
				if(data.success)
				{
					success_message(data.success_message);

					chosen_table = datatables_get_chosen_table($('tr#row-'+row_id).closest('.groceryCrudTable'));

					$('tr#row-'+row_id).addClass('row_selected');
					var anSelected = fnGetSelected( chosen_table );
					chosen_table.fnDeleteRow( anSelected[0] );
				}
				else
				{
					error_message(data.error_message);
				}
			}
		});
	}

	return false;
}

function fnGetSelected( oTableLocal )
{
	var aReturn = new Array();
	var aTrs = oTableLocal.fnGetNodes();

	for ( var i=0 ; i<aTrs.length ; i++ )
	{
		if ( $(aTrs[i]).hasClass('row_selected') )
		{
			aReturn.push( aTrs[i] );
		}
	}
	return aReturn;
}