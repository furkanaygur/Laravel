@extends('layout.master')
@section('title','Payment')
@section('content')
    <div class="container">
        @include('layout.partials.alert')
        <div class="bg-content">
            <h2>Ödeme</h2>
            <form action="{{ route('payment.pay') }}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-5">
                        <h3>Ödeme Bilgileri</h3>
                        <div class="form-group">
                            <label for="kartno">Kredi Kartı Numarası</label>
                            <input type="text" class="form-control kredikarti" id="kartno" name="cardnumber" style="font-size:20px;" required>
                        </div>
                        <div class="form-group">
                            <label for="cardexpiredatemonth">Son Kullanma Tarihi</label>
                            <div class="row">
                                <div class="col-md-6">
                                    Ay
                                    <select name="cardexpiredatemonth" id="cardexpiredatemonth" class="form-control" required>
                                        @for ($i=1;$i<=12;$i++)
                                        <option>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    Yıl
                                    <select name="cardexpiredateyear" class="form-control" required>
                                        <option>2017</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cardcvv2">CVV (Güvenlik Numarası)</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" class="form-control kredikarti_cvv" name="cardcvv2" id="cardcvv2" required>
                                </div>
                            </div>
                        </div>
                        <form>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label><input type="checkbox" checked> Ön bilgilendirme formunu okudum ve kabul ediyorum.</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label><input type="checkbox" checked> Mesafeli satış sözleşmesini okudum ve kabul ediyorum.</label>
                                </div>
                            </div>
                        </form>
                        <button type="submit" class="btn btn-success btn-lg">Ödeme Yap</button>
                    </div>
                    <div class="col-md-7">
                        <h4>Ödenecek Tutar</h4>
                        <span class="price">{{ Cart::total() }} <small>TL</small></span>

                        <h4>İletişim ve Fatura</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name">Ad Soyad</label>
                                    <input style="text-transform: uppercase" type="text" id="name" name="full_name" class="form-control" value="{{ auth()->user()->full_name }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="adres">Adres</label>
                                    <input style="text-transform: uppercase" type="text" id="adres" name="address" class="form-control" value="{{ $user_detail->address }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone">Telefon</label>
                                    <input type="text" id="phone" name="phone" class="form-control telefon" value="{{ $user_detail->phone }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="phone2">2. Telefon</label>
                                    <input type="text" id="phone2" name="phone2" class="form-control telefon" value="{{ $user_detail->phone2 }}" readonly>
                                </div>
                            </div>
                        </div>
                        <h4>Kargo</h4>
                        <p>Ücretsiz
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
    <script>
        $('.kredikarti').mask('0000-0000-0000-0000', { placeholder: "____-____-____-____" });
        $('.kredikarti_cvv').mask('000', { placeholder: "___" });
        $('.telefon').mask('(000) 000-00-00', { placeholder: "(___) ___-__-__" });
    </script>
@endsection