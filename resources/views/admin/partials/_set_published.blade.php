<script type="text/javascript">
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

// $('#toggle-demo').bootstrapToggle('on')
$('.checked_text').each(function(){
  // console.log(this.state);
  var state = $(this).attr('state');
  if(state == "published"){
    $('#' + this.id).bootstrapToggle('on');
  }else{
    $('#' + this.id).bootstrapToggle('off');
  }
});

$(function() {
  $('.checked_text').change(function() {
    var value = this.value;
    var state= $(this).prop('checked') == true ? "published" : "draft";
    console.log(state);
    // var date = Date("Y-m-d");
    // var monthNames = [ "January", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outobro", "Novembro", "Dezembro" ];
    var fulldate = new Date();
    var data;
    if($(this).prop('checked') == true ){
      var date = fulldate.getFullYear()+ "-" + (fulldate.getMonth() + 1) + "-"+ fulldate.getDate();
      console.log(date);
      data = {state: state, date: date, _token: CSRF_TOKEN};
    }
    else{
      data = {state: state,_token: CSRF_TOKEN};


    }
    $.ajax({
      url: '/fc-admin/update-state/' + value,
      type: 'POST',
      data: data,
      dataType: 'JSON',
      success: function (data) {
        console.log(data);
      }
    });
  })
});
</script>

<script type="text/javascript">
// <!-- Dialog show event handler -->
$('#confirmDelete').on('show.bs.modal', function (e) {
    $message = $(e.relatedTarget).attr('data-message');
    $(this).find('.modal-body p').text($message);
    $title = $(e.relatedTarget).attr('data-title');
    $(this).find('.modal-title').text($title);

    // Pass form reference to modal for submission on yes/ok
    var form = $(e.relatedTarget).closest('form');
    $(this).find('.modal-footer #confirm').data('form', form);
});

// <!-- Form confirm (yes/ok) handler, submits form -->
$('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
    $(this).data('form').submit();
    // console.log("clicked");

});
</script>
