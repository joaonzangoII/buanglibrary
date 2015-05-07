@extends("site.layouts.master")
@section("head")

@endsection
@section("styles")
<style type="text/css">
  .cd-user-modal {
    visibility: hidden;
    opacity: 0;
    transition: opacity 0.3s 0, visibility 0 0.3s;
  }
   
  .cd-user-modal.is-visible {
    visibility: visible;
    opacity: 1;
    transition: opacity 0.3s 0, visibility 0 0;
  }
</style>
@endsection
@section("content")
  <div class="wrapper">
    <div class="container">
      <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{ $book->fulltitle}}
                    {{-- <small class="small">{{ $book->isbn}}</small> --}}
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Portfolio Item Row -->
        <div class="row">

            <div class="col-md-8">
                <img class="img-responsive" src="/images/uploads/{{ $book->cover->image }}" alt="">
            </div>

            <div class="col-md-4">
                <h3>Book Description</h3>
                <p>{{ $book->description}}</p>
                <h3>Book Details</h3>
                {{-- <ul> --}}
                    <p>Name:  {{ $book->name }}</p>
                    <p>title: {{ $book->title }}</p>
                    <p>ISBN:  {{ $book->isbn }}</p>
                    <p>Year:  {{ $book->year }}</p>
                    <p> {!!\DNS2D::getBarcodeHTML($book->isbn, "QRCODE")!!}</p>
                    <p><button onclick ="runAjax()" id="#book" class="btn btn-primary btn-lrg">Book</button></p>
                {{-- </ul> --}}
            </div>
        </div>
      </div>
    </div>
  </div>
  @include("site.dialogs.signin_form")
  @section("scripts")
  <script type="text/javascript">
    var timeout;
    // $(function() {
      // $('button').click(function() {
      function runAjax() {
        $.ajax({
          url: "{{ route("book.booking") }}",
          type: 'GET',
          // data: data,
          dataType: 'JSON',
          cache: false,
          success: function (data) {
            if(data["auth"]==false){
              // $("#dialog").dialog("open");
              // $('#signinform').modal('show');  
              $(this).unbind();
              window.location.href = "/auth/login";
            // console.log(data["auth"]);
            }else{     
              // console.log(data["auth"]);
              window.location.href = "/admin/bookings";
            }
          },
          error: function(jq,status,message) {
            alert('A jQuery error has occurred. Status: ' + status + ' - Message: ' + message);
          }
        });
      // });
    }

    function click() {
        if(timeout) {
                 clearTimeout(timeout);
        }
        timeout = setTimeout(test, 1000);
    }
  </script>
  <script type="text/javascript">  
  // <!-- Dialog show event handler -->
  $('#signinform').on('show.bs.modal', function (e) {
    $message = $(e.relatedTarget).attr('data-message');
    $(this).find('.modal-body p').text($message);
    $title = $(e.relatedTarget).attr('data-title');
    $(this).find('.modal-title').text($title);

    // Pass form reference to modal for submission on yes/ok
    var form = $(e.relatedTarget).closest('form');
    $(this).find('.modal-footer #confirm').data('form', form);
  });

  // <!-- Form confirm (yes/ok) handler, submits form -->
  $('#signinform').find('.modal-footer #confirm').on('click', function(){
    $(this).data('form').submit();
    // console.log("clicked");
  });

  $('#signinform').find('.modal-footer #cancel').on('click', function(){
    // $('#signinform').modal('hide')\
    $('#signinform').modal('hide');
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
  });
  </script>
  @endsection
@endsection