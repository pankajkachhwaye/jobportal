@extends('app')

@section('main-content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>ALL RECRUITER</h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="body">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                    <tr>

                                        <th>Organization Name</th>
                                        <th>Email</th>
                                        <th>Mobile No.</th>
                                        {{--<th>Posted Jobs</th>--}}

                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($recruiter as $key_recruiter => $value_recruiter)
                                        <tr>
                                            <td>
                                                {{$value_recruiter['organisation_name']}}
                                            </td>
                                            <td>
                                                {{$value_recruiter['recruiter_email']}}
                                            </td>
                                            <td>
                                                {{$value_recruiter['recruiter_mobile_no']}}
                                            </td>
                                            {{--<td>--}}
                                                {{--<a href="{{ url('/recruiter/view-details').'/'.$value_recruiter['id'] }} "> <button type="button" class="btn bg-brown waves-effect">View Details</button></a>--}}

                                            {{--</td>--}}

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
    </section>
@endsection
