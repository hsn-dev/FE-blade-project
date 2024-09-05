@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-3">Profile Listing</h1>
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="row mt-3 mb-3">
            <div class="col-md-4">
                <input type="text" id="search" class="form-control" placeholder="Search by name...">
            </div>
            <div class="col-md-4">
                <select id="genderFilter" class="form-control">
                    <option value="">All</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
        </div>
        <div id="error_msg" class="alert alert-danger d-none"></div>
        <div id="user-list" class="row"></div>
        {{-- <nav>
            <ul class="pagination" id="pagination"></ul>
        </nav> --}}
        <div class="d-flex justify-content-between mb-5">
            <button id="prevBtn" class="btn btn-dark">Previous</button>
            <button id="nextBtn" class="btn btn-dark">Next</button>
        </div>
    </div>
@endsection

@push('styles')
    
@endpush

@push('scripts')
<script>
$(document).ready(function() {

    let currentPage = 1;
    let lastPageReached = false;

    function fetchUsers(page = 1) {
        const gender = $('#genderFilter').val();
        const search = $('#search').val();
        
        $.ajax({
            url: "{{ route('users.fetch') }}",
            data: { gender, page, search },
            success: function(res) {
                const users = res.data
                let userHtml = '';

                if (lastPageReached && users.length > 0) {
                    lastPageReached = false;
                    $('#nextBtn').prop('disabled', false);
                    $('#error_msg').addClass('d-none');
                }

                if(users.length === 0) {
                    $('#error_msg').html('No users found').removeClass('d-none');
                }
                else {
                    $('#error_msg').addClass('d-none');
                }

                users.forEach(user => {
                    userHtml += `<div class="col-md-4">
                                    <div class="card shadow mb-4">
                                        <div class="card-body text-center">
                                            <img src="${user.picture.large}" class="img-thumbnail rounded-circle mb-3" alt="user_image">
                                            <h5 class="card-title">${user.name.first} ${user.name.last}</h5>
                                            <p class="card-text">
                                                <b>Email:</b> ${user.email} <br>
                                                <b>Phone:</b> ${user.phone} <br>
                                                <b>Age:</b> ${user.dob.age} years <br>
                                                <b>Nationality:</b> ${user.nat} <br>
                                            </p>
                                            <a href="/profiles/${user.login.uuid}" class="btn btn-outline-dark">View Profile</a>
                                        </div>
                                    </div>
                                </div>`;
                });
                $('#user-list').html(userHtml);

                // Disable Previous button on the first page
                if (page === 1) {
                    $('#prevBtn').prop('disabled', true);
                } else {
                    $('#prevBtn').prop('disabled', false);
                }
            },
            error: function(e) {
                let res = e.responseJSON;
                if (res.data.length === 0) {
                    lastPageReached = true;
                    $('#nextBtn').prop('disabled', true);
                    $('#error_msg').html(res.message).removeClass('d-none');
                    $("#user-list").html('');
                }
            }
        });
    }

    // Initial load
    fetchUsers();

    // Handle Next button click
    $('#nextBtn').click(function() {
        if (!lastPageReached) {
            currentPage += 1
            console.log("N: current_page", currentPage);
            fetchUsers(currentPage);
        }
    });

     // Handle Previous button click
     $('#prevBtn').click(function() {
        if (currentPage > 1) {
            currentPage -= 1;
            console.log("P: current_page", currentPage);
            fetchUsers(currentPage);
        }
    });

    // Handle filter change
    $('#genderFilter').change(function() {
        currentPage = 1;
        fetchUsers(currentPage);
    });

    // Handle search input
    $('#search').blur(function() {
        currentPage = 1;
        fetchUsers(currentPage);
    });
});
</script>
@endpush