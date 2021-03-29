<style>
    .aa-secondary-btn {
        background-color: #fff;
        font-size: 16px;
        padding: 10px 22px;
        margin-top: 10px;
        display: inline-block;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        -ms--border-radius: 4px;
        border-radius: 4px;
        -webkit-transition: 0.5s;
        -moz-transition: 0.5s;
        -ms-transition: 0.5s;
        -o-transition: 0.5s;
        transition: 0.5s;
        color:#37c6f5;
        text-decoration: none;
    }   

    .aa-secondary-btn:hover,
    .aa-secondary-btn:focus {
        text-decoration: none;
        color: #fff;
        background: #37c6f5;
    }
</style>

<div style="text-align: center; margin-top:2rem;" class="container">
    <h2>Welcome to {{ config('app.name') }}'s Web Site</h2>
    <p>Please confirm your account from the link below</p>
    <a href="{{ route('user.activation', $user->activation_key) }}" style="border: 1px solid #37c6f5; margin:5px 0; font-size:14px;" class="aa-secondary-btn">Confirm</a>
</div>