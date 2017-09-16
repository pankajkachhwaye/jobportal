@extends('app')

@section('main-content')
<section class="content">
    <div class="container-fluid">

        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">person_add</i>
                    </div>
                    <div class="content">
                        <div class="text">Seekers</div>
                        <div data-fresh-interval="20" data-speed="1000" data-to="{{$seeker}}" data-from="0" class="number count-to">{{$seeker}}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">map</i>
                    </div>
                    <div class="content">
                        <div class="text">Locations</div>
                        <div class="number count-to" data-from="0" data-to="{{$location}}" data-speed="1000" data-fresh-interval="20">{{$location}}</div>
                    </div>
                </div>
            </div>
           
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">business</i>
                    </div>
                    <div class="content">
                        <div class="text">Area of Sectors</div>
                       <div class="number count-to" data-from="0" data-to="{{$area}}" data-speed="1000" data-fresh-interval="20">{{$area}}</div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">folder_special</i>
                    </div>
                    <div class="content">
                        <div class="text">Specialization</div>
                        <div data-fresh-interval="20" data-speed="1000" data-to="{{$specialization}}" data-from="0" class="number count-to">{{$specialization}}</div>
                    </div>
                </div>
            </div>

        </div>
        <!-- #END# Widgets -->
           <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">record_voice_over</i>
                    </div>
                    <div class="content">
                        <div class="text">Recruiters</div>
                        <div data-fresh-interval="20" data-speed="1000" data-to="{{$recruiter}}" data-from="0" class="number count-to">{{$recruiter}}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">playlist_add_check</i>
                    </div>
                    <div class="content">
                        <div class="text">Qualifications</div>
                        <div data-fresh-interval="20" data-speed="15" data-to="{{$qualification}}" data-from="0" class="number count-to">{{$qualification}}</div>
                    </div>
                </div>
            </div>
           
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">person_pin</i>
                    </div>
                    <div class="content">
                        <div class="text">Job by roles</div>
                        <div data-fresh-interval="20" data-speed="1000" data-to="{{$role}}" data-from="0" class="number count-to">{{$role}}</div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">person_pin</i>
                    </div>
                    <div class="content">
                        <div class="text">Total Job type</div>
                        <div data-fresh-interval="20" data-speed="1000" data-to="{{$type}}" data-from="0" class="number count-to">{{$type}}</div>
                    </div>
                </div>
            </div>

        </div>
        <!-- #END# Widgets -->
        <!-- CPU Usage -->
        <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <h2>Total Jobs / Applied Jobs</h2>
                                </div>
                                <div class="col-xs-12 col-sm-6 align-right">
                                    <div class="switch panel-switch-btn">
                                        <span class="m-r-10 font-12">REAL TIME</span>
                                        <label>OFF<input type="checkbox" checked="" id="realtime"><span class="lever switch-col-cyan"></span>ON</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <div class="dashboard-flot-chart" id="real_time_chart" style="padding: 0px; position: relative;"><canvas class="flot-base" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 896px; height: 275px;" width="896" height="275"></canvas><div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div style="position: absolute; max-width: 81px; top: 258px; left: 21px; text-align: center;" class="flot-tick-label tickLabel">0</div><div style="position: absolute; max-width: 81px; top: 258px; left: 104px; text-align: center;" class="flot-tick-label tickLabel">10</div><div style="position: absolute; max-width: 81px; top: 258px; left: 191px; text-align: center;" class="flot-tick-label tickLabel">20</div><div style="position: absolute; max-width: 81px; top: 258px; left: 277px; text-align: center;" class="flot-tick-label tickLabel">30</div><div style="position: absolute; max-width: 81px; top: 258px; left: 363px; text-align: center;" class="flot-tick-label tickLabel">40</div><div style="position: absolute; max-width: 81px; top: 258px; left: 450px; text-align: center;" class="flot-tick-label tickLabel">50</div><div style="position: absolute; max-width: 81px; top: 258px; left: 536px; text-align: center;" class="flot-tick-label tickLabel">60</div><div style="position: absolute; max-width: 81px; top: 258px; left: 622px; text-align: center;" class="flot-tick-label tickLabel">70</div><div style="position: absolute; max-width: 81px; top: 258px; left: 708px; text-align: center;" class="flot-tick-label tickLabel">80</div><div style="position: absolute; max-width: 81px; top: 258px; left: 795px; text-align: center;" class="flot-tick-label tickLabel">90</div><div style="position: absolute; max-width: 81px; top: 258px; left: 878px; text-align: center;" class="flot-tick-label tickLabel">100</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div style="position: absolute; top: 245px; left: 13px; text-align: right;" class="flot-tick-label tickLabel">0</div><div style="position: absolute; top: 196px; left: 7px; text-align: right;" class="flot-tick-label tickLabel">20</div><div style="position: absolute; top: 147px; left: 7px; text-align: right;" class="flot-tick-label tickLabel">40</div><div style="position: absolute; top: 98px; left: 7px; text-align: right;" class="flot-tick-label tickLabel">60</div><div style="position: absolute; top: 49px; left: 7px; text-align: right;" class="flot-tick-label tickLabel">80</div><div style="position: absolute; top: 0px; left: 1px; text-align: right;" class="flot-tick-label tickLabel">100</div></div></div><canvas class="flot-overlay" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 896px; height: 275px;" width="896" height="275"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- #END# CPU Usage -->
    <div class="row clearfix">
                <!-- Visitors -->
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="body bg-cyan">
                            <div class="m-b--35 font-bold">RECENT JOBS IN</div>
                            <ul class="dashboard-stat-list">
                            <?php foreach ($job_by_roles as $job_by_roles) { ?><li>#{{$job_by_roles->job_by_role}}</li>
                                 <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Answered Tickets -->
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="body bg-teal">
                            <div class="font-bold m-b--35">APPLIED JOBS</div>
                            <ul class="dashboard-stat-list">
                                <li>
                                    TODAY
                                    <span class="pull-right"><b>{{$job_today}}</b> <small>JOBS</small></span>
                                </li>
                                <li>
                                    YESTERDAY
                                    <span class="pull-right"><b>{{$job_yesterday}}</b> <small>JOBS</small></span>
                                </li>
                                <li>
                                    THIS MONTH
                                    <span class="pull-right"><b>{{$job_month}}</b> <small>JOBS</small></span>
                                </li>
                                <li>
                                    THIS YEAR
                                    <span class="pull-right"><b>{{$job_year}}</b> <small>JOBS</small></span>
                                </li>
                                <li>
                                    ALL
                                    <span class="pull-right"><b>{{ $apply_on_job}}</b> <small>JOBS</small></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Answered Tickets -->
            </div>


    </div>
</section>

    @endsection