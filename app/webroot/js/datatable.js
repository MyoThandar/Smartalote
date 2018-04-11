// DataTable
jQuery(function($){
	$("#datatable").DataTable({
		'lengthChange': false, // 件数切替機能 無効
		'filter': false, // 検索機能 無効
		'info': false, // 情報表示 無効
		'paginate': false, // ページング機能 無効
		'columnDefs': [
			{
				'targets': 'operation',
				'orderable': false
			}
		]
	});
});