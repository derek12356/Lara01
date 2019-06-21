@if ($feed_items->count() > 0)
  <ul class="list-unstyled">
    @foreach ($feed_items as $post)
      @include('posts._post',  ['user' => $post->user])
    @endforeach
  </ul>
  <div class="mt-5">
    {!! $feed_items->render() !!}
  </div>
@else
  <p>no data！</p>
@endif