@extends('app')

@section('main-content')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>RECRUITER POSTED JOBS</h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">

                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="card">
                                            <div class="header">
                                                <h2>
                                                        {{ $recruiter->organisation_name }} posted jobs

                                                </h2>
                                                {{--<ul class="header-dropdown m-r--5">--}}
                                                    {{--<li class="dropdown">--}}
                                                        {{--<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">--}}
                                                            {{--<i class="material-icons">more_vert</i>--}}
                                                        {{--</a>--}}
                                                        {{--<ul class="dropdown-menu pull-right">--}}
                                                            {{--<li><a href="javascript:void(0);">Action</a></li>--}}
                                                            {{--<li><a href="javascript:void(0);">Another action</a></li>--}}
                                                            {{--<li><a href="javascript:void(0);">Something else here</a></li>--}}
                                                        {{--</ul>--}}
                                                    {{--</li>--}}
                                                {{--</ul>--}}
                                            </div>
                                            <div class="body">
                                                <ul class="list-group">
                                                    @foreach($jobs as $key_jobs => $value_jobs)
                                                    <li class="list-group-item">{{ $value_jobs['specialization'] }} <span class="badge bg-pink custom-badge getdetails" data-react="{{ $value_jobs['id'] }}">View Detail</span></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- #END# Badges -->
                                </div>

                            </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
