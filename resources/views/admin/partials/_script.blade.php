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
  //-----------------------------------------------------------------------
  // 2) Send a http request with AJAX http://api.jquery.com/jQuery.ajax/
  //-----------------------------------------------------------------------
  $.ajax({                                      
  url: '{{ route("admin.books.index") }}',                  //the script to call to get data          
  data: "",                        //you can insert url argumnets here to pass to api.php
                                   //for example "id=5&parent=6"
  dataType: 'json',                //data format      
  success: function(data)          //on recieve of reply
  {
    var id = data[0];              //get id
    var vname = data[1];           //get name
    //--------------------------------------------------------------------
    // 3) Update html content
    //--------------------------------------------------------------------
    $('#output').html("<b>id: </b>"+id+"<b> name: </b>"+vname); //Set output element html
    //recommend reading up on jquery selectors they are awesome 
    // http://api.jquery.com/category/selectors/
  } 
  });
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
