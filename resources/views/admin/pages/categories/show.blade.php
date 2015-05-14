<!-- Page Content -->
@extends("admin.layouts.master")
@section("content")
  <div class="container-fluid">
    <div class="row">
    <h1><b><span class="glyphicon glyphicon-eye-open"></span> Show Book Category</b></h1>
     <p>Name: {{ $book_category->name }}</p>
     <p> Books count: {{ count($book_category->books)}}</p>
     <a type="button" href="{{ URL::previous() }}" class="btn btn-warning" >Back</a>
   </div>
  <div class="row">
   {{--   {!! $filter !!}
     {!! $grid !!} --}}
       @if(count($books)>0)
         <div class="row">
           <div class="col-md-12">
             <h1>Available Books</h1>
             <hr>
            {{--          {!! Form::open(array("url" =>"/admin/categories/".$book_category->id ."/?search=1", "method" =>"GET","role" =>"form","class"=>"form-inline")) !!}
                <div class="form-group">
               {!! Form::text('title', Input::old('title'), array('class' => 'form-control', 'placeholder' => 'Title')) !!}
               </div>
               <div class="form-group">
               {!! Form::text('author', Input::old('author'), array('class' => 'form-control', 'placeholder' => 'Author')) !!}
               </div>
               <div class="form-group">
               {!! Form::text('edition', Input::old('edition'), array('class' => 'form-control', 'placeholder' => 'Edition')) !!}
               </div>
               <input class="btn btn-primary" type="submit" value="search">
               <a href="/admin/categories/{{$book_category->id }}" class="btn btn-default">Cancel</a>
               <input name="search" type="hidden" value="1">
             {!! Form::close() !!} --}}
             <br>
           {{--  @if (Auth::user()->isAdmin())
             <div class="pull-right">
               <a href="/admin/categories/create" class="btn btn-default">New book</a>
             </div>
             <br/>
             <br/>
             <br/>
             @endif --}}
             <table class="table table-striped">
               <tr>
                 {{-- <th>Cover</th> --}}
                 <th>
                   <a href="/admin/categories/{{$book_category->id }}?ord=title">
                     <span class="glyphicon glyphicon-arrow-up"></span>
                   </a>
                   <a href="/admin/categories/{{$book_category->id }}?ord=-title">
                     <span class="glyphicon glyphicon-arrow-down"></span>
                   </a>
                   Title
                 </th>
                 <th>
                   <a href="/admin/categories/{{$book_category->id }}?ord=author">
                     <span class="glyphicon glyphicon-arrow-up"></span>
                   </a>
                   <a href="/admin/categories/{{$book_category->id }}?ord=-author">
                     <span class="glyphicon glyphicon-arrow-down"></span>
                   </a>
                   Author
                 </th>
                 <th>Edition</th>
                 <th>
                   <a href="/admin/categories/{{$book_category->id }}?ord=isbn">
                     <span class="glyphicon glyphicon-arrow-up"></span>
                   </a>
                   <a href="/admin/categories/{{$book_category->id }}?ord=-isbn">
                     <span class="glyphicon glyphicon-arrow-down"></span>
                   </a>
                   ISBN
                 </th>
                 <th>
                   <a href="/admin/categories/{{$book_category->id }}?ord=total_num_books">
                     <span class="glyphicon glyphicon-arrow-up"></span>
                   </a>
                   <a href="/admin/categories/{{$book_category->id }}?ord=-total_num_books">
                     <span class="glyphicon glyphicon-arrow-down"></span>
                   </a>
                   Total # books
                 </th>
                 <th>
                   <a href="/admin/categories/{{$book_category->id }}?ord=avail_books">
                     <span class="glyphicon glyphicon-arrow-up"></span>
                   </a>
                   <a href="/admin/categories/{{$book_category->id }}?ord=-avail_books">
                     <span class="glyphicon glyphicon-arrow-down"></span>
                   </a>
                   Avail Books
                 </th>
                 <th>Year</th>
                 <th>Price(R)</th>
                 <th>Added by</th>
                 <th>Book Category</th>
                 <th>Actions</th> 

               </tr>
               @include("admin.pages.books.partials._books_list")
             </table>
           </div>
           @else
             <div class="alert alert-info col-md-4" style="margin-top: 15px">No books Available</div>
           @endif
         </div>

         <div class="row">
           <div class="text-center">
             {!!$books->render()!!}
           </div>
         </div>
        @include("admin.dialogs.delete_confirm",["value"=> "book"])
     </div>
  </div>
@endsection