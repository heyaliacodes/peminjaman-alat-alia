@php
    $jam = now()->hour;
    $teks = match(true) {
        $jam < 11 => 'Selamat pagi',
        $jam < 15 => 'Selamat siang',
        $jam < 19 => 'Selamat sore',
        default   => 'Selamat malam',
    };
@endphp
{{ $teks }}