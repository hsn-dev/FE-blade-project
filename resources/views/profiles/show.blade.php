@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-3 mb-3 w-75 mx-auto">
        <div class="card-header">
            Profile
          </div>
        <div class="card-body">
            <img src="{{ $user['picture']['large'] }}" class="img-thumbnail mb-3 mx-auto d-block" alt="profile_pic">
            <h5 class="card-title text-center">{{ $user['name']['first'] }} {{ $user['name']['last'] }}</h5>
          <p class="card-text">
            <ul class="list-group w-75 mx-auto">
                <li class="list-group-item">
                    <b>Username:</b>
                    <span class="float-end">{{ $user['login']['username'] }}</span>
                </li>
                <li class="list-group-item">
                    <b>Email:</b>
                    <span class="float-end">{{ $user['email'] }}</span>
                </li>
                <li class="list-group-item">
                    <b>Gender:</b>
                    <span class="float-end">{{ $user['gender'] }}</span>
                </li>
                <li class="list-group-item">
                    <b>Age:</b>
                    <span class="float-end">{{ $user['dob']['age'] }} years</span>
                </li>
                <li class="list-group-item">
                    <b>Phone:</b>
                    <span class="float-end"> {{ $user['phone'] }}</span>
                </li>
                <li class="list-group-item">
                    <b>Cell:</b>
                    <span class="float-end">{{ $user['cell'] }}</span>
                </li>
                <li class="list-group-item">
                    <b>Nationality:</b>
                    <span class="float-end">{{ $user['nat'] }}</span>
                </li>
                <li class="list-group-item">
                    <b>Location:</b>
                    <span class="float-end">{{ $user['location']['city'] }}, {{ $user['location']['state'] }}, {{ $user['location']['country'] }}</span>
                </li>
                <li class="list-group-item">
                    <b>Postal Code:</b>
                    <span class="float-end">{{ $user['location']['postcode'] }}</span>
                </li>
                <li class="list-group-item">
                    <b>Lat / Long:</b>
                    <span class="float-end">{{ $user['location']['coordinates']['latitude'] }}, {{ $user['location']['coordinates']['longitude'] }}</span>
                </li>
                <li class="list-group-item">
                    <b>Timezone:</b>
                    <span class="float-end">{{ $user['location']['timezone']['description'] }}</span>
                </li>
                <li class="list-group-item">
                    <b>Timezone Offset:</b>
                    <span class="float-end">{{ $user['location']['timezone']['offset'] }}</span>
                </li>
                
              </ul>
          </p>
        </div>
      </div>
</div>
@endsection

@push('styles')
    
@endpush

@push('scripts')
<script>
$(document).ready(function() {

});
</script>
@endpush