@extends('app')

@section('main-content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>QUALIFICATIONS</h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Add New Qualification
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <form method="POST" id="add_attribute" action="{{url('/add-new-qualification')}}" novalidate="novalidate">
                                        {{csrf_field()}}
                                        <label class="form-label">Qualification Name</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">

                                                <input type="text" name="qualification" required class="form-control">

                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Add Qualification</button>
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
                                                    <th>Qualification Name</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @foreach($qualifications as $key_qualification => $value_qualification)
                                                    <tr>
                                                        <td>
                                                            {{$value_qualification['id']}}
                                                        </td>
                                                        <td>
                                                            {{$value_qualification['qualification']}}
                                                        </td>

                                                        <td>
                                                            <a href="{{ url('edit-qualification').'/'.$value_qualification['id'] }}"><button type="submit" id="editdelivery" class="btn btn-primary m-t-15 waves-effect">Edit</button></a>
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
