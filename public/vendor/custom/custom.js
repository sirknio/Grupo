function valida(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

$('#listModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget); 		// Button that triggered the modal
  var title = button.data('title');  			// Extract info from data-* attributes
  var name = button.data('name');  			  // Extract info from data-* attributes
  
  var html = "";
  $("." + name).each(function( index ) {
    html += "<div class=\"col-lg-6\">" + $( this ).text() + "</div>"; //reemplazar 
  });

  var modal = $(this);
  modal.find('.modal-title').text(title);
  modal.find('.modal-body h4').text('Lista');
  modal.find('#ListaRegistros').html(html);
})

$('#deleteModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget); 		// Button that triggered the modal
  var code = button.data('code');  			  // Extract info from data-* attributes
  var name = button.data('name');  			  // Extract info from data-* attributes
  var surname = button.data('surname');  	// Extract info from data-* attributes
  var modal = $(this);
  modal.find('.modal-body input').val(code);
  modal.find('.modal-body h5').text('Esta seguro que desea eliminar el integrante ' + name + ' ' + surname + '?');
})

$('#archiveModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget); 	  // Button that triggered the modal
  var code = button.data('code');  			  // Extract info from data-* attributes
  var name = button.data('name');  			  // Extract info from data-* attributes
  var surname = button.data('surname');  	// Extract info from data-* attributes
  var modal = $(this);
  modal.find('.modal-body input').val(code);
  modal.find('.modal-body h5').text('Esta seguro que desea pasar el integrante ' + name + ' ' + surname + ' como inactivo?');
})