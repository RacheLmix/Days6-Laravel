@component('mail::message')
# New Comment on Your Post

Your post **{{ $post->title }}** has received a new comment from **{{ $comment->user->name }}**.

**Comment:**
{{ $comment->content }}

@component('mail::button', ['url' => url('/posts/'.$post->id)])
View Post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent