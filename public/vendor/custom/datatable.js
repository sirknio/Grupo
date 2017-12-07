$(document).ready(function() {
	$('#dataTables-example').DataTable({
		responsive: true
	});
});

$(document).ready(function() {
	$('#dataTablesEvento').DataTable({
		responsive: true,
		//"pagingType": "full_numbers",
		"order": [[ 0, "desc" ]]
	});
});
