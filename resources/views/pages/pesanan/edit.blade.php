@extends('layouts.default')

@section('content')
    @php
        $module = 'Paid Kamar Anda';
    @endphp
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ $module }} /</span> Bayar {{ $row->Room->title }}
    </h4>
    <div class="card mb-4">
        <div class="card-body">
            @include('components.alert.error-field')
            <form method="post" action="{{ route('web.pesanan.update', ['id' => $row->uuid]) }}"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-6">

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'asrama',
                            'label' => 'Nama Asrama',
                            'value' => old('asrama', $row->Room->Asrama->title),
                            'placeholder' => 'Nama Asrama',
                            'type' => 'text',
                            'show' => true,
                            'disabled' => true,
                        ])

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'room',
                            'label' => 'Room',
                            'value' => old('room', $row->Room->title),
                            'placeholder' => 'Room',
                            'type' => 'text',
                            'show' => true,
                            'disabled' => true,
                        ])

                        @include('components.form.number', [
                            'class_group' => 'mb-3',
                            'field_name' => 'ammount',
                            'label' => 'Total Dibayarkan',
                            'value' => old('ammount', 0),
                            'placeholder' => 'Total Dibayarkan',
                            'type' => 'text',
                            'show' => true,
                            'disabled' => false,
                            'min' => 0,
                            'max' => 9999999999,
                            'accept' => 'disable-minus',
                        ])


                    </div>
                    <div class="col-md-6">
                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'pemesan',
                            'label' => 'Pemesan',
                            'value' => old('pemesan', $row->User->name),
                            'placeholder' => 'Pemesan',
                            'type' => 'text',
                            'show' => true,
                            'disabled' => true,
                        ])

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'email',
                            'label' => 'Email',
                            'value' => old('pemesan', $row->User->email),
                            'placeholder' => 'Email',
                            'type' => 'text',
                            'show' => true,
                            'disabled' => true,
                        ])

                        @include('components.form.image', [
                            'class_group' => 'mb-3',
                            'field_name' => 'image',
                            'label' => 'Bukti Pembayaran',
                            'value' => '',
                            'placeholder' => 'Bukti Pembayaran',
                            'type' => 'text',
                            'show' => true,
                            'disable' => false,
                            'multiple' => false,
                        ])
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a type="button" class="btn btn-secondary" href="{{ route('web.pesanan.index') }}">Batal</a>
                </div>
            </form>
        </div>
    @endsection
