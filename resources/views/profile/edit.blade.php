@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="mb-4 text-center">
                                <div class="profile-picture-container mb-3">
                                    <div class="position-relative d-inline-block">
                                        <div class="profile-picture-wrapper">
                                            <img src="{{ Auth::user()->profile_picture ?? '/images/default-avatar.png' }}"
                                                alt="Profile Picture" class="profile-picture">
                                            <div class="profile-picture-overlay">
                                                <span>Update Photo</span>
                                            </div>
                                        </div>
                                        <input type="file" class="profile-picture-input" id="profile_picture"
                                            name="profile_picture" accept="image/*">
                                    </div>
                                </div>
                                @error('profile_picture')
                                    <span class="text-danger d-block mt-2">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', Auth::user()->name) }}" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}"
                                    readonly disabled>
                                <small class="text-muted">Email cannot be changed</small>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">New Password (leave blank to keep current)</label>
                                <input type="password" class="form-control" id="password" name="password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation">
                            </div>

                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password (required to save
                                    changes)</label>
                                <input type="password" class="form-control" id="current_password" name="current_password">
                                @error('current_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .profile-picture-wrapper {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            position: relative;
            cursor: pointer;
            border: 3px solid var(--accent-color, #ff7043);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .profile-picture-wrapper:hover {
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .profile-picture {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .profile-picture-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            color: white;
            font-weight: 600;
        }

        .profile-picture-wrapper:hover .profile-picture-overlay {
            opacity: 1;
        }

        .profile-picture-wrapper:hover .profile-picture {
            transform: scale(1.1);
        }

        .profile-picture-input {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
            z-index: 10;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const profilePictureInput = document.getElementById('profile_picture');
            const profilePicture = document.querySelector('.profile-picture');

            profilePictureInput.addEventListener('change', function (e) {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        profilePicture.src = e.target.result;
                    }

                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>
@endsection