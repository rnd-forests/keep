<strong>Hi <span style="color:#2ab27b;">{{ $username }}</span>, you have an upcoming task at Keep, please check it out.</strong>
<hr/>
<h3>{{ $taskTitle }}</h3>
<blockquote><em>{{ $taskContent }}</em></blockquote>
<hr/>
<h4><strong>{{ $remainingDays }}</strong></h4>
<h4>From <strong>{{ $startingDate }}</strong> to <strong>{{ $finishingDate }}</strong></h4>
<hr/>
<h4>View this task on Keep using the link below.</h4>
<a href="{{ $taskUrl }}">{{ $taskUrl }}</a>