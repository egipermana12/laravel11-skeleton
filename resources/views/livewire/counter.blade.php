<div>
    {{ $count }}
    {{auth()->user()->roles}}
    {{auth()->user()->hasRole('admin')}}
    {{auth()->guard('web')->user()->getRoleNames()}}
</div>
