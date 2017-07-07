@extends('app')

@section('main-content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>AREA OF SECTORS</h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Add New Area of Sector
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <form method="POST" id="add_attribute" action="{{url('/add-new-area-of-sector')}}" novalidate="novalidate">
                                        {{csrf_field()}}
                                        <label class="form-label">Area Of Sector Name</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">

                                                <input type="text" name="area_of_sector" required class="form-control">

                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Add Discount</button>
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
                                                    <th>Area Of Sector Name</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @foreach($area_of_sectors as $key_sector => $value_sector)
                                                    <tr>
                                                        <td>
                                                            {{$value_sector['id']}}
                                                        </td>
                                                        <td>
                                                            {{$value_sector['area_of_sector']}}
                                                        </td>

                                                        <td> <button type="submit" id="editdelivery" class="btn btn-primary m-t-15 waves-effect">Edit</button>
                                                            <button type="submit" class="btn btn-info m-t-15 waves-effect">Delete</button>
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
