@extends('app')

@section('main-content')

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                        <div class="header">
                            <h2>
                                All Seekers
                            </h2>
                        </div>
                            <div class="body">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                    <tr>

                                        <th>S. No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile No.</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php $i=0; ?>
                                    @foreach($users as $key_user => $value_user)
                                        <tr>
                                        <?php $i++; ?>
                                            <td>
                                             <?php echo $i; ?>
                                            </td>
                                            <td>
                                                {{$value_user['full_name']}}
                                            </td>
                                            <td>
                                                {{$value_user['email']}}
                                            </td>
                                            <td>
                                                {{$value_user['mobile_no']}}
                                            </td>
                                             <td>
                                                <a onclick="return confirm('Are you sure you want to delete this item?');" href="{{ url('delete-user').'/'.$value_user['id'] }}"  ><button type="submit" class="btn btn-info waves-effect">Delete</button></a>
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
