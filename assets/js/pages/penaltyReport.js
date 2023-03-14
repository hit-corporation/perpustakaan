'use strict'

// Search daterangepicker
$(document).ready(function () {
	$('input[name="daterange"]').daterangepicker({
		opens: 'right',
	}, function(start, end, label) {
		tableMain.columns(1).search(formSearchName['s_member_name'].value).draw();
		tableMain.columns(2).search(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD')).draw();
		tableMain.columns(3).search(formSearchName['status'].value).draw();
	});
});

const formSearch = document.forms['form-search'];

// get all data
const getAll = async () => {
	try{
		const f = await fetch(BASE_URL + '/report/get_all_penalty');
		const j = await f.json();

		return j;
	}catch(err){
		console.log(err);
	}
}
