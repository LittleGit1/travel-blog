@extends('layout')

@section('header')
    <x-dashboard-header>
        <ul>
            <li>
                <a href="/blog/posts/create" class="bg-gray-50 hover:bg-gray-200 rounded-md px-4 py-3 inline-block">Create
                    Post</a>
            </li>
        </ul>
    </x-dashboard-header>
@endsection

@section('content')
    <div class="flex flex-col gap-4 mx-auto max-w-[50%]">
        <h1 class="text-3xl mt-8 mb-2">Your personal details</h1>

        @dump($errors)
        <div class="bg-white rounded-xl p-4 self-start">
            <div class="flex gap-x-2 mb-4">
                <x-svg-icon icon_name="image_thumbnail" />
                <span>Avatar</span>
            </div>

            <form x-data="profileAvatar" id="profileAvatar" enctype="multipart/form-data" action="/account/profile/avatar"
                method="POST" class="m-0">
                @csrf
                @method('PATCH')
                <label class="inline-block relative group cursor-pointer" for="profile_avatar">
                    @if (Auth::user()->avatar)
                        <img id="featured_image_display" src="{{ Storage::url(Auth::user()->avatar) }}" width="256px"
                            height="256px" alt="" class="w-64 h-64 object-cover">
                    @else
                        <img id="featured_image_display" src="{{ Storage::url('public/img/placeholder.png') }}"
                            width="256px" height="256px" alt="" class="w-64 h-64 object-cover">
                    @endif
                    <span
                        class="w-full min-w-full min-h-full h-full absolute top-0 left-0 items-center bg-[rgba(0,0,0,0.6)] opacity-0 justify-center flex transition-[opacity] duration-300 group-hover:opacity-[0.6]"><x-svg-icon
                            icon_name="image_thumbnail" size="size-10" stroke_color="white" /></span>
                </label>
                <input @change="onChangeProfileAvatar" id="profile_avatar" name="profile_avatar" type="file"
                    class="absolute -z-1 w-[0.1] h-[0.1] opacity-0 overflow-hidden">
            </form>


        </div>

        <div class="bg-white rounded-xl p-4 inline-flex flex-col flex-none">
            <div class="flex justify-between">
                <div class="flex gap-x-2 mb-4">
                    <x-svg-icon icon_name="user_circle" />
                    <span>Name</span>
                </div>
                <a class="underline text-red-400 font-medium" href="/account/profile/edit">Edit</a>
            </div>
            <span>{{ $user->name }}</span>
        </div>

        <div class="bg-white rounded-xl p-4 inline-flex flex-col flex-none">
            <div class="flex justify-between">
                <div class="flex gap-x-2 mb-4">
                    <x-svg-icon icon_name="check_badge" />
                    <span>Username</span>
                </div>
            </div>
            <span>{{ $user->username }}</span>
        </div>

        <div class="bg-white rounded-xl p-4 inline-flex flex-col flex-none">
            <div class="flex justify-between">
                <div class="flex gap-x-2 mb-4">
                    <x-svg-icon icon_name="email" />
                    <span>Email</span>
                </div>
                <a class="underline text-red-400 font-medium" href="/account/profile/edit">Edit</a>
            </div>
            <span>{{ $user->email }}</span>
        </div>

        <h3 class="text-3xl my-4">Account Settings</h3>

        <div class="flex flex-col gap-4">
            <x-button href="/account/password" htmlElement="anchor" backgroundColor="bg-gray-100" color="text-black">Change
                password</x-button>

            <form x-data="closeAccount" action="/account/delete" method="POST">
                @csrf
                @method('DELETE')
                <x-button type="submit">Close account</x-button>
            </form>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('closeAccount', () => ({
            createConfirmPopup(event) {
                alert("hello");
                //event.target.submit();
            }
        }));

        Alpine.data('profileAvatar', () => ({
            form: undefined,

            init() {
                this.form = document.getElementById('profileAvatar');
            },
            onChangeProfileAvatar(event) {
                if (!event.srcElement.files.length > 0) return;
                this.form.submit();
            }
        }));
    })
</script>
