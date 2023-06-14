@extends('layouts.app')

@section('title')
    Role test
@endsection

@section('document')

    <form action="{{ route('role.store') }}" method="post" class="p-5">

        @csrf

        <div class="">

            <input type="text" placeholder="Role name" name="name" id="" class="p-4 border" autocomplete="off">

        </div>

        <div class="my-5">

            <header>Permissions</header>

            @foreach ($resources as $resource)

                <div class="my-2 flex">

                    <div class="mr-5">{{ $resource->slug }}</div>

                    <div class="flex">

                        @foreach ($resource->permissions as $permission)

                            <div class="">

                                <span>{{ $permission->operation->name }}</span>

                                <input type="checkbox" name="{{ $permission->operation->name }}[]" value="{{ $permission->id }}" id="">

                            </div>

                        @endforeach

                    </div>

                </div>

            @endforeach

        </div>

        <div class="my-4">

            <button type="submit" class="bg-blue-800 text-white p-2">Submit</button>

        </div>

    </form>

@endsection
