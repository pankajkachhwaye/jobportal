@extends('app')


@section('main-content')
    {{--<h1>this is h1</h1>--}}
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                {{--<h2>Languages</h2>--}}
            </div>


            <!-- Horizontal Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Send notification to all Recruiter
                            </h2>

                        </div>
                        <div class="body">

                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2>
                                                All Users
                                            </h2>
                                        </div>
                                        <div class="body">
                                            <div class="row clearfix">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <button type="button" class="btn bg-red waves-effect" id="send-to-selected-recruiter">Send Notification</button>
                                                </div>
                                            </div>
                                            <table class="table table-bordered table-striped table-hover notify-user dataTable">
                                                <thead>
                                                <tr>

                                                    <th>S No.</th>
                                                    <th>Organisation Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile</th>
                                                    <th>
                                                        <span>Select All</span>
                                                        <input type="checkbox" id="basic_checkbox_select_all_recruiter" class="filled-in selected-all" />
                                                        <label for="basic_checkbox_select_all_recruiter"></label>
                                                    </th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @foreach($recruiter as $key_recruiter => $value_recruiter)
                                                    <tr>
                                                        <td>
                                                            {{$key_recruiter + 1 }}
                                                        </td>
                                                        <td>
                                                            {{$value_recruiter['organisation_name']}}
                                                        </td>

                                                        <td>
                                                            {{$value_recruiter['recruiter_email']}}
                                                        </td>
                                                        <td>
                                                            {{$value_recruiter['recruiter_mobile_no']}}
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="checkbox" data-react-id="{{$value_recruiter['id']}}" id="basic_checkbox_{{$key_recruiter}}" class="filled-in select-me-recruiter particular-me-recruiter"  />
                                                            <label for="basic_checkbox_{{$key_recruiter}}"></label>
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
            <!-- #END# Horizontal Layout -->



            <!-- #END# Inline Layout | With Floating Label -->

        </div>
        <div class="modal" id="notify-selected-recruiter-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog custom-modal-dialog" role="document">
                <div class="modal-content">
                    {{--<div class="modal-header">--}}
                    {{--<h4 class="modal-title" id="defaultModalLabel">Order Detail</h4>--}}
                    {{--</div>--}}
                    <div class="row clearfix" id="orderDetails">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="card">
                                <div class="header">
                                    <div class="row clearfix">
                                        <div class="col-xs-12 col-sm-6">
                                            <h3>Send notification to recruiters</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="body">
                                    <form method="POST" id="add_attribute" action="{{ url('/notify-selected-reruiters')  }}">

                                        {{csrf_field()}}

                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="notification_title">Notification Title</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input  type="text" name="notification_title_recruiter" id="notification_title_recruiter" required class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row clearfix">
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="notification_body">Notification Body</label>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                <textarea  type="text" rows="3" name="notification_body_recruiter" id="notification_body_recruiter"  class="form-control required">
                                                </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                    <div class="row clearfix">
                                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                            <button  type="submit" id="notify-recuiter" class="btn btn-primary m-t-15 waves-effect">Send</button>
                                        </div>
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
