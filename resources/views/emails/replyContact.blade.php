@component('mail::message')
# Replying To Your Message ( {{$contact->subject}} )

{!! $contact->re_message !!}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
