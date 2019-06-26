@can('follow', $user)

	<div class="text-center mt-2 mb-4">
		@if(Auth::user()->isFollowing($user->id))
			<form action="{{ route('followers.destroy', $user->id) }}" method="post">
				@csrf
				@method('delete')
				<button type="submit" class="btn btn-sm btn-outline-primary">Unfollow</button>
			</form>
		@else
		<form action="{{ route('followers.store', $user->id) }}" method="post">
			@csrf
			<button type="submit" class="btn btn-sm btn-primary">Follow</button>
		</form>
		@endif
	</div>
@endcan
