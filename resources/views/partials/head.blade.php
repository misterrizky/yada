<meta charset="utf-8" />
<meta content="follow, index" name="robots"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{ request()->url() }}" rel="canonical"/>
<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport"/>
<meta content="{{ $description ?? config('app.description') }}" name="description"/>
<meta content="@yadaekidanta" name="twitter:site"/>
<meta content="@yadaekidanta" name="twitter:creator"/>
<meta content="summary_large_image" name="twitter:card"/>
<meta content="{{ $title ?? config('app.name') }}" name="twitter:title"/>
<meta content="{{ $description ?? config('app.description') }}" name="twitter:description"/>
<meta content="{{ asset('favicon-32x32.png') }}" name="twitter:image"/>
<meta content="{{ request()->url() }}" property="og:url"/>
<meta content="en_US" property="og:locale"/>
<meta content="website" property="og:type"/>
<meta content="@yadaekidanta" property="og:site_name"/>
<meta content="{{ $title ?? config('app.name') }}" property="og:title"/>
<meta content="{{ $description ?? config('app.description') }}" property="og:description"/>
<meta content="{{ asset('favicon-32x32.png') }}" property="og:image"/>
<link href="{{ asset('apple-touch-icon.png') }}" rel="apple-touch-icon" sizes="180x180"/>
<link href="{{ asset('favicon-32x32.png') }}" rel="icon" sizes="32x32" type="image/png"/>
<link href="{{ asset('favicon-16x16.png') }}" rel="icon" sizes="16x16" type="image/png"/>
<link href="{{ asset('favicon.ico') }}" rel="shortcut icon"/>
<link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
<link href="{{ asset('assets/vendors/apexcharts/apexcharts.css') }}" rel="stylesheet"/>
<link href="{{ asset('assets/vendors/keenicons/styles.bundle.css') }}" rel="stylesheet"/>

<title>{{ $title ?? config('app.name') }}</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
