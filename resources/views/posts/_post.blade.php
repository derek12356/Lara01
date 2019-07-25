<li class="media mt-4 mb-4">
  @can('view', $user)
  <a href="{{ route('users.show', $user->id )}}">
    <img src="{{ $user->gravatar() }}" alt="{{ $user->name }}" class="mr-3 gravatar"/>
  </a>
  <div class="media-body">
    <h5 class="mt-0 mb-1">{{ $user->name }} <small> / {{ $post->created_at->diffForHumans() }}</small></h5>
    {{ $post->content }}
  </div>
  @endcan
  @can('destroy', $post)
  <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete.');">
  	@csrf
  	{{ method_field('DELETE') }}
  	<button type="submit" class="btn btn-sm btn-danger">Delete</button>
  </form>
  @endcan
</li>