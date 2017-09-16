<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <div class="menu">
            <ul class="list">
                <li class="{{(isset($page) && $page && $page=='dashboard')?'active':''}}">
                    <a href="{{url('/dashboard')}}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{(isset($page) && $page && $page=='recruiter')?'active':''}}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">record_voice_over</i>
                        <span>Recruiters</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{(isset($sub_page) && $sub_page && $sub_page=='all-recruiter')?'active':''}}">
                            <a href="{{ url('/recruiter/all-recruiter') }}">
                                All Recruiters
                            </a>

                        </li>
                    </ul>
                </li>
                <li class="{{(isset($page) && $page && $page=='user')?'active':''}}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">person_add</i>
                        <span>Seekers</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{(isset($sub_page) && $sub_page && $sub_page=='all-user')?'active':''}}">
                            <a href="{{ url('/all-user')  }}">All Seekers</a>
                        </li>
                    </ul>
                </li>
                <li class="{{(isset($page) && $page && $page=='location')?'active':''}}">
                    <a href="{{url('/location')}}">
                        <i class="material-icons">map</i>
                        <span>Locations</span>
                    </a>
                </li>
                <li class="{{(isset($page) && $page && $page=='area-of-sectors')?'active':''}}">
                    <a href="{{url('/area-of-sectors')}}">
                        <i class="material-icons">business</i>
                        <span>Area of Sectors</span>
                    </a>
                </li>
                <li class="{{(isset($page) && $page && $page=='specialization')?'active':''}}">
                    <a href="{{url('/specialization')}}">
                        <i class="material-icons">folder_special</i>
                        <span>Specializations</span>
                    </a>
                </li>
                <li class="{{(isset($page) && $page && $page=='qualification')?'active':''}}">
                    <a href="{{url('/qualification')}}">
                        <i class="material-icons">playlist_add_check</i>
                        <span>Qualifications</span>
                    </a>
                </li>
                <li class="{{(isset($page) && $page && $page=='job-by-roles')?'active':''}}">
                    <a href="{{url('/job-by-role')}}">
                        <i class="material-icons">person_pin</i>
                        <span>Job Roles</span>
                    </a>
                </li>
                <li class="{{(isset($page) && $page && $page=='job-types')?'active':''}}">
                    <a href="{{url('/job-types')}}">
                        <i class="material-icons">person_pin</i>
                        <span>Job Types</span>
                    </a>
                </li>
                <li>
                <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="material-icons">input</i>
                        <span>Sign Out</span>
                    </a>
                </li>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
                </form>
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2017 <a href="javascript:void(0);">JOB PORTAL</a>.
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- #END# Right Sidebar -->
</section>