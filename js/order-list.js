$('#startDate').click(showDatePicker);
$('#endDate').click(showDatePicker);
$('#searchReceiver').searchbox({
	searcher : function(value) {
		postFilter('searchStr', value);
	},
	prompt : '在此输入查找文字'
});

function showDatePicker() {
	WdatePicker({
		onpicked : function() {
			var startDate = $('#startDate').val();
			var endDate = $('#endDate').val();
			if (startDate.length > 0 && endDate.length > 0 && startDate > endDate) {
				$('#warning').css("display", "inline");
			} else {
				postFilter(this.id, $(this).val());
			}
		},
		oncleared : function() {
			postFilter(this.id, 'null');
		}
	});
}