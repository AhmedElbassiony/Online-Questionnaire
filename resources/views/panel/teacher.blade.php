@extends('layouts.app')
@section('title', 'Quiz Dashboard - TeckQuiz')
@section('content')
<style>
    main{
        padding-top: 2.5rem;
    }
</style>
<main>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" id="v-pills-dashboard" data-toggle="pill" href="#dashboard" role="tab" aria-controls="v-pills-dashboard"
                            aria-expanded="true">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $classes->count() == 0 ? 'disabled' : '' }}" id="v-pills-home-tab" data-toggle="pill" href="#quiz-events" role="tab" aria-controls="v-pills-home"
                            aria-expanded="true">Quiz Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $subjects->count() == 0 ? 'disabled' : '' }} " id="v-pills-profile-tab" data-toggle="pill" href="#my-classes" role="tab" aria-controls="v-pills-profile"
                            aria-expanded="true">My Classes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#settings" role="tab" aria-controls="v-pills-settings"
                            aria-expanded="true">Settings</a>
                    </li>
                </ul>
            </nav>

            <main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
                <div class="tab-content container" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="dashboard">
                        <h1 class="align-left">Dashboard</h1><hr>
                        <div class="row">
                            <div class="col-lg-3 col-sm-12 pb-3">
                                <div class="card text-white bg-primary">
                                    <div class="card-body">
                                        <h1 class="align-left display-4">{{ $quiz_events->count() }}</h1>
                                        <p class="lead align-left">Quizzes on queue</p>
                                    </div>
                                    <a class="card-footer text-white clearfix small z-1 align-left" href="">View quizzes</a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12 pb-3">
                                <div class="card text-white bg-secondary">
                                    <div class="card-body">
                                        <h1 class="align-left display-4">{{ $finished_quiz_events->count() }}</h1>
                                        <p class="lead align-left">Quizzes finished</p>
                                    </div>
                                    <a class="card-footer text-white clearfix small z-1 align-left" href="">View quizzes</a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12 pb-3">
                                <div class="card text-white bg-info">
                                    <div class="card-body">
                                        <h1 class="align-left display-4" >{{ $classes->count() }}</h1>
                                        <p class="lead align-left">Classes</p>
                                    </div>
                                    <a class="card-footer text-white clearfix small z-1 align-left" href="">View subjects</a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12 pb-3">
                                <div class="card text-white bg-success">
                                    <div class="card-body">
                                        <h1 class="align-left display-4" >{{ $subjects->count() }}</h1>
                                        <p class="lead align-left">Subjects</p>
                                    </div>
                                    <a class="card-footer text-white clearfix small z-1 align-left" href="">View subjects</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade {{ $classes->count() == 0 ? '' : '' }}" id="quiz-events" role="tabpanel" aria-labelledby="quiz-events">
                        <h1 class="text-left">Quiz Events</h1>
                        <div class="col-10">
                            <h4>Current Quizzes</h4>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Topic</th>
                                        <th>Subject</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($quiz_events as $qe)
                                        <tr id="quiz_entry{{ $qe->quiz_event_id }}">
                                            <td><a href="/quiz/{{ $qe->quiz_event_id }}">{{ $qe->quiz_event_name }}</a></td>
                                            <td>{{ $qe->classe->subject->subject_desc }}</td>
                                            <td>{{ $qe->classe->course_sec}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if(count($finished_quiz_events) >= 1)
                            <div class="col-10">
                                <h4>Past Quizzes</h4>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Topic</th>
                                            <th>Subject</th>
                                            <th>Class</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($finished_quiz_events as $qe)
                                            <tr>
                                                <td><a href="/quiz/{{ $qe->quiz_event_id }}">{{ $qe->quiz_event_name }}</a></td>
                                                <td>{{ $qe->classe->subject->subject_desc }}</td>
                                                <td>{{ $qe->classe->course_sec}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        {{--  <button class="btn btn-primary" data-toggle="modal" data-target="#NewQuizEventModal">New quiz event</button>  --}}
                        <a class="btn btn-primary" href="/quiz/create">New quiz event</a>
                    </div>

                    <div class="tab-pane fade {{ $classes->count() == 0 ? '' : '' }}" id="my-classes" role="tabpanel" aria-labelledby="my-classes"><!-- Manage Class -->
                        <!-- Fetch instructor's subjects -->
                        <h1>My Classes</h1>
                        <div class="row">
                            <!-- Class entry -->
                            @foreach ($classes as $classe)
                                <div class="col-xl-3 col-sm-6 mb-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">{{ $classe->subject->subject_code }}: {{ $classe->subject->subject_desc }}</h4>
                                            <h6 class="card-subtitle mb-2 text-muted">{{ $classe->course_sec }}</h6>
                                            <h3 class="text-center">{{ $classe->class_id }}</h3>
                                        </div>
                                        <a href="/class/{{ $classe->class_id }}" class="card-footer text-center">View Class</a>
                                    </div>
                                </div>
                            @endforeach
                            
                        </div>
                        <div class="col">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#NewClassModal">New class</button>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings">
                        <h3>Advanced Settings</h3>
                            <div class="card" style="width: 40rem;">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#changePassword" style="float: right">Change password</button>
                                        <strong>Change password</strong>
                                        <p>This will allow you to change your password.</p>
                                    </li>
                                </ul>
                            </div>
                    </div>

                </div>
            </main>
            
        </div>
    </div>
</main>

<!-- New Quiz Modal -->
<div class="modal fade" id="NewQuizEventModal" tabindex="-1" role="dialog" aria-labelledby="NewQuizEventModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content form" action="/new/quiz" method="POST">
            {{ csrf_field() }}
            <div class="modal-header">
                <h5 class="modal-title" id="ModalTitle">New Quiz Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Quiz Name</label>
                    <input name="quiz_name" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Class</label>
                    <select name="class_id" id="class_id" class="form-control">
                        @foreach ($classes as $classe)
                        <option value="{{ $classe->class_id }}">{{ $classe->subject->subject_desc }} ({{ $classe->course_sec }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Questions</label>
                    <input name="questions" type="number" min="1" class="form-control">
                </div>
                <!-- TODO: Time limit -->
                <div class="form-group">
                    <label for="">Questionnaire to use</label>
                    <select name="questionnaire" id="questionnaire" class="form-control">
                        <option value="1">Create new questionnaire</option>
                        <option value="2">Use existing questionnaire</option>
                    </select>
                </div>
                <input type="hidden" name="valid" value="1">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Next</button>
            </div>
        </form>
    </div>
</div>

<!-- New Class Modal -->
<div class="modal fade" id="NewClassModal" tabindex="-1" role="dialog" aria-labelledby="NewClassModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content form" action="/class" method="POST">
            {{ csrf_field() }}
            <div class="modal-header">
                <h5 class="modal-title" id="ModalTitle">New Class</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Class Name</label>
                    <input name="course_sec" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Subject</label>
                    <select name="sub_id" id="" class="form-control">
                        @foreach($subjects as $s)
                        <option value="{{ $s->subject_id }}">{{$s->subject_code}}: {{$s->subject_desc}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

<!-- Change password modal -->
<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="changePassword" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Current password</label>
                    <input id="pwd" type="password" class="form-control">
                    <div class="invalid-feedback">
                        Input your correct password.
                    </div>
                </div>
                <div class="form-group">
                    <label for="">New password</label>
                    <input id="pwd_new" type="password" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="changePassword()">Change password</button>
            </div>
        </div>
    </div>
</div>

<!-- Change password Success Modal -->
<div class="modal fade" id="changePasswordSuccess" tabindex="-1" role="dialog" aria-labelledby="changePasswordSuccess"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Success!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Password changed successfully!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function changePassword(){
        var oldPass = $('#pwd').val();
        var newPass = $('#pwd_new').val();
        var update_type = 0;

         $.ajax({
            url: '/account/' + {{Auth::id()}},
            type: 'PUT', //type is any HTTP method
            data: {
                update_type, oldPass, newPass
            }, //Data as js object
            success: function () {
                $('#changePassword').modal('hide')
                $('#changePasswordSuccess').modal('show')
            },
            error: function(data){
                $('#pwd').addClass('is-invalid');
            }
        });
    }
    function goToQuizPanel(){
        $('.nav-item a[href="#quiz-events"]').tab('show');
    }
    
</script>

@endsection