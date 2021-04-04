
@include('layouts/head')

    <div class="container" x-data="{ rightSide: false, leftSide: false }">
        <div class="left-side" :class="{'active' : leftSide}">
            <div class="left-side-button" @click="leftSide = !leftSide">
            <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
            <svg stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            </div>
            <div class="side-wrapper">
                <div class="logo">
                    <a href="{{route('dashboard')}}">
                    <img src="{{asset('images/recru-it-logo-blanco.png')}}" alt="">
                    </a>
                </div>
                <div class="side-menu">
                    <a href="{{route('dashboard')}}">
                        <span><i class="fa fa-users" style="font-size:20px;margin-right:10px;"></i>Candidates</span>
                    </a>
                    <a id="scheduled-interviews" href="{{route('scheduled-interviews')}}">
                        <i class="fa fa-clock-o" style="font-size:23px;margin-right:10px;"></i> Scheduled Interviews
                        @if($candidates_scheduled_count)
                            <span>
                                {{$candidates_scheduled_count}}
                            </span>
                        @endif
                    </a>
                </div>
            </div>
            <div class="side-wrapper">
            <div class="side-title">BEST CANDIDATES</div>
                <div id="best-candidates">
                    @if($bestcandidates)
                        <div id="best-candidates">
                            @foreach ($bestcandidates as $bestcandidate)
                            <a href="{{route('candidate-profile-show', $bestcandidate->id)}}">
                                <div class="best-candidate">
                                <img src="{{asset($bestcandidate->profile_pic_url)}}" alt="" class="best-candidate-img">
                                <div class="username">{{$bestcandidate->fullname}}
                                    <div class="position">{{$bestcandidate->position}}</div>
                                </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    @else
                        <span style="color:#fff;"> Visit a candidate profile and click the "Mark as best candidate" button to add your first Best Candidate !</span>
                    @endif
                </div>
            </div>
        </div>
        <!-- END SIDE NAVIGATION -->
        <div class="main">
            <!-- Topnav -->
            <nav id="user-bar" class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div id="download-app-container" class="mb-0 text-sm font-weight-bold"> 
                        <span> Make sure you have RECRU-IT installed in your phone! </span>
                        <a id="install_button" class="appbutton"><i class="fa fa-download"></i> Download the App </a>
                    </div>
                    <ul id="user-info" class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                        <li class="nav-item dropdown">
                        <div class="media align-items-center">
                            <div class="media-body ml-2 d-none d-lg-block">
                            <a id="log-out-link" style="color:#fff !important;" href="{{url('/logout')}}">
                                Logout
                            </a>
                            </div>
                        </div>
                        </li>
                    </ul>
                    </div>
                </div>
            </nav>
            <!-- Header -->
            <div class="main-container">

        @yield('main-content')
   
    </div>
    <!-- END CONTAINER -->
   


<!-- START FOOTER -->
<script src="{!! asset('js/simplepicker.js') !!}"></script>
<script src="{!! asset('js/main.js') !!}"></script>

<script>
	function addBestCandidate(idUser){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            }
        });
        $.ajax({
			type: 'POST',
			url: '/best-candidate/add/'+idUser,
			data:{id: idUser},
			success:function(result){
                console.log(result);
				$("#add-as-best-candidate-button").css("display", "none");
				$("#remove-as-best-candidate-button").css("display", "block");
                location.reload();
			}
		});
		var current_url = document.URL;
		$(location).attr('href', current_url);
	};

	function removeBestCandidate(idUser){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            }
        });
        $.ajax({
			type: 'POST',
			url: '/best-candidate/remove/'+idUser,
			data:{id: idUser},
			success:function(result){
                console.log(result);
				$("#add-as-best-candidate-button").css("display", "none");
				$("#remove-as-best-candidate-button").css("display", "block");
                location.reload();
			}
		});
		var current_url = document.URL;
		$(location).attr('href', current_url);
	};
</script>

<script>
    let simplepicker = new SimplePicker({
        zIndex: 10
    });

    $("#schedule-interview-button").on('click', function(){

        simplepicker.open();
        const $button = document.querySelector('button');
        const $eventLog = document.querySelector('.event-log');
        $button.addEventListener('click', (e) => {
            simplepicker.open();
        });

        // $eventLog.innerHTML += '\n\n';
        simplepicker.on('submit', (date, readableDate) => {
            $eventLog.innerHTML = readableDate + '\n';
        });

    });

    $("#update-candidate-button").on('click', function(){
        $("#loader-1").css('display','inline');
    });

    $('.redo').click(function() {
        $('.success').toggle();
    });

    $('.left-side-button').on('click', function() {
        $this = $(this);
        $nav = $('.left-side');  
        $nav.toggleClass('active');
    });
</script>
<!-- END FOOTER -->

</body>
</html>
