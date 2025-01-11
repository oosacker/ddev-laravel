<h2>Job Title: {{ $job->title }}</h2>

<p>Your job has been posted successfully.</p>

<p>View your job <a href="{{ url('/jobs/' . $job->id) }}">here</a></p>