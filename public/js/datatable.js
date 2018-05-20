// document ready function
var asInitVals = new Array();
var oTable;
$(document).ready(function() { 	
	//--------------- Data tables ------------------//
	var filename = window.location.pathname.substr(window.location.pathname.lastIndexOf("/")+1);
	//alert(filename);
	
	var bFilter = true;
    if($('table').hasClass('nofilter')){
        bFilter = false;
    }
    var columnSort = new Array; 
    $(this).find('thead tr th').each(function(){
        if($(this).attr('data-bSortable') == 'false') {
            columnSort.push({ "bSortable": false });
        } else {
            if($(this).html() == "Action" || $(this).html() == "Actions")
        	{
            	columnSort.push({ "bSortable": false });
        	}else{
        		columnSort.push({ "bSortable": true });
        	}
        }
    });

	if($('table').hasClass('dynamicTable')){
		noofrecords = $(".dynamicTable").attr("noofrecords");
		//console.log(filename);		
		oTable = $('.dynamicTable').dataTable({
			"sPaginationType": "full_numbers",			
			"bJQueryUI": false,
			"bAutoWidth": false,
			"bLengthChange": false,
			"bProcessing": true,
			"bServerSide": true,
			"iDisplayLength":noofrecords,
			"aaSorting":[],
			"sAjaxSource": "/json",
			"fnInitComplete": function(oSettings, json) {
				$('.dataTables_filter>label>input').parent().remove();				
		    },
		    "aoColumnDefs": [{ "bSortable": bFilter, "aTargets": [ -1 ] }],
		    "aoColumns": columnSort,
		    "fnServerParams": function ( aoData ) {
		    	var searchCount = 0;
		    	$(".searchInput").each(function(){
		    		aoData.push( { "name": "Searchkey_"+searchCount, "value": $(this).val() } );
		    		searchCount++;
		    	})
		     },
		    "fnDrawCallback": function( oSettings ) {
		    	if (typeof datatablecomplete == 'function') { 
		    		datatablecomplete("dynamicTable");
		    	} 
		    }	
		});
	
		
		$(".dataTables_filter select").bind("change", function()  {
			/* Filter on the column (the index) of this element */
			oTable.fnFilter( this.value, oTable.oApi._fnVisibleToColumnIndex(oTable.fnSettings(), $(".searchInput").index(this) ) );
		} );
		$(".dataTables_filter input").keyup( function () {
			/* Filter on the column (the index) of this element */
			oTable.fnFilter( this.value, oTable.oApi._fnVisibleToColumnIndex(oTable.fnSettings(), $(".searchInput").index(this) ) );
		} );
		$(".dataTables_filter input").change( function () {
			/* Filter on the column (the index) of this element */
			oTable.fnFilter( this.value, oTable.oApi._fnVisibleToColumnIndex(oTable.fnSettings(), $(".searchInput").index(this) ) );
		} );
	}
	
	/*
	 * Sending extra perameters before ajax call
	 */
	if($('table').hasClass('dynamicTableWithCheckboxLabReport')){
		method = $(".dynamicTableWithCheckboxLabReport").attr("callfunction");
		oTable = $('.dynamicTableWithCheckboxLabReport').dataTable({
			"sPaginationType": "full_numbers",
			"aoColumnDefs": [{ "bSortable": false, "aTargets": [0] }],
			"bJQueryUI": false,
			"bAutoWidth": false,
			"bLengthChange": false,
			"bProcessing": true,
			"bServerSide": true,
			"iDisplayLength":10,
			"aaSorting":[],
			"sAjaxSource": method,
			"fnInitComplete": function(oSettings, json) {
				$('.dataTables_filter>label>input').parent().remove();				
		    },
		    "fnCreatedRow": function( nRow, aData, iDataIndex ) {
		    	//$('td:eq(0)', nRow).html( '<input type="checkbox" name="checkbox[]" class="checkbox" value="'+ aData[0]+'">');
            	
            },
		    "fnServerParams": function ( aoData ) {
		    	var searchCount = 0;
		    	$(".searchInput").each(function(){
		    		aoData.push( { "name": "Searchkey_"+searchCount, "value": $(this).val() } );
		    		searchCount++;
		    	});
		        aoData.push( { "name": "sSearch_6", "value": $("#stack_no").val() } );
		        aoData.push( { "name": "sSearch_7", "value": $("#lot_no").val() } );
		        aoData.push( { "name": "addedpull", "value": $("#addedpull").val() } );
		        aoData.push( { "name": "id", "value": $("#lab_report_id").val() } );
		        aoData.push( { "name": "id1", "value": $("#wh_receipt_id").val() } );	
		        aoData.push( { "name": "amt_per", "value": $("#amt_per").val() } );
		     },
		     "fnDrawCallback": function( oSettings ) {
		    	 if (typeof datatablecomplete == 'function') { 
		    		 datatablecomplete("dynamicTableWithCheckboxLabReport");
		    	 } 
		     }	
		});
	
		
		$(".dataTables_filter select").bind("change", function()  {
			/* Filter on the column (the index) of this element */
			oTable.fnFilter( this.value, oTable.oApi._fnVisibleToColumnIndex(oTable.fnSettings(), $(".searchInput").index(this) ) );
		} );
		$(".dataTables_filter input").keyup( function () {
			/* Filter on the column (the index) of this element */
			oTable.fnFilter( this.value, oTable.oApi._fnVisibleToColumnIndex(oTable.fnSettings(), $(".searchInput").index(this) ) );
		} );
		/*
		$(".dataTables_filter input").change( function () {
			
			oTable.fnFilter( this.value, oTable.oApi._fnVisibleToColumnIndex(oTable.fnSettings(), $(".searchInput").index(this) ) );
		} );
		 */
	}
	
	
	if($('table').hasClass('dynamicTableWithDynamicSearch')){
		method = $(".dynamicTableWithDynamicSearch").attr("callfunction");
		oTable = $('.dynamicTableWithDynamicSearch').dataTable({
			"sPaginationType": "full_numbers",
			"bJQueryUI": false,
			"aoColumnDefs": [{ "bSortable": bFilter, "aTargets": [ -1 ] }],
			"bAutoWidth": false,
			"bLengthChange": false,
			"bProcessing": true,
			"bServerSide": true,
			"iDisplayLength":10,
			"sAjaxSource": method,
			//"aoColumns": columnSort,
			"aaSorting":[],
			"fnInitComplete": function(oSettings, json) {
				$('.dataTables_filter>label>input').parent().remove();				
		    },
		    "fnServerParams": function ( aoData ) {
		    	var searchCount = 0;
		    	$(".searchInput").each(function(){
		    		aoData.push( { "name": "Searchkey_"+searchCount, "value": $(this).val() } );
		    		searchCount++;
		    	});
		        aoData.push( { "name": "addedpull", "value": $("#addedpull").val() } );
		        aoData.push( { "name": "id", "value": $("#id").val()});
		        aoData.push( { "name": "deleted_id", "value": $("#deleted_id").val() } );		        
		     },
		     "fnDrawCallback": function( oSettings ) {
		    	 if (typeof datatablecomplete == 'function') { 
		    		 datatablecomplete("dynamicTableWithDynamicSearch");
		    	 } 
		     }		     
		});
	
		
		$(".dataTables_filter select").bind("change", function()  {
			oTable.fnDraw();
			/* Filter on the column (the index) of this element */
			//oTable.fnFilter( this.value, oTable.oApi._fnVisibleToColumnIndex(oTable.fnSettings(), $(".searchInput").index(this) ) );
		} );
		$(".dataTables_filter input").keyup( function () {
			oTable.fnDraw();
			/* Filter on the column (the index) of this element */
			//oTable.fnFilter( this.value, oTable.oApi._fnVisibleToColumnIndex(oTable.fnSettings(), $(".searchInput").index(this) ) );
		} );
		/*
		$(".dataTables_filter input").change( function () {
			oTable.fnDraw();
			//oTable.fnFilter( this.value, oTable.oApi._fnVisibleToColumnIndex(oTable.fnSettings(), $(".searchInput").index(this) ) );
		} );
		 */
	}
	
	
	/*
	 * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
	 * the footer
	 */
	$("tfoot input").each( function (i) {
		asInitVals[i] = this.value;
	} );
	
	$("tfoot").find("input").focus( function () {
		
		if ( this.className == "search_init" )
		{
			//this.className = "";
			this.value = "";
		}
	} );
	
	$("tfoot").find("input").blur( function (i) {
		
		if ( this.value == "" )
		{
			//this.className = "search_init";
			this.value = asInitVals[$("tfoot input").index(this)];
		}
	} );
	
	$("#select_all_dynamic_table_checkbox").change(function(){
		if($(this).is(":checked")){
			$(this).closest("table").find("input:checkbox").attr("checked","checked");
		}else{
			$(this).closest("table").find("input:checkbox").removeAttr("checked");
		}
	});
});//End document ready functions

function pageReload()
{	
	/*
	 * Clear Fielters and refresh data table
	 * First it clear all the fields and call its event
	 */ 
	$('.dataTables_filter input').val('').keyup();
	$('.dataTables_filter select').prop('selectedIndex',0).change();
	if (typeof calbackfunction == 'function') { 
    	calbackfunction();
	}    
}
function pageReloadNew()
{
	/*
	 * Clear Fielters and refresh data table
	 * First it clear all the fields and call its event
	 */ 
	$('.dataTables_filter input').val('');
	$('.dataTables_filter select').prop('selectedIndex',0);
	$('.select2').select2("destroy");
	$(".select2").each(function(){
		$(this).select2({
		    placeholder: "Select"
		});
		$("#s2id_"+$(this).attr("id")).removeClass("searchInput");
	});
	var oSettings = oTable.fnSettings();
    for(iCol = 0; iCol < oSettings.aoPreSearchCols.length; iCol++) {
        oSettings.aoPreSearchCols[ iCol ].sSearch = '';
    }
    oTable.fnDraw();
    if (typeof calbackfunction == 'function') { 
    	calbackfunction();
	}    
}
