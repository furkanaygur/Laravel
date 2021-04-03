@extends('layout.master')
@section('title', 'Orders')
@section('content')
    <section id="aa-catg-head-banner">
    <img src="http://via.placeholder.com/1920x300?text=Furkan" alt="fashion img">
    <div class="aa-catg-head-banner-area">
        <div class="container">
            <div class="aa-catg-head-banner-content">
            <h2>Checkout Page</h2>
            <ol class="breadcrumb">
                <li><a href="{{ route('user.index') }}">Home</a></li>                   
                <li class="active">Checkout</li>
            </ol>
            </div>
        </div>
    </div>
    </section>

   <section id="checkout">
   <div class="container">
     @include('layout.partials.alert')
     <div class="row">
       <div class="col-md-12">
        <div class="checkout-area">
          <form action="{{ route('order.payment') }}" method="POST">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-8">
                <div class="checkout-left">
                  <div class="panel-group" id="accordion">
                    <!-- Billing Details -->
                    <div class="panel panel-default aa-checkout-billaddress">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            Billing Details
                          </a>
                        </h4>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse in">
                        <div class="panel-body">
                          <div class="row">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
                              <div class="col-md-6">
                                <div class="aa-checkout-single-bill">
                                    <label for="">Name*</label>
                                    <input type="text" name="name" value="{{ old('name', $infos->name) }}" placeholder="First Name*">
                                    @if ($errors->has('name'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('name') }}</strong>
                                      </span>
                                    @endif
                                </div>                             
                              </div>
                              <div class="col-md-6">
                                <div class="aa-checkout-single-bill">
                                  <label for="">Surname*</label>
                                  <input type="text" name="surname" value="{{ old('surname', $infos->surname) }}" placeholder="Surname*">
                                  @if ($errors->has('surname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>   
                          <div class="row">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">
                              <div class="col-md-6">
                                <div class="aa-checkout-single-bill">
                                  <label for="">Email*</label>
                                  <input type="email" name="email" value="{{ old('email', $infos->email) }}" placeholder="Email Address*">
                                  @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                  @endif
                                </div>                             
                              </div>
                              <div class="col-md-6">
                                <div class="aa-checkout-single-bill">
                                  <label for="">Bank*</label>
                                  <input type="text" name="bank" value="{{ old('bank', $infos->detail->bank) }}" placeholder="Bank*">
                                  @if ($errors->has('bank'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bank') }}</strong>
                                    </span>
                                  @endif
                                </div>
                              </div> 
                            </div>
                          </div> 
                          <div class="row">  
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">                 
                              <div class="col-md-12">
                                <div class="aa-checkout-single-bill">
                                  <label for="phone">Phone*</label>
                                  <input class="phone" type="tel" value="{{ old('bank', $infos->detail->phone) }}" name="phone" placeholder="Phone*">
                                  @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                  @endif
                                </div>
                              </div>  
                            </div>                    
                          </div> 
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <label for="carnumber">Card Number*</label>
                                <input class="cardnumber" type="text" placeholder="Card Number*">
                              </div>
                            </div> 
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <label for="">Month*</label>
                                <input type="text" placeholder="Month*">
                              </div>
                            </div>                                            
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <label for="">Year*</label>
                                <input type="text" placeholder="Year*">
                              </div>
                            </div>                              
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <label for="cvv">CVV*</label>
                                <input class="cvv" type="text" placeholder="CVV*">
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : null }}">             
                              <div class="col-md-12">
                                <div class="aa-checkout-single-bill">
                                  <label for="address">Address*</label>
                                  <textarea style="color:black" cols="8" name="address" placeholder="Address*" rows="3">{{ old('address', $infos->detail->address) }}</textarea>
                                  @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                  @endif
                                </div>                             
                              </div> 
                            </div>                           
                          </div>   
                          {{-- <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                <select>
                                  <option value="0">Select Your Country</option>
                                  <option value="1">Australia</option>
                                  <option value="2">Afganistan</option>
                                  <option value="3">Bangladesh</option>
                                  <option value="4">Belgium</option>
                                  <option value="5">Brazil</option>
                                  <option value="6">Canada</option>
                                  <option value="7">China</option>
                                  <option value="8">Denmark</option>
                                  <option value="9">Egypt</option>
                                  <option value="10">India</option>
                                  <option value="11">Iran</option>
                                  <option value="12">Israel</option>
                                  <option value="13">Mexico</option>
                                  <option value="14">UAE</option>
                                  <option value="15">UK</option>
                                  <option value="16">USA</option>
                                </select>
                              </div>                             
                            </div>                            
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="Appartment, Suite etc.">
                              </div>                             
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="City / Town*">
                              </div>
                            </div>
                          </div>   
                          <div class="row">
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="District*">
                              </div>                             
                            </div>
                            <div class="col-md-6">
                              <div class="aa-checkout-single-bill">
                                <input type="text" placeholder="Postcode / ZIP*">
                              </div>
                            </div>
                          </div>                                     --}}
                        </div>
                      </div>
                    </div>
                     <!-- Coupon section -->
                     <div class="panel panel-default aa-checkout-coupon">
                        <div class="panel-heading">
                          <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                              Have a Coupon?
                            </a>
                          </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse">
                          <div class="panel-body">
                            <input type="text" placeholder="Coupon Code" class="aa-coupon-code">
                            <a href="javascript:void(0)" class="aa-browse-btn" >Apply Coupon</a>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="checkout-right">
                  <h4>Order Summary</h4>
                  <div class="aa-order-summary-area">
                    <table class="table table-responsive">
                      <thead>
                        <tr>
                          <th>Product</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach (Cart::content() as $cart_product)
                        <tr>
                          <td>{{ $cart_product->name }} <strong> x  {{ $cart_product->qty }}</strong></td>
                          <td>${{ $cart_product->subtotal }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Subtotal</th>
                          <td>${{ Cart::subtotal() }}</td>
                        </tr>
                         <tr>
                          <th>Tax</th>
                          <td>${{ Cart::tax() }}</td>
                        </tr>
                         <tr>
                          <th>Total</th>
                          <td>${{ Cart::total() }}</td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                  <h4>Payment Method</h4>
                  <div class="aa-payment-method">                    
                    <label for="cashdelivery"><input type="radio" id="cashdelivery" name="optionsRadios"> Cash on Delivery </label>
                    <label for="paypal"><input type="radio" id="paypal" name="optionsRadios" checked> Via Paypal </label>
                    <img style="margin-top: 0rem" src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg" border="0" alt="PayPal Acceptance Mark">    
                    <input type="submit" value="Place Order" class="aa-browse-btn">                
                  </div>
                </div>
              </div>
            </div>
          </form>
         </div>
       </div>
     </div>
   </div>
 </section>
@endsection
@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
  <script>
      $('.cardnumber').mask('0000-0000-0000-0000', { placeholder: "____-____-____-____" });
      $('.cvv').mask('000', { placeholder: "___" });
      $('.phone').mask('(000) 000-00-00', { placeholder: "(___) ___-__-__" });
  </script>
@endsection