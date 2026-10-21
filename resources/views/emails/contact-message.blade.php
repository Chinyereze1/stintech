<p>You've got a new message from your Stintech contact form.</p>

<p>
    <strong>Name:</strong> {{ $contactMessage->name }}<br>
    <strong>Email:</strong> {{ $contactMessage->email }}<br>
    @if($contactMessage->subject)
        <strong>Subject:</strong> {{ $contactMessage->subject }}<br>
    @endif
</p>

<p>{{ $contactMessage->message }}</p>

<p>
    <a href="{{ url('/austin-control/contact-messages') }}">View in austin-control</a>
</p>
