$(document).ready(function() {
	$('#dataTables-example').DataTable({
		responsive: true
	});
});

$(document).ready(function() {
	$('#dataTables-integrantes').DataTable({
		"lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"] ],
		"language": {
			"search": "Buscar",
			"info": "Mostrando _TOTAL_ registros",
			"lengthMenu": "Mostrar _MENU_ registros",
			"infoFiltered": " - de _MAX_ total de registros",
			"paginate": {
				first:    '«',
				previous: '‹',
				next:     '›',
				last:     '»'
			},
			aria: {
				paginate: {
					first:    'First',
					previous: 'Previous',
					next:     'Next',
					last:     'Last'
				}
			}
		  }		
	});
});

$(document).ready(function() {
	$('#dataTablesEvento').DataTable({
		responsive: true,
		"lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"] ],
		"order": [[ 0, "desc" ]],
		"language": {
			"search": "Buscar",
			"info": "Mostrando _TOTAL_ registros",
			"lengthMenu": "Mostrar _MENU_ registros",
			"infoFiltered": " - de _MAX_ total de registros",
			"paginate": {
				first:    '«',
				previous: '‹',
				next:     '›',
				last:     '»'
			},
			aria: {
				paginate: {
					first:    'First',
					previous: 'Previous',
					next:     'Next',
					last:     'Last'
				}
			}
		  }		
	});
});
