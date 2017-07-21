@extends('app')

@section('main-content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>ALL USERS</h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                                        <div class="body">
                                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                                <thead>
                                                <tr>

                                                    <th>User Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile No.</th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @foreach($users as $key_user => $value_user)
                                                    <tr>
                                                        <td>
                                                            {{$value_user['full_name']}}
                                                        </td>
                                                        <td>
                                                            {{$value_user['email']}}
                                                        </td>
                                                        <td>
                                                            {{$value_user['mobile_no']}}
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
    </section>
@endsection
