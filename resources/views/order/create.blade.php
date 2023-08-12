@extends('layouts.master')

@section('title')
    Estimate
@endsection
<style>
    .select2-container .select2-selection--multiple .select2-selection__choice {
        padding: 0px !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
        padding-left: 25px !important;
    }
</style>
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
            Estimate
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('order.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-5 p-0">
                                <div class="form-group">
                                    <div class="col-sm-11">
                                        <div class="mb-2">
                                            <label for="brand_name">Buyer name<span class="error">*</span></label>
                                            <input id="buyer_name" name="buyer_name" type="text"
                                                value="{{ old('product_name') }}" class="form-control"
                                                placeholder="Buyer Name">
                                            @error('buyer_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-11">
                                        <div class="mb-2">
                                            <label for="brand_name">Village name<span class="error">*</span></label>
                                            <input id="village_name" name="village_name" type="text"
                                                value="{{ old('village_name') }}" class="form-control"
                                                placeholder="Village Name">
                                            @error('village_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-11">
                                        <div class="mb-2">
                                            <label for="brand_name">Car No<span class="error">*</span></label>
                                            <input id="car_no" name="car_no" type="text"
                                                value="{{ old('car_no') }}" class="form-control"
                                                placeholder="Car Number">
                                            @error('car_no')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-11">
                                        <div class="mb-2">
                                            <label for="brand_name"> Transport name<span class="error">*</span></label>
                                            <input id="transport_name" name="transport_name" type="text"
                                                value="{{ old('transport_name') }}" class="form-control"
                                                placeholder="Car Number">
                                            @error('transport_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 p-0">
                                <div class="form-group">
                                    <div class="col-sm-11">
                                        <div class="mb-2">
                                            <label for="brand_name"> Date<span class="error">*</span></label>
                                            <input id="date" name="date" type="date"
                                                value="{{ old('date') }}" class="form-control"">
                                            @error('date')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-11">
                                        <div class="mb-2">
                                            <label for="brand_name"> Product<span class="error">*</span></label>
                                            <select class="form-select select2" name="product[]" id="product" multiple data-placeholder="Select Product">
                                                <option value="">Select Product</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}"
                                                        {{ $product->id == old('product') ? 'selected' : '' }}>{{ $product->product_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('product')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-11">
                                        <div class="mb-2">

                                            <label for="brand_name">Quantity<span class="error">*</span></label>
                                            <input id="qty" name="qty" type="text" value="{{ old('qty') }}"
                                                class="form-control" placeholder="Quantity" autocomplete="off">
                                            @error('qty')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-11 pt-2">
                                        <div class="text-end">
                                            <button type="submit"
                                                class="btn btn-outline-danger waves-effect waves-light m-2">Save</button>
                                            <a href="{{ route('order.index') }}"
                                                class="btn btn-danger waves-effect waves-light">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="form-group">
                                <div class="col-sm-11">
                                    <div class="mb-2">
                                        <label for="brand_name">Scent Type<span class="error">*</span></label>
                                        <select id="scent_type_id" name="scent_type_id" type="text" class="form-control select2" data-placeholder="Select Scent Type">
                                            @foreach ($scent_types as $scent_type)
                                                <option value="{{$scent_type->id}}" {{old('scent_type_id') == $scent_type->id ? 'selected' : ''}}>{{ $scent_type->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('scent_type_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-5">
                                    <div class="mb-2">
                                        <label for="brand_name">Size<span class="error">*</span></label>
                                        <input id="size" name="size" type="text" value="{{old('size')}}" class="form-control" placeholder="Size">
                                        @error('size')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-2">
                                        <label for="size unit">Size Unit<span class="error">*</span></label>
                                        <select id="size_unit" name="size_unit_id" type="text" class="form-control select2" data-placeholder="Select Unit">
                                            @foreach ($units as $unit)
                                                <option value="{{$unit->id}}" {{old('size_unit_id') == $unit->id ? 'selected' : ''}}>{{ $unit->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('size_unit_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-11">
                                    <div class="mb-2">
                                        <label for="brand_name">Fragrance Tone 1<span class="error">*</span></label>
                                        <select id="fragrance_tone_1" name="fragrance_tone_1_id" class="form-control select2" data-placeholder="Select Fragrance Tone ">
                                            <option value=""></option>
                                            @foreach ($fragrence_tones as $fragrence_tone)
                                                <option value="{{$fragrence_tone->id}}" {{old('fragrance_tone_1_id') == $fragrence_tone->id ? 'selected' : ''}}>{{ $fragrence_tone->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('fragrance_tone_1_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-11">
                                    <div class="mb-2">
                                        <label for="brand_name">Fragrance Tone 2</label>
                                        <select id="fragrance_tone_2" name="fragrance_tone_2_id" class="form-control select2" data-placeholder="Select Fragrance Tone ">
                                            <option value=""></option>
                                            @foreach ($fragrence_tones as $fragrence_tone)
                                                <option value="{{$fragrence_tone->id}}" {{old('fragrance_tone_2_id') == $fragrence_tone->id ? 'selected' : ''}}>{{ $fragrence_tone->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('fragrance_tone_2_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-11">
                                    <div class="mb-2">
                                        <label for="brand_name">Fragrance Top Note<span class="error">*</span></label>
                                        <textarea id="fragrance_top_note" name="fragrance_top_note" class="form-control" placeholder="Fragrance Top Note">{{old('fragrance_top_note')}}</textarea>
                                        @error('fragrance_top_note')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-11">
                                    <div class="mb-2">
                                        <label for="brand_name">Fragrance Middle Note<span class="error">*</span></label>
                                        <textarea id="fragrance_middle_note" name="fragrance_middle_note"  class="form-control" placeholder="Fragrance Middle Note">{{old('fragrance_middle_note')}}</textarea>
                                        @error('fragrance_middle_note')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-11">
                                    <div class="mb-2">
                                        <label for="brand_name">Fragrance Base Note<span class="error">*</span></label>
                                        <textarea id="fragrance_base_note" name="fragrance_base_note" class="form-control" placeholder="Fragrance Base Note">{{old('fragrance_base_note')}}</textarea>
                                        @error('fragrance_base_note')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div> --}}
                            </div>
                            {{-- <div class="col-md-1 border-start">
                        </div>
                        <div class="col-md-5 p-0">
                            <div class="form-group">
                                <div class="col-sm-11">
                                    <div class="mb-2">
                                        <label for="brand_name">Fragrance Description<span class="error">*</span></label>
                                        <textarea id="fragrance_description" name="fragrance_description"  class="form-control" placeholder="Fragrance Description">{{old('fragrance_description')}}</textarea>
                                        @error('fragrance_description')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-11">
                                    <div class="mb-2">
                                        <label for="brand_name">Occasion<span class="error">*</span></label>
                                        <input id="occasion" name="occasion" type="text" value="{{old('occasion')}}" class="form-control" placeholder="Occasion">
                                        @error('occasion')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-11">
                                    <div class="mb-2">
                                        <label for="brand_name">Price<span class="error">*</span></label>
                                        <input id="price" name="price" type="number" value="{{old('price')}}" step="any" class="form-control" placeholder="Price">
                                        @error('price')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-11">
                                    <div class="mb-2">
                                        <label for="url">URL</label>
                                        <input id="url" name="url" type="text" value="{{old('url')}}" class="form-control" placeholder="Enter URL">
                                        <small>Ex : https://abc.com</small>
                                        @error('url')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-11">
                                    <div class="mb-2">
                                        <label for="size unit">Gender<span class="error">*</span></label>
                                        <select id="gender" name="gender" type="text" class="form-control select2" data-placeholder="Select Gender">
                                            <option value="Masculine">Masculine</option>
                                            <option value="Feminine">Feminine</option>
                                            <option value="Unisex">Unisex</option>
                                        </select>
                                        @error('gender')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-11">
                                    <div class="mb-2">
                                        <label for="brand_name">Campaign</label>
                                        <select id="campaign" name="campaign_id" class="form-control select2" data-placeholder="Select Campaign">
                                            <option value=""></option>
                                            @foreach ($campaigns as $campaign)
                                                <option value="{{$campaign->id}}" {{ old('campaign') ? 'selected' : '' }}>{{ $campaign->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('campaign_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-11">
                                    <div class="mb-2">
                                        <label for="brand_name">Photo<span class="error">*</span></label>
                                        <input id="photo" type="file" name="photo" class="form-control" placeholder="Campaign">{{old('photo')}}</textarea>
                                        <small>File size maximum limit 5 MB.</small>
                                        @error('photo')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="form-group">
                                <div class="col-sm-5 pt-2">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-outline-danger waves-effect waves-light m-2">Save</button>
                                        <a href="{{route('product.index')}}" class="btn btn-danger waves-effect waves-light">Cancel</a>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                </div>
                </form>

            </div>
        </div>

    </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
