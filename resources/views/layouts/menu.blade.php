
        <li class="header">Main</li>

        <li><a href="{{ route('welcome') }}"><i class="fa fa-star"></i> <span>Welcome</span></a></li>

        <li class="treeview">
            <a href="#"><i class="fa fa-tasks"></i> <span>Generate</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
            <li><a href="{{ route('generator', ['type'=>'final']) }}">Final</a></li>
            <li><a href="{{ route('generator', ['type'=>'midterm']) }}">Mid-Term</a></li>
            <li><a href="{{ route('generator', ['type'=>'quiz']) }}">Quiz</a></li>
            <li><a href="{{ route('generator', ['type'=>'assignment']) }}">Assignment</a></li>
            </ul>
        </li>


<li><a href="{{ route('ilos') }}"><i class="fa fa-star"></i> <span>Question ILOs</span></a></li>


<li class="{{ Request::is('questionTypes*') ? 'active' : '' }}">
    <a href="{!! route('questionTypes.index') !!}"><i class="fa fa-edit"></i><span>Question Types</span></a>
</li>

<li class="{{ Request::is('subjects*') ? 'active' : '' }}">
    <a href="{!! route('subjects.index') !!}"><i class="fa fa-edit"></i><span>Subjects</span></a>
</li>

<li class="{{ Request::is('topics*') ? 'active' : '' }}">
    <a href="{!! route('topics.index') !!}"><i class="fa fa-edit"></i><span>Topics</span></a>
</li>

<li class="{{ Request::is('exams*') ? 'active' : '' }}">
    <a href="{!! route('exams.index') !!}"><i class="fa fa-edit"></i><span>Exams</span></a>
</li>

<li class="{{ Request::is('questions*') ? 'active' : '' }}">
    <a href="{!! route('questions.index') !!}"><i class="fa fa-edit"></i><span>Questions</span></a>
</li>

<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>Users</span></a>
</li>

<li class="{{ Request::is('roles*') ? 'active' : '' }}">
    <a href="{!! route('roles.index') !!}"><i class="fa fa-edit"></i><span>Roles</span></a>
</li>

