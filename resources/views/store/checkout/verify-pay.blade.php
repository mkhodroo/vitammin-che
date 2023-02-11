@extends('layouts.app')

@section('content')
<section class="page-section">
    @if(isset($message))
    <div class="alert alert-success">
         {{ $message }}
    </div>
    @endif
    @if(isset($error))
    <div class="alert alert-danger">
         {{ $error }}
    </div>
    @endif
</section>
    
@endsection