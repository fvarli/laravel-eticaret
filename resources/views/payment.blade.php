@extends('layouts.master')

@section('title', 'Payment')

@section('content')
    <div class="container">
        <div class="bg-content">
            <h2>Payment</h2>
            <form action="{{ route('pay') }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-5">
                        <h3>Ödeme Bilgileri</h3>
                        <div class="form-group">
                            <label for="credit_card_number">Kredi Kartı Numarası</label>
                            <input type="text" class="form-control credit_card" id="credit_card_number" name="credit_card"
                                   style="font-size:20px;" required>
                        </div>
                        <div class="form-group">
                            <label for="credit_card_expired_date_month">Son Kullanma Tarihi</label>
                            <div class="row">
                                <div class="col-md-6">
                                    Ay
                                    <select name="credit_card_expired_date_month" id="credit_card_expired_date_month" class="form-control"
                                            required>
                                        <option>1</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    Yıl
                                    <select name="credit_card_expired_date_year" id="credit_card_expired_date_year" class="form-control" required>
                                        <option>2017</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="card_cvv2">CVV (Güvenlik Numarası)</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" class="form-control credit_card_cvv" name="card_cvv2" id="card_cvv2"
                                           required>
                                </div>
                            </div>
                        </div>
                        <form>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label><input type="checkbox" checked> Ön bilgilendirme formunu okudum ve kabul
                                        ediyorum.</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label><input type="checkbox" checked> Mesafeli satış sözleşmesini okudum ve kabul
                                        ediyorum.</label>
                                </div>
                            </div>
                        </form>
                        <button type="submit" class="btn btn-success btn-lg">Ödeme Yap</button>
                    </div>
                    <div class="col-md-7">
                        <h4>Ödenecek Tutar</h4>
                        <span class="price">{{ Cart::total() }} <small>₺</small></span>

                        <h4>Kargo</h4>
                        <span class="price">0 <small>TL</small></span>

                        <h4>Teslimat Bilgileri</h4>
                        <p>Teslimat Adresi </p>
                        <a href="#">Değiştir</a>

                        <h4>Kargo</h4>
                        <p>Ücretsiz</p>

                        <h4>İletişim ve Fatura Bilgileri</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="full_name">Full Name</label>
                                    <input type="text" class="form-control" name="full_name" id="full_name" value="{{ auth()->user()->full_name }}" required>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" name="address" id="address" value="{{ $user_detail->address }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control phone" name="phone" id="phone" value="{{ $user_detail->phone }}" required>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="cell_phone">Cell Phone</label>
                                    <input type="text" class="form-control phone" name="cell_phone" id="cell_phone" value="{{ $user_detail->cell_phone }}">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </form>

        </div>
    </div>
@endsection
@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
    <script>
        $('.credit_card').mask('0000-0000-0000-0000', {placeholder: "____-____-____-____"});
        $('.credit_card_cvv').mask('000', {placeholder: "___"});
        $('.phone').mask('(000) 000-00-00', {placeholder: "(___) ___-__-__"});
    </script>
@endsection
<?php
?>
