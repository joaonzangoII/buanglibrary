<!-- Page Content -->
@extends("admin.layouts.master")
@section("content")
  <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          {{-- {{ Auth::user() }} --}}
          <section class="col-md-99">
          <h1>Profile: {{ Auth::user()->fullname }}</h1>
          <p>email:    {{ Auth::user()->email }}</p>


          <p>All Books:   {{ count($books) }}</p>
          <ul>
            @foreach ($books as $book)
              <li>{{$book->title}}</li>
            @endforeach
          </ul>

          {{-- <div class="col-md-4"> --}}
            <canvas id="myBarChart" width="300" height="400"></canvas> 
          {{-- </div> --}}
          </section>
        </div>
      </div>
  </div>

  @section("scripts")
     <script type="text/javascript">
     // (function( $ ) {
        var ctx_bar = document.getElementById("myBarChart").getContext("2d");
        var data_bar=[];
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

       var myBarChart = new Chart(ctx_bar).Bar(data_bar, 0); //TIPE OF CHART

     // }

     </script>
    @endsection 
  <!-- /#page-content-wrapper -->
  @endsection
