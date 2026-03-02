<?php

namespace App\Filament\Pages\Auth;

use Filament\Actions\Action;
use Filament\Auth\Pages\Login as PagesLogin;

class Login extends PagesLogin
{
       protected function getFormActions(): array
{
    return [
        $this->getAuthenticateFormAction(),

        Action::make('back')
            ->label('← Halaman Utama')
            ->url('/')
            ->color('gray')
            ->link(),
    ];
}
    
    protected function getFooterActions(): array
    {
        return [
            Action::make('back_to_home')
                ->label('← Kembali ke Website')
                ->url('/')
                ->color('gray')
                ->link(),
        ];
    }
}
