<!-- Page Content -->
@extends("admin.layouts.master")
@section("content")
  <div class="container-fluid">
    {{-- {{ Auth::user() }} --}}
    <div class="col-md-12">
    <h1>Welcome To Buang Library Admin</h1>
    {{-- <p>All Books:   {{ count($books) }}</p> --}}
      <div class="col-sm-5">
        <div class="row">
         <canvas id="myBarChart" width="500" height="400"></canvas> 
        </div>
        <div class="row">
         <canvas id="myPieChart" width="500" height="400"></canvas> 
         <canvas id="myLineChart" width="500" height="400"></canvas> 
        </div>
      </div>
      <div class="col-sm-7">
        <h3>Latest Books</h3>
        <table class="table table-striped">
          <tr>
            {{-- <th>Cover</th> --}}
            <th>
            <a href="/admin/books?ord=title">
            <span class="glyphicon glyphicon-arrow-up"></span>
            </a>
            <a href="/admin/books?ord=-title">
            <span class="glyphicon glyphicon-arrow-down"></span>
            </a>
            Title
            </th>
            <th>Price(R)</th>
            <th>Book Category</th>
            <th>Actions</th> 
          </tr>
          @foreach($books as $key => $value)
            <tr>
              <td>{{$value->title}}</td>
              <td>{{$value->price}}</td>
              <td>{{$value->book_category->name}}</td>
              @if(Auth::User()->isAdmin())
                <td class="center">
                 @include("admin.pages.books.partials._actions_admins")
                </td>
              @else
                <td class="center">
                @include("admin.pages.books.partials._actions_normal")
              </td>
            @endif
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>

  @section("scripts")
     <script type="text/javascript">
     // (function( $ ) {
        var ctx_bar = document.getElementById("myBarChart").getContext("2d");
        var ctx_pie = document.getElementById("myPieChart").getContext("2d");
        var ctx_line = document.getElementById("myLineChart").getContext("2d");
        var data_bar=[];
        var data_pie=[];
        var data_line=[];
        data_pie = {
             value: {!! json_encode($books_count) !!},
             color:"#337ab7",
             highlight: "#337ab7",
             labels: {!! json_encode($book_categories_list) !!}
        };
        var data_bar = {
        labels: {!! json_encode($book_categories_list) !!},
        datasets: [
        // {
        //   label: "My First dataset",
        //   fillColor: "rgba(220,220,220,0.5)",
        //   strokeColor: "rgba(220,220,220,0.8)",
        //   highlightFill: "rgba(220,220,220,0.75)",
        //   highlightStroke: "rgba(220,220,220,1)",
        //   data: category_news_count
        // },
          {
            label: "My Second dataset",
            fillColor: "rgba(151,187,205,0.5)",
            strokeColor: "rgba(151,187,205,0.8)",
            highlightFill: "rgba(151,187,205,0.75)",
            highlightStroke: "rgba(151,187,205,1)",
            data: {!! json_encode($books_count) !!}

        }
        ]};

        var data_line = {
        labels: {!! json_encode($book_categories_list) !!},
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: {!! json_encode($books_count) !!}
            },
            // {
            //     label: "My Second dataset",
            //     fillColor: "rgba(151,187,205,0.2)",
            //     strokeColor: "rgba(151,187,205,1)",
            //     pointColor: "rgba(151,187,205,1)",
            //     pointStrokeColor: "#fff",
            //     pointHighlightFill: "#fff",
            //     pointHighlightStroke: "rgba(151,187,205,1)",
            //     data: [28, 48, 40, 19, 86, 27, 90]
            // }
        ]
      };
       var myBarChart = new Chart(ctx_bar).Bar(data_bar, 0); //TIPE OF CHART
       var myPiLineChart = new Chart(ctx_pie).Line(data_line, 0); //TIPE OF CHART


     </script>
    @endsection 
  <!-- /#page-content-wrapper -->
  @endsection
