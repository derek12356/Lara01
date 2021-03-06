<div class="text-center">
<a href="{{ route('users.show', $user->id) }}">
  <img src="{{ $user->gravatar('140') }}" alt="{{ $user->name }}" class="gravatar mr-2"/>
</a>
<h4 class='mt-2'>{{ $user->name }}</h4>

</div>
<div class="stats">
	@can('view',$user)
	<a href="{{ route('users.followings', $user->id )}}">
	  <strong id="following" >
	    {{ count($user->followings) }}
	  </strong>
	  Following
	</a>
	<a href="{{ route('users.followers', $user->id )}}">
	  <strong id="followers">
	    {{ count($user->followers) }}
	  </strong>
	  Followers
	</a>
	<a href="{{ route('users.show', $user->id )}}">
	  <strong id="posts">
	    {{ $user->posts()->count() }}
	  </strong>
	  Posts
	</a>
	@else
	<a>
	  <strong id="following" >
	    {{ count($user->followings) }}
	  </strong>
	  Following
	</a>
	<a>
	  <strong id="followers">
	    {{ count($user->followers) }}
	  </strong>
	  Followers
	</a>
	<a>
	  <strong id="posts">
	    {{ $user->posts()->count() }}
	  </strong>
	  Posts
	</a>
	@endcan

</div>
