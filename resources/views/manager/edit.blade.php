@extends('layouts.master')

@section('title') @lang('translation.Starter_Page') @endsection

@section('content')
@component('components.breadcrumb')
@slot('li_1') Manager @endslot
@slot('title') Edit Manager @endslot
@endcomponent

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                {{-- <h4 class="card-title">Meta Data</h4>
                    <p class="card-title-desc">Fill all information below</p> --}}
                <form method="POST" action="{{route('manager.update', ['id' => $user->id])}}">
                    @csrf
                    <input type="hidden" name="edit" value="{{$user->id}}">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="username">Name</label>
                                <input id="name" name="name" type="text" value="{{old('name', $user->name)}}" class="form-control" placeholder="Name">
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="text" value="{{old('email', $user->email)}}" class="form-control" placeholder="Email">
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="company">India Number</label>
                                <input id="mobile" name="mobile" type="text" value="{{old('mobile', $user->mobile)}}" class="form-control" placeholder="mobile">
                                @error('mobile')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="company">USA Number</label>
                                <input id="usa_number" name="usa_number" type="text" value="{{old('usa_number', $user->usa_number)}}" class="form-control" placeholder="Usa Number">
                                @error('usa_number')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                        <a href="{{route('manager.index')}}" class="btn btn-secondary waves-effect waves-light">Cancel</a>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection
