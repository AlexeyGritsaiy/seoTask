@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="wrap">
            <form method="POST" action="{{ route('task.create') }}" id="add-task">
                @csrf
                <div class="form-group row">
                    <label for="formGroupFoundControlSelect" class="col-sm-3 col-form-label">Поисковая система:</label>
                    <div class="col-sm-9">
                        <select class="form-control @error('se') is-invalid @enderror" id="formGroupFoundControlSelect" name='se'>
                            <option value="">
                                Выберите поисковую систему
                            </option>
                            @foreach($engines as $value)
                                <option value="{{ (int)$value['se_id'] }}"
                                        data-country_iso_code="{{ $value['se_country_iso_code'] }}"
                                    {{ old('se') == $value['se_id'] ? ' selected' : '' }}>
                                    {{ $value['se_name'] . ' (' . $value['se_country_name'] . ', ' . $value['se_language'] . ')' }}
                                </option>
                            @endforeach
                        </select>

                        @error('se')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="formGroupRegionControlSelect" class="col-sm-3 col-form-label">Регион:</label>
                    <div class="col-sm-9">
                        <select class="form-control @error('region') is-invalid @enderror" id="formGroupRegionControlSelect" name='region'>
                            <option value="">
                                Сначала выберите поисковую систему
                            </option>
                        </select>

                        @error('region')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="formGroupKeywordsInput" class="col-sm-3 col-form-label">Ключевые слова: </label>
                    <div class="col-sm-9">
                        <textarea class="form-control @error('keywords') is-invalid @enderror" id="formGroupKeywordsInput" name="keywords"
                              placeholder="Ключевые слова"></textarea>
                        @error('keywords')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-sm-10 text-right">
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
