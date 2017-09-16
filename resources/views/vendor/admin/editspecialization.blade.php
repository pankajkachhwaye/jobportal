@extends('app')

@section('main-content')

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Update Specialization
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <form method="POST" id="add_attribute" action="{{url('/update-specialization')}}" novalidate="novalidate">
                                        {{csrf_field()}}
                                        <label class="form-label">Specialization Name</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">

                                                <input type="text" value="{{ (isset($specialization['specialization']) ? $specialization['specialization'] : '') }}" name="specialization" required class="form-control">
                                                <input type="hidden" value="{{ (isset($specialization['id']) ? $specialization['id'] : '') }}" name="id" required class="form-control">

                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update Specialization</button>
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
