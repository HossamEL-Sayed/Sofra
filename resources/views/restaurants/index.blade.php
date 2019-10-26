@extends('layouts.app')
@inject('cities','App\Models\City')
@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Restaurants
        <small>list</small>
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">

        
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Show Restaurants</h3>
        </div>
        <div>

                    {!! Form::open([

                    'method' => 'get'

                    ]) !!}

                    <div class="row">

                        <div class="col-md-4">

                            <div class="form-group">

                                {!! Form::text('name',request()->input('name'),[

                                'placeholder' => 'Name',

                                'class' => 'form-control'

                                ]) !!}

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                {!! Form::text('phone',request()->input('phone'),[

                                'placeholder' => 'Phone Number',

                                'class' => 'form-control'

                                ]) !!}

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">

                                {!! Form::select('city_id',$cities->pluck('name','id')->toArray(),request()->input('city_id'),[

                                'class' => 'select2 form-control',

                                'placeholder' => 'city'

                                ]) !!}

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">

                                {!! Form::select('status',['opened' => 'Opened', 'closed' => 'Closed'],request()->input('status'),[

                                'class' => 'select2 form-control',

                                'placeholder' => 'activation'

                                ]) !!}

                            </div>

                        </div>

                        <div class="col-md-2">

                            <div class="form-group">

                                <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-search"></i></button>

                            </div>

                        </div>

                    </div>

                    {!! Form::close() !!}

        </div>

      </div>


        <div class="box-body">
          @if(count($restaurants))
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>City</th>
                  <th>Activation</th>
                  <th>Delete</th>
                </tr>
                </thead>

                <tbody>
                  @foreach($restaurants as $restaurant)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td><a href="{{url(route('restaurants.show', $restaurant->id))}}">{{$restaurant->name}}</a></td>
                      <td>{{$restaurant->phone}}</td>
                      <td>{{$restaurant->email}}</td>
                      <td>{{$restaurant->neighborhood->city->name}}</td>
                      <td class="text-center">
                            @if($restaurant->activated)
                                <a href="restaurant/{{$restaurant->id}}/de-activate" class="btn btn-xs btn-danger"><i class="fa fa-close"></i> De-Activate</a>
                            @else
                                <a href="restaurant/{{$restaurant->id}}/activate" class="btn btn-xs btn-success"><i class="fa fa-check"></i> Activate</a>
                            @endif
                      </td>
                      <td>
                          {!! Form::open([
                            'action' => ['RestaurantController@destroy', $restaurant->id],
                            'method' => 'delete'
                          ]) !!}
                          <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                          {!! Form::close() !!}
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <div class="alert alert-danger" role="alert">
              No data
            </div>
          @endif
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->

@endsection
