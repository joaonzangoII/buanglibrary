<!-- Modal Dialog -->
<div class="modal fade" id="confirmEmptyCart" role="dialog" aria-labelledby="confirmEmptyCartLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Confirm Empty Cart</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to empty the cart?</p>
        {{-- <p>num_booked: {{ Request::input("num_booked")}}</p>
        <p>book_id: {{ Request::input("book_id")}}</p> --}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="yes">Yes</button>
      </div>
    </div>
  </div>
</div>
@section("scripts")
<script type="text/javascript">  
//Making the first  letter uppercase
String.prototype.toProperCase = function(){
    return this.toLowerCase().replace(/(^[a-z]| [a-z]|-[a-z])/g, 
        function($1){
            return $1.toUpperCase();
        }
    );
};
// <!-- Dialog show event handler -->
$('#confirmEmptyCart').on('show.bs.modal', function (e) {
    // $message = 'Are you sure you want to continue this booking?';//$(e.relatedTarget).attr('data-message');
    // $(this).find('.modal-body p').text($message);
    $title = 'Confirm Empty Cart';//$(e.relatedTarget).attr('data-title');
    $(this).find('.modal-title').text($title.toProperCase());

    // Pass form reference to modal for submission on yes/ok
    var form = $(e.relatedTarget).closest('form');
    $(this).find('.modal-footer #yes').data('form', form);
});

// <!-- Form confirm (yes/ok) handler, submits form -->
$('#confirmEmptyCart').find('.modal-footer #yes').on('click', function(){
    $(this).data('form').submit();
    // console.log("clicked");

});
</script>
@stop