@component('mail::message')
# {{ $liker->name }} Liked your Post!

@component('mail::button', ['url' => route('posts.show', $post)])
View Post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
