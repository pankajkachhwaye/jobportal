@extends('app')

@section('main-content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>LOCATIONS</h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Add New Location
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <form method="POST" id="add_attribute" action="{{url('/add-new-location')}}" novalidate="novalidate">
                                {{csrf_field()}}
                                <label class="form-label">Location Name</label>
                                <div class="form-group form-float">
                                    <div class="form-line">

                                        <input type="text" name="location_name" required class="form-control">

                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Add Location</button>
                            </form>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2>
                                               All Locations
                                            </h2>
                                        </div>
                                        <div class="body">
                                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                <thead>
                                                <tr>

                                                    <th>ID</th>
                                                    <th>Loaction Name</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @foreach($locations as $key_location => $value_location)
                                                    <tr>
                                                        <td>
                                                            {{$value_location['id']}}
                                                        </td>
                                                        <td>
                                                            {{$value_location['location_name']}}
                                                        </td>

                                                        <td>
                                                            <a href="{{ url('edit-location').'/'.$value_location['id'] }}"> <button type="submit" id="editdelivery" class="btn btn-primary m-t-15 waves-effect">Edit</button></a>
                                                            <a onclick="return confirm('Are you sure you want to delete this item?');" href="{{ url('delete-location').'/'.$value_location['id'] }}"  ><button type="submit" class="btn btn-info m-t-15 waves-effect">Delete</button></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
