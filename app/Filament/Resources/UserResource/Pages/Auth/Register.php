<?php

namespace App\Filament\Resources\UserResource\Pages\Auth;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\Page;

class Register extends Page
{
    protected static string $resource = UserResource::class;

    protected static string $view = 'filament.resources.user-resource.pages.auth.register';
}
