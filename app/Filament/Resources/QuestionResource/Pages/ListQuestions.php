<?php

namespace App\Filament\Resources\QuestionResource\Pages;

use App\Filament\Actions\ImportQuestionsExcel;
use App\Filament\Resources\QuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuestions extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = QuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
            ImportQuestionsExcel::make(),
        ];
    }
}
