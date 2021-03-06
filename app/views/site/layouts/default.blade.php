<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8"/>
    <link rel="shortcut icon" href="{{URL::to('favicon.ico')}}" type="image/x-icon"/>
    <title>
        @section('title')
            Piece by Peace
        @show
    </title>
    @section('meta_keywords')
        <meta name="keywords" content="your, awesome, keywords, here"/>
    @show
    @section('meta_author')
        <meta name="author" content="Piece by peace"/>
    @show
    @section('meta_description')
        <meta name="description" content="Página para encontrar tu propio voluntariado"/>
        @show
                <!-- Mobile Specific Metas
		================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS
        ================================================== -->
        <link rel="stylesheet" href="{{asset('template/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('template/bootstrap/css/bootstrap-responsive.min.css')}}">

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Icons -->
        <link href="{{asset('template/icons/general/stylesheets/general_foundicons.css')}}" media="screen"
              rel="stylesheet" type="text/css"/>
        <link href="{{asset('template/icons/social/stylesheets/social_foundicons.css')}}" media="screen"
              rel="stylesheet" type="text/css"/>
        <!--[if lt IE 8]>
        <link href="{{asset('template/icons/general/stylesheets/general_foundicons_ie7.css')}}" media="screen"
              rel="stylesheet" type="text/css"/>
        <link href="{{asset('template/icons/social/stylesheets/social_foundicons_ie7.css')}}" media="screen"
              rel="stylesheet" type="text/css"/>
        <![endif]-->
        <link rel="stylesheet" href="{{asset('template/fontawesome/css/font-awesome.min.css')}}">
        <!--[if IE 7]>
        <link rel="stylesheet" href="{{asset('template/fontawesome/css/font-awesome-ie7.min.css')}}">
        <![endif]-->
        <link href="{{asset('template/carousel/style.css" rel="stylesheet" type="text/css')}}"/>
        <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">

        <link href="http://fonts.googleapis.com/css?family=Abel" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">
        <link href="{{asset('template/custom.css')}}" rel="stylesheet" type="text/css"/>
</head>


<body id="pageBody">

<div id="decorative2">
    <div class="container">

        <div class="divPanel topArea notop nobottom">
            <div class="row-fluid">
                <div class="span12">

                    <link rel="stylesheet" href="{{asset('template/bootstrap/css/mobileNavBar.css')}}">
                    <div  class="mobileNavBar">
                        <div id="divLogo" class="pull-left">
                            <a href="{{{ URL::to('') }}}" id="divSiteTitle">Piece by peace</a><br/>
                            <a href="{{{ URL::to('') }}}" id="divTagLine">Let's be helpful</a>
                        </div>
                    </div>

                    <div id="divMenuRight" class="pull-right">
                        <div class="navbar">
                            <button type="button" class="btn btn-navbar-highlight btn-large btn-primary"
                                    data-toggle="collapse" data-target=".nav-collapse">
                                {{{ Lang::get('site.navigation') }}} <span class="icon-chevron-down icon-white"></span>
                            </button>
                            <div class="nav-collapse collapse">
                                <ul class="nav nav-pills ddmenu">
                                    {{--<li class="dropdown active"><a href="{{{ URL::to('') }}}">Home</a></li>--}}


                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle">{{{ Lang::get('site.projects') }}} <b
                                                    class="caret"></b></a>

                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{{ URL::to('projects') }}}">{{{ Lang::get('site.findVolunteerProjects') }}}</a>
                                            </li>
                                            <li>
                                                <a href="{{{ URL::to('projectsCsr') }}}">{{{ Lang::get('site.findCsrProjects') }}}</a>
                                            </li>

                                            @if (Auth::check() && Auth::user()->hasRole('VOLUNTEER'))

                                                <li class="dropdown"><a
                                                            href="{{{ URL::to('volunteer/project/myVolunteerProjects') }}}">{{{ Lang::get('site.myVolunteersProjects') }}}</a>
                                                </li>
                                                <li class="dropdown"><a
                                                            href="{{{ URL::to('volunteer/project/myCsrProjects') }}}">{{{ Lang::get('site.myCsrProjects') }}}</a>
                                                </li>
                                                <li class="dropdown"><a
                                                            href="{{{ URL::to('volunteer/application/Volunteer') }}}">{{{ Lang::get('site.myVolunteerApplication') }}}</a>
                                                </li>
                                                <li class="dropdown"><a
                                                            href="{{{ URL::to('volunteer/application/Csr') }}}">{{{ Lang::get('site.myCsrApplication') }}}</a>
                                                </li>
                                            @elseif (Auth::check() && Auth::user()->hasRole('NonGovernmentalOrganization'))
                                                <li class="dropdown"><a
                                                            href="{{{ URL::to('ngo/project/createVolunteerProject') }}}">{{{ Lang::get('site.createVolunteerProjects') }}}</a>
                                                </li>
                                                <li class="dropdown"><a
                                                            href="{{{ URL::to('ngo/project/myVolunteersProjects') }}}">{{{ Lang::get('site.myVolunteersProjects') }}}</a>
                                                </li>
                                                <li class="dropdown"><a
                                                            href="{{{ URL::to('ngo/application/pending') }}}">{{{ Lang::get('site.pendingApplications') }}}</a>
                                                </li>

                                                <li class="dropdown"><a
                                                            href="{{{ URL::to('ngo/application/answered') }}}">{{{ Lang::get('site.answeredApplications') }}}</a>
                                                </li>
                                            @elseif (Auth::check() && Auth::user()->hasRole('COMPANY'))
                                                <li class="dropdown"><a
                                                            href="{{{ URL::to('company/project/createCsrProject') }}}">{{{ Lang::get('site.createCsrProject') }}}</a>
                                                </li>
                                                <li class="dropdown"><a
                                                            href="{{{ URL::to('company/project/myCsrProjects') }}}">{{{ Lang::get('site.myCsrProjects') }}}</a>
                                                </li>
                                                <li class="dropdown"><a
                                                            href="{{{ URL::to('company/application/pending') }}}">{{{ Lang::get('site.pendingApplications') }}}</a>
                                                </li>

                                                <li class="dropdown"><a
                                                            href="{{{ URL::to('company/application/answered') }}}">{{{ Lang::get('site.answeredApplications') }}}</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>

                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle">{{{ Lang::get('site.campaigns') }}}<b
                                                    class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown"><a
                                                        href="{{{ URL::to('campaign/findActive') }}}">{{{ Lang::get('campaign/campaign.allActiveCampaigns') }}}</a>
                                            </li>
                                            @if (Auth::check() && Auth::user()->hasRole('NonGovernmentalOrganization'))
                                                <li class="dropdown"><a
                                                            href="{{{ URL::to('ngo/myActiveCampaigns') }}}">{{{ Lang::get('campaign/campaign.myActiveCampaigns') }}}</a>
                                                </li>
                                                <li class="dropdown"><a
                                                            href="{{{ URL::to('ngo/myExpiredCampaigns') }}}">{{{ Lang::get('campaign/campaign.myExpiredCampaigns') }}}</a>
                                                </li>
                                                <li class="dropdown"><a
                                                            href="{{{ URL::to('ngo/campaign/create') }}}">{{{ Lang::get('campaign/campaign.create') }}}</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>

                                    @if (Auth::check() && Auth::user()->hasRole('NonGovernmentalOrganization'))
                                        <li class="dropdown"><a href="#"
                                                                class="dropdown-toggle">{{{ Lang::get('ngo/credits/table.credits') }}}
                                                : {{{Auth::user()->actor()->credits}}}<b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown"><a
                                                            href="{{{ URL::to('ngo/credits/create') }}}">{{{ Lang::get('ngo/credits/table.title') }}}</a>
                                                </li>

                                            </ul>
                                        </li>
                                    @endif


                                    @if (Auth::check() && Auth::user()->hasRole('ADMINISTRATOR'))
                                        <li class="dropdown"><a href="#"
                                                                class="dropdown-toggle">{{{ Lang::get('site.users') }}}
                                                <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown"><a
                                                            href="{{{ URL::to('admin/search/findNGOsNotActive') }}}">{{{ Lang::get('site.findNgosNotActive') }}}</a>
                                                </li>
                                                <li class="dropdown"><a
                                                            href="{{{ URL::to('admin/search/findCompaniesNotActive') }}}">{{{ Lang::get('site.findCompaniesNotActive') }}}</a>
                                                </li>

                                                <li class="dropdown"><a
                                                            href="{{{ URL::to('admin/search/searchVolunteers') }}}">{{{ Lang::get('site.findVolunteers') }}}</a>
                                                </li>
                                                <li class="dropdown"><a
                                                            href="{{{ URL::to('admin/search/searchCompanies') }}}">{{{ Lang::get('site.findCompanies') }}}</a>
                                                </li>
                                                <li class="dropdown"><a
                                                            href="{{{ URL::to('admin/search/searchNGOs') }}}">{{{ Lang::get('site.findNGOs') }}}</a>
                                                </li>
                                            </ul>
                                        </li>
                                    @endif

                                    @if (Auth::check())
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle">{{{ Lang::get('site.messaging') }}} <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                    <li class="dropdown"><a
                                                                href="{{{ URL::to('messages/inbox') }}}">{{{ Lang::get('site.messagesInbox') }}}</a>
                                                    </li>
                                                    <li class="dropdown"><a
                                                                href="{{{ URL::to('messages/sent') }}}">{{{ Lang::get('site.messagesSent') }}}</a>
                                                    </li>
                                                    @if (Auth::user()->hasRole('ADMINISTRATOR'))
                                                        <li class="dropdown"><a
                                                                    href="{{{ URL::to('admin/message/broadcastMessage') }}}">{{{ Lang::get('site.broadcastMessage') }}}</a>
                                                        </li>
                                                    @endif
                                            </ul>
                                        </li>

                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle">{{{ Auth::user()->username }}} <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                            @if (Auth::user()->hasRole('NonGovernmentalOrganization'))
                                                <li><a href="{{{ URL::to('userNgo/edit') }}}"> {{{ Lang::get('site.editUser') }}} </a></li>
                                            @endif

                                            @if (Auth::user()->hasRole('COMPANY'))
                                                    <li><a href="{{{ URL::to('userCompany/edit') }}}"> {{{ Lang::get('site.editUser') }}} </a></li>
                                            @endif

                                            @if (Auth::user()->hasRole('VOLUNTEER'))
                                                    <li><a href="{{{ URL::to('userVolunteer/edit') }}}"> {{{ Lang::get('site.editUser') }}} </a></li>
                                            @endif
                                            @if (Auth::user()->hasRole('ADMINISTRATOR'))
                                                <li><a href="{{{ URL::to('admin/dashboard') }}}"> {{{ Lang::get('site.dashboard') }}} </a></li>
                                            @endif

                                                <li><a href="{{{ URL::to('user/logout') }}}"> {{{ Lang::get('site.logout') }}} </a></li>
                                            </ul>

                                        </li>
                                    @endif

                                @if(!Auth::check())
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle">{{{ Lang::get('site.sign_up') }}} <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li {{ (Request::is('volunteer/create') ? ' class="active"' : '') }}><a
                                                            href="{{{ URL::to('userVolunteer/create') }}}">{{{ Lang::get('site.volunteer') }}}</a>
                                                </li>
                                                <li {{ (Request::is('ngo/create') ? ' class="active"' : '') }}><a
                                                            href="{{{ URL::to('userNgo/create') }}}">{{{ Lang::get('site.ngo') }}}</a>
                                                </li>
                                                <li {{ (Request::is('company/create') ? ' class="active"' : '') }}><a
                                                            href="{{{ URL::to('userCompany/create') }}}">{{{ Lang::get('site.company') }}}</a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li {{ (Request::is('user/login') ? ' class="active"' : '') }}><a
                                                    href="{{{ URL::to('user/login') }}}">{{{ Lang::get('site.login') }}}</a></li>
                                    @endif
                                </ul>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<!-- Container -->
<div class="container">
    <!-- Notifications -->
    @include('notifications')
    <!-- ./ notifications -->

    <!-- Content -->
    @yield('content')
    <!-- ./ content -->
</div>
<!-- ./ container -->

<!-- the following div is needed to make a sticky footer -->
<div id="push"></div>
<div id="footerInnerSeparator"></div>
</div>
<!-- ./wrap -->


<div id="footerOuterSeparator"></div>

<div id="divFooter" class="footerArea">
    <link rel="stylesheet" href="{{asset('template/bootstrap/css/mobileFooter.css')}}">

    <div class="container">
        <div class="mobileFooter">

            <div class="divPanel">

                <div class="row-fluid">
                    <div class="span5" id="footerArea2">

                        <h3>{{{ Lang::get('site.activity') }}}</h3>

                        @foreach (Project::orderBy("updated_at","desc")->take(3)->get() as $act)
                        <p>
                            {{ HTML::link('/project/view/'.$act->id , $act->name) }}<br/>
                            <span style="text-transform:none;">{{$act->interval_date()}}</span>
                        </p>
                        @endforeach


                    </div>

                    <div class="span4" id="footerArea4">

                        <h3>{{{ Lang::get('site.contact') }}}</h3>

                        <ul id="contact-info">
                            <li>
                                <i class="general foundicon-phone icon"></i>
                                <span class="field">{{{ Lang::get('site.phone') }}}:</span>
                                <br/>
                                +34 955 32 67 32
                            </li>
                            <li>
                                <i class="general foundicon-mail icon"></i>
                                <span class="field">{{{ Lang::get('site.email') }}}:</span>
                                <br/>
                                <link href="{{URL::to('template/bootstrap/css/hiddenVisibleMobile.css')}}" rel="stylesheet" type="text/css">

                                <div class="hidden-xs">
                                    <a href="mailto:contact@piecebypeace.es" title="Email">contact@piecebypeace.es</a>
                                </div>
                                <div class="visible-xs">
                                     contact@piecebypeace.es
                                </div>
                            </li>
                            <li>
                                <i class="general foundicon-home icon"></i>
                                <span class="field">{{{ Lang::get('site.address') }}}:</span>
                                <br/>
                                Avda. Reina Mercedes s/n, ETSII<br/>
                                {{{ Lang::get('site.physicalAddress') }}}<br/>
                            </li>
                        </ul>

                    </div>

                    <div class="span3" id="footerArea1">

                        <h3>{{{ Lang::get('site.footerAbout') }}}</h3>

                        <p>
                            <a href="{{{ URL::to('about') }}}" title="About">{{{ Lang::get('site.aboutUs') }}}</a><br/>
                            <a href="{{{ URL::to('termsAndConditions') }}}" title="Terms of Use">{{{ Lang::get('site.termsAndConditions') }}}</a><br/>
                            <a href="{{{ URL::to('privacyPolicy') }}}" title="Privacy Policy">{{{ Lang::get('site.privacyPolicy') }}}</a><br/>
                            <a href="{{{ URL::to('faq') }}}" title="FAQ">FAQ</a><br/>
                            <a href="{{{ URL::to('project/futureVolunteeringProjects') }}}" title="V_proyects">{{{ Lang::get('site.volunteeringProjects') }}}</a><br/>
                            <a href="{{{ URL::to('project/futureCSRProjects') }}}" title="CSR_proyects">{{{ Lang::get('site.csrProjects') }}}</a><br/>
                        </p>

                    </div>
                </div>

                <br/><br/>

                <div class="row-fluid">
                    <div class="span12">
                        <p class="copyright">
                            {{{ Lang::get('site.footerCopyright') }}}
                        </p>

                        <p class="social_bookmarks">
                            <a href="https://www.facebook.com/thisispiecebypeace" target="_blank"><i class="social foundicon-facebook"></i> Facebook</a>
                            <a href="https://twitter.com/piecebypeace" target="_blank"><i class="social foundicon-twitter"></i> Twitter</a>

                        </p>
                        <p>
                        <a href="{{{ URL::to('change-language').'/es_ES' }}}">ES</a>|<a href="{{{ URL::to('change-language').'/en' }}}">EN</a>
                        </p>
                    </div>
                </div>
                <br/>

            </div>

    </div>

    </div>
</div>


<!-- Javascripts
================================================== -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('template/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('template/default.js')}}" type="text/javascript"></script>


@yield("js")

</body>
</html>
