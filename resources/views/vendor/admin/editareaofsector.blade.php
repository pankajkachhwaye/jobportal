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
                                Update Area of Sector
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <form method="POST" id="add_attribute" action="{{url('/update-area-of-sector')}}" novalidate="novalidate">
                                        {{csrf_field()}}
                                        <label class="form-label">Area Of Sector Name</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">

                                                <input type="text" name="area_of_sector" value="{{ (isset($area_of_sector['area_of_sector']) ? $area_of_sector['area_of_sector'] : '' ) }}" required class="form-control">
                                                <input type="hidden" name="id" value="{{ (isset($area_of_sector['id']) ? $area_of_sector['id'] : '' ) }}" required class="form-control">

                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update Area Of Sector</button>
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
