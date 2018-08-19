$(document).ready(function() {
	$('#dataTableDefault').DataTable({
		responsive: true,
		"lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"] ],
		"language": {
			"search": "Buscar",
			"info": "_START_ - _END_ de _TOTAL_ registros",
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
	$('#dataTableEvent').DataTable({
		responsive: true,
		"lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"] ],
		//Se adiciona este ordenamiento para mostrar en la primera página los últimos 5 eventos
		"order": [[ 0, "desc" ]],
		"language": {
			"search": "Buscar",
			"info": "_START_ - _END_ de _TOTAL_ registros",
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
