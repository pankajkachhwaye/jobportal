@extends('app')

@section('main-content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>JOB TYPES</h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Add Job Type
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <form method="POST" id="add_attribute" action="{{url('/add-new-job-type')}}" novalidate="novalidate">
                                        {{csrf_field()}}
                                        <label class="form-label">Job Type Name</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">

                                                <input type="text" name="job_type" required class="form-control">

                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Add Job Type</button>
                                    </form>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2>
                                                All Job Types
                                            </h2>
                                        </div>
                                        <div class="body">
                                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                <thead>
                                                <tr>

                                                    <th>ID</th>
                                                    <th>Job Type Name</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @foreach($job_types as $key_job_types => $value_job_types)
                                                <tr>
                                                <td>
                                                {{$value_job_types['id']}}
                                                </td>
                                                <td>
                                                {{$value_job_types['job_type']}}
                                                </td>

                                                <td>
                                                    <a href="{{ url('edit-job-type').'/'.$value_job_types['id'] }}"><button type="submit" id="editdelivery" class="btn btn-primary m-t-15 waves-effect">Edit</button>
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
