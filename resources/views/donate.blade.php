<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link href="/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
    <div class="content">
        <div class="image">
            <img src="http://www.gravatar.com/avatar/{{ md5("hello@laravel-news.com") }}?s=200" />
        </div>
        <h1>Laravel News</h1>

        @if (! $amount)
            <form action="/donate" method="get">
                <div class="form-item">
                    <label for="amount">Amount:</label>
                    <input type="text" name="amount" value="200.00">
                </div>
                <p>
                <button type="submit">
                    <span style="display: block; min-height: 30px;">Continue</span>
                </button>
                </p>
            </form>
        @else
            <form action="/donate" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="amount" value="{{ $amount }}">
                <script
                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                        data-key="{{ config('services.stripe.key') }}"
                        data-amount="{{ $amount }}"
                        data-name="Laravel News"
                        data-description="{{ $description or "Donation" }}"
                        {{--data-image="/128x128.png"--}}
                        data-locale="auto"
                        data-label="Pay with Stripe">
                </script>
            </form>
        @endif
    </div>
</div>

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>

</body>
</html>
