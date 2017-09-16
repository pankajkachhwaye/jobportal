@extends('app')

@section('main-content')

    <section class="content">
        <div class="container-fluid">
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
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Add Area Of Sector</button>
                                    </form>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2>
                                                All Area of Sectors
                                            </h2>
                                        </div>
                                        <div class="body">
                                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                <thead>
                                                <tr>

                                                    <th>S. No.</th>
                                                    <th>Area Of Sector Name</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                <?php $i=0; ?>
                                                @foreach($area_of_sectors as $key_sector => $value_sector)
                                                    <tr>
                                                        <td>
                                                            <?php $i++; echo $i; ?>
                                                        </td>
                                                        <td>
                                                            {{$value_sector['area_of_sector']}}
                                                        </td>

                                                        <td>
                                                            <a href="{{ url('edit-area-of-sector').'/'.$value_sector['id'] }}"><button type="submit" id="editdelivery" class="btn btn-primary m-t-15 waves-effect">Edit</button></a>
                                                            <a onclick="return confirm('Are you sure you want to delete this item?');" href="{{ url('delete-area-of-sector').'/'.$value_sector['id'] }}"> <button type="submit" class="btn btn-info m-t-15 waves-effect">Delete</button></a>
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
