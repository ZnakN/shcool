<p>Please confirm registration</p>
<p>
  <a href="{!! URL::to('/') . '/activate/' . $user->register_token !!}">{!! $user->register_token !!}</a>
</p>