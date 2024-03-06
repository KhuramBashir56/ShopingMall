<meta name="csrf-token" content="{{ csrf_token() }}">
<meta property="og:image" content="{{ asset(config('app.logo')) }}" />
<meta property="og:image:type" content="image/png" />
<meta property="og:image:width" content="500" />
<meta property="og:image:height" content="325" />
<meta property="og:title" content="{{ config('app.name') }}" />
<meta property="og:description" content="{{ config('app.description') }}" />
<meta name="author" content="{{ config('app.author') }}" />
<meta name="author-email" content="{{ config('app.author_email') }}" />
<link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png">
<link rel="apple-touch-icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png" />
