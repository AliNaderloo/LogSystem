<!DOCTYPE html>
<html>
<head>
	<title>سیستم لاگ شرکت چاپار</title>
	<!-- Style -->
	<link rel="stylesheet" href="{{ asset('css/Style.css') }}">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
	<!-- Data Tables -->
	<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" >
	<!-- Remodal -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/remodal.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/remodal-default-theme.min.css')}}">
</head>
<body>
	<table id="logsTable" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>شماره</th>
				<th>توسط</th>
				<th>جدول</th>
				<th>تغییرات</th>
				<th>تاریخ</th>
			</tr>
		</thead>
	</table>
</body>
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/remodal.min.js') }}"></script>
<script type="text/javascript">
	$( document ).ready(function() {
		$(document).on('click', '.btnDetails', function(e) {
			alert('sss');
		});
		var logsTable =  $('#logsTable').DataTable({
			"processing": true,
			"serverSide": true,
			"dataType"  : "json",
			'ajax'       : {
				"type"   : "GET",
				"url"    : "/DataTable",
				"dataSrc": function (json) {
					var return_data = new Array();
					for(var i=0;i< json.data.length; i++){
						return_data.push({
							'DT_Row_Index' : json.data[i].DT_Row_Index,
							'fld_Table_Name' : json.data[i].fld_Table_Name,
							'fld_Changed_Items' : "<button name ="+'"'+json.data[i].id+'"'+"class ="+'"'+"btnDetails"+'"'+">لیست تغییرات</button>",
							'title': json.data[i].id,
							'fld_User_Id'  : json.data[i].fld_User_Id,
							'created_at' : json.data[i].created_at
						})
					}
					return return_data;
				}
			},
			"columns": [
			{ "data": "DT_Row_Index" },
			{ "data": "fld_User_Id" },
			{ "data": "fld_Table_Name" },
			{ "data": "fld_Changed_Items" },
			{ "data": "created_at" }
			],
			"language": {
				"sEmptyTable":     "هیچ داده ای در جدول وجود ندارد",
				"sInfo":           "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
				"sInfoEmpty":      "نمایش 0 تا 0 از 0 رکورد",
				"sInfoFiltered":   "(فیلتر شده از _MAX_ رکورد)",
				"sInfoPostFix":    "",
				"sInfoThousands":  ",",
				"sLengthMenu":     "نمایش _MENU_ رکورد",
				"sLoadingRecords": "در حال بارگزاری...",
				"sProcessing":     "در حال پردازش...",
				"sSearch":         "جستجو:",
				"sZeroRecords":    "رکوردی با این مشخصات پیدا نشد",
				"oPaginate": {
					"sFirst":    "ابتدا",
					"sLast":     "انتها",
					"sNext":     "بعدی",
					"sPrevious": "قبلی"
				},
				"oAria": {
					"sSortAscending":  ": فعال سازی نمایش به صورت صعودی",
					"sSortDescending": ": فعال سازی نمایش به صورت نزولی"
				}
			},
		}); 
	});
</script>
</html>