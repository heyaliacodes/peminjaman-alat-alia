<?php

namespace App\View\Composers;

use App\Services\NotifikasiNavbarService;
use Illuminate\View\View;

class NotifikasiNavbarComposer
{
    public function __construct(private NotifikasiNavbarService $layanan)
    {
    }

    public function compose(View $view): void
    {
        $pengguna = auth()->user();

        $view->with('notifikasiNavbar', $pengguna
            ? $this->layanan->untukPengguna($pengguna)
            : []);
    }
}