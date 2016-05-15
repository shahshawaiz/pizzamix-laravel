
 // event listner modal
  $('#confirmDelete').on('show.bs.modal', function (e) {
      // Pass form reference to modal for submission on yes/ok
      var form = $(e.relatedTarget).closest('form');
      $(this).find('.modal-footer #confirm').data('form', form);

  });

  // user action
  $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
		  $('#confirmDelete').modal('toggle');  
      confirmed();
  });


