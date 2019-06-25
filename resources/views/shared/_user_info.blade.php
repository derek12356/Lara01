<div class="text-center">
<a href="{{ route('users.show', $user->id) }}">
  <img src="{{ $user->gravatar('140') }}" alt="{{ $user->name }}" class="gravatar mr-2"/>
</a>
<h4 class='mt-2'>{{ $user->name }}</h4>
</div>
<div class="stats">
	<a href="#">
	  <strong id="following" >
	    {{ count($user->followings) }}
	  </strong>
	  Following
	</a>
	<a href="#">
	  <strong id="followers">
	    {{ count($user->followers) }}
	  </strong>
	  Followers
	</a>
	<a href="#">
	  <strong id="statuses">
	    {{ $user->posts()->count() }}
	  </strong>
	  Posts
	</a>
</div>
