@extends("site.layouts.master")
@section("head")
  <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
@endsection
@section("content")
  <div class="wrapper">
     <!-- Page Content -->
    <div class="container">
    BUANG LIBRARY
  {{-- 
        @if(count($books)>0)
        <!-- Portfolio Item Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{ $books[0]->title}}
                    <small class="small">{{ $books[0]->isbn}}</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- Portfolio Item Row -->
        <div class="row">

            <div class="col-md-8">
                <img class="img-responsive" src="/images/uploads/{{ $books[0]->cover->image }}" alt="">
            </div>

            <div class="col-md-4">
                <h3>Book Description</h3>
                <p>{{ $books[0]->description}}</p>
                <h3>Book Details</h3>
                    <p>Name:  {{ $books[0]->name }}</p>
                    <p>title: {{ $books[0]->title }}</p>
                    <p>ISBN:  {{ $books[0]->isbn }}</p>
                    <p>Year:  {{ $books[0]->year }}</p>
                    <p> {!!\DNS2D::getBarcodeHTML($books[0]->isbn, "QRCODE")!!}</p>
                    <p><a class="btn btn-primary btn-large" href="/book/{{ $books[0]->slug }}">View</a></p>
            </div>

        </div>
        @endif
        <!-- /.row -->

        <!-- Related Projects Row -->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Related Books</h3>
            </div>
            @for($x=0;$x<count($books);$x++)
              <div class="col-sm-3 col-xs-6">
                  <a href="#">
                      <img class="img-responsive portfolio-item" src="/images/uploads/{{ $books[$x]->cover->image }}" alt="">
                  </a>
                  <button class="btn btn-primary" style="margin-bottom: 10px;">view</button>
              </div>
            @endfor

        </div>
        <!-- /.row -->
        <hr>--}}
    </div>
    <!-- /.container -->
  </div>
@endsection