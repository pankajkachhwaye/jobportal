@extends('app')

@section('main-content')

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Update Location
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <form method="POST" id="add_attribute" action="{{url('/update-location')}}" novalidate="novalidate">
                                        {{csrf_field()}}
                                        <label class="form-label">Location Name</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">

                                                <input type="text" name="location_name" value="{{ (isset($location['location_name']) ? $location['location_name'] : '') }}" required class="form-control">
                                                <input type="hidden" name="id" value="{{ (isset($location['id']) ? $location['id'] : '') }}">

                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update Location</button>
                                    </form>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
