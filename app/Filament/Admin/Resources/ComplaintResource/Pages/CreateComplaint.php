<?php

namespace App\Filament\Admin\Resources\ComplaintResource\Pages;

use App\Filament\Admin\Resources\ComplaintResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateComplaint extends CreateRecord
{
    protected static string $resource = ComplaintResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id(); // ✅ Set logged-in user ID
        return $data;
    }
}


