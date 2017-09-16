@extends('app')

@section('main-content')

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Update Job Role
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <form method="POST" id="add_attribute" action="{{url('/update-job-role')}}" novalidate="novalidate">
                                        {{csrf_field()}}
                                        <label class="form-label">Job Role Name</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">

                                                <input type="text" value="{{ (isset($job_by_role['job_by_role']) ? $job_by_role['job_by_role'] : '')  }}" name="job_by_role" required class="form-control">
                                                <input type="hidden" value="{{ (isset($job_by_role['id']) ? $job_by_role['id'] : '')  }}" name="id" >

                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update Job Role</button>
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
