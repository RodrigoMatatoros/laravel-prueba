<div>
     @if(session('success'))
        <p style="color: green">{{session('success')}}</p>
    @endif
    @if(session('error'))
        <p style="color: red">{{ session('error') }}</p>
    @endif
</div>