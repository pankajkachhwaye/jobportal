@extends('app')

@section('main-content')

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Update Qualification
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <form method="POST" id="add_attribute" action="{{url('/update-qualification')}}" novalidate="novalidate">
                                        {{csrf_field()}}
                                        <label class="form-label">Qualification Name</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">

                                                <input type="text" value="{{ (isset($qualification['qualification']) ? $qualification['qualification'] : '') }}" name="qualification" required class="form-control">
                                                <input type="hidden" value="{{ (isset($qualification['id']) ? $qualification['id'] : '') }}" name="id">

                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update Qualification</button>
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
