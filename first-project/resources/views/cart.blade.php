@extends('layout.master')
@section('title','Cart')
@section('head')
<style>
#alertt {
    height: 100%;
    width: 100%;
    background-color: lightblue;
    text-align: center;
    padding: .5rem;
    border: 1px solid royalblue;
    border-radius: 5px;
    
}
</style>
@endsection
@section('content')
    <div class="container">
        <div class="bg-content">
            <h2>Sepet</h2>
            @include('layout.partials.alert')
                @if (count(Cart::content()) > 0)
                    <table class="table table-bordererd table-hover">
                        <tr>
                            <th colspan="2">Ürün</th>
                            <th>Adet Fiyatı</th>
                            <th>Adet</th>
                            <th>Tutar</th>
                        </tr>
                        @foreach (Cart::content() as $cart_product )
                            <tr>
                                <td style="width: 120px"> <img src="http://via.placeholder.com/120x100?text=ProductPic"></td>
                                <td>
                                    <a href="{{ route('product', $cart_product->options->slug) }}"> 
                                        {{ $cart_product->name }}
                                    </a>
                                    <form action="{{ route('delete_product' , $cart_product->rowId) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <input type="submit" class="btn btn-danger" value="Sepetten Kaldır">
                                    </form>
                                </td>
                                <td>{{ $cart_product->price }} ₺</td>
                                <td>
                                    <a href="#" class="btn btn-xs btn-default piece_decrease" data-id="{{ $cart_product->rowId }}" data-piece="{{ $cart_product->qty-1 }}" >-</a>
                                    <span style="padding: 10px 20px">{{ $cart_product->qty }}</span>
                                    <a href="#" class="btn btn-xs btn-default piece_increase" data-id="{{ $cart_product->rowId }}" data-piece="{{ $cart_product->qty+1 }}">+</a>
                                </td>
                                <td>{{ $cart_product->subtotal }} ₺</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th class="text-right" colspan="4">Ara Tutar</th>
                            <th>{{ Cart::subtotal() }} ₺</th>
                        </tr>
                        <tr>
                            <th class="text-right" colspan="4">KDV Tutarı</th>
                            <th>{{ Cart::tax() }} ₺</th>
                        </tr>
                        <tr>
                            <th class="text-right" colspan="4">Toplam Tutar (KDV Dahil)</th>
                            <th>{{ Cart::total() }} ₺</th>
                        </tr>
                    </table>
                    <div>
                        <form action="{{ route('clear_cart') }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="submit" style="background: #004684" class="btn btn-info pull-left" value="Sepeti Boşalt">
                        </form>
                        <a href="{{ route('payment') }}" class="btn btn-success pull-right btn-lg">Ödeme Yap</a>
                    </div>
                @else
                    <div id="alertt" class="col-md-12" role="alert">
                        Henüz sepette ürün yok
                    </div>
                @endif  
          
        </div>
    </div>
@endsection

@section('footer')
<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        $('.piece_increase, .piece_decrease').on('click', function () {
            var id = $(this).attr('data-id');
            var piece = $(this).attr('data-piece');
            $.ajax({
                type: 'PATCH',
                url : '{{ url('cart/update') }}/' + id,
                data : { piece : piece },
                success : function () {
                    window.location.href = '{{ route('cart') }}'
                }
            });
        });
    })
</script>
@endsection