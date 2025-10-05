<div>
     @if(session('success'))
        <p style="color: green">{{session('success')}}</p>
    @endif
    @if(session('error'))
        <p style="color: red">{{ session('error') }}</p>
    @endif
    @if($errors->any())
            <ul>
                @foreach($errors->all() as $error)
                    <li style='color: red'>{{ $error }}</li>
                @endforeach
            </ul>
    @endif
</div>