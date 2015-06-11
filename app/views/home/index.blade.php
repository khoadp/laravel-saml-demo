<p>
    Hello,@if(Auth::check()){{Auth::user()->first_name , ' ', Auth::user()->last_name}}@endif
</p>