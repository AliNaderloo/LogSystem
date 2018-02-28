<!DOCTYPE html>
<html>
<head>
	<title>سیستم لاگ شرکت چاپار|لاگ های یوزر <?php echo e($userId); ?></title>
	<!-- Style -->
	<link rel="stylesheet" href="<?php echo e(asset('css/Style.css')); ?>">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo e(asset('css/font-awesome.min.css')); ?>">
	<!-- Data Tables -->
	<link rel="stylesheet" href="<?php echo e(asset('css/jquery.dataTables.min.css')); ?>">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo e(asset('css/font-awesome.min.css')); ?>" >
	<!-- Remodal -->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/remodal.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/remodal-default-theme.min.css')); ?>">
</head>
<body>
	<table id="logsTable" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>شماره</th>
				<th>توسط</th>
				<th>آیپی</th>
				<th>مرورگر</th>
				<th>جدول</th>
				<th>تغییرات</th>
				<th>تاریخ</th>
			</tr>
		</thead>
	</table>
	<!-- Remodal -->
	<div class="remodal" data-remodal-id="modalFlds">
		<button data-remodal-action="close" class="remodal-close"></button>
		<table id="fieldLogsTable" class="display" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>شماره</th>
					<th>نام فیلد</th>
					<th>مقدار قبلی</th>
					<th>مقدار جدید</th>
				</tr>
			</thead>
		</table>
		
	</div>
	<!-- End Remodal -->
</body>
<script type="text/javascript" src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/jquery.dataTables.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/remodal.min.js')); ?>"></script>
<script type="text/javascript">
	$( document ).ready(function() {
		
		$(document).on('click', '.btnDetails', function(e) {
			var id = $(this).attr('name');
			var fieldLogsTable =  $('#fieldLogsTable').DataTable({
				"destroy": true,
				"processing": true,
				"serverSide": true,
				"dataType"  : "json",
				'ajax'       :"/DataTableFields/"+id,
				"columns": [
				{ "data": "DT_Row_Index" },
				{ "data": "fld" },
				{ "data": "old" },
				{ "data": "new" }
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
			var inst = $('[data-remodal-id=modalFlds]').remodal();
			inst.open();
		});
		var logsTable =  $('#logsTable').DataTable({
			"pageResize": true,
			"pageLength": 13,
			"processing": true,
			"serverSide": true,
			"dataType"  : "json",
			'ajax'       : {
				"type"   : "GET",
				"url"    : "/DataTable/user/<?php echo e($userId); ?>",
				"dataSrc": function (json) {
					var return_data = new Array();
					for(var i=0;i< json.data.length; i++){
						return_data.push({
							'DT_Row_Index' : json.data[i].DT_Row_Index,
							'fld_Table_Name' : json.data[i].fld_Table_Name,
							'fld_Changed_Items' : "<button name ="+'"'+json.data[i].id+'"'+"class ="+'"'+"btnDetails"+'"'+"><i class="+'"'+"fas fa-align-right"+'"'+"></i></button>",
							'title': json.data[i].id,
							'fld_User_Id'  : json.data[i].fld_User_Id,
							'created_at' : json.data[i].created_at,
							'fld_Ip':json.data[i].fld_Ip,
							'fld_Browser':json.data[i].fld_Browser
						})
					}
					return return_data;
				}
			},
			aaSorting: [[6, 'desc']],
			"columns": [
			{ "data": "DT_Row_Index" },
			{ "data": "fld_User_Id" },
			{ "data": "fld_Ip" },
			{ "data": "fld_Browser" },
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
			"columnDefs": [ {
				"targets": [0,5],
				"orderable": false
			} ]
		}); 


	});
</script>
</html>