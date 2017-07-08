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

 // $('#deleteModal').on('show.bs.modal', function (event) {
  // var button = $(event.relatedTarget) // Button that triggered the modal
  // var recipient = button.data('cod') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  // var modal = $(this)
  // modal.find('.modal-title').text('New message to ' + recipient)
  // modal.find('.modal-body input').val(recipient)
// })

$('#deleteModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget); 		// Button that triggered the modal
  var code = button.data('code');  			// Extract info from data-* attributes
  var name = button.data('name');  			// Extract info from data-* attributes
  var surname = button.data('surname');  	// Extract info from data-* attributes
  var modal = $(this);
  modal.find('.modal-body input').val(code);
  modal.find('.modal-body h5').text('Esta seguro que desea eliminar el integrante ' + name + ' ' + surname + ' ?');
})