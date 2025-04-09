<?php

namespace App\Filament\Actions;

use App\Imports\QuestionsImport;
use App\Models\Category;
use App\Models\Game;
use App\Models\Question;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImportQuestionsExcel
{
    public static function make(): Action
    {
        return Action::make('importQuestionsExcel')
            ->color('info')
            ->label('Import Questions Excel')
            ->icon('heroicon-o-arrow-path')
            ->action(function (array $data) {
                self::import($data);
            })
            ->tooltip(__('Import Questions Excel'))
            ->modalWidth('xl')
            ->modalHeading(__('Import Questions Excel'))
            ->form([
                FileUpload::make('file_path')
                    ->label(__('Excel File'))
                    ->required()
                    ->acceptedFileTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                    ->maxSize(1024 * 10) // 10MB
                    ->columnSpanFull(),
                Select::make('game_id')
                    ->label(__('Game'))
                    ->relationship('games', 'name')
                    ->preload()
                    ->required(),

                Select::make('category_id')
                    ->label(__('Category'))
                    ->relationship('categories', 'name')
                    ->preload()
                    ->required(),
            ]);
    }

    /**
     * @throws \Exception
     */
    public static function import(array $data): void
    {
        $filePath = storage_path('app/public/' . $data['file_path']);
        if (!file_exists($filePath)) {
            throw new \Exception('File does not exist at path: ' . $filePath);
        }
        Excel::import(new QuestionsImport, $filePath);

        $questions = Question::where('created_at', '>=', now()->subMinutes(5))->get();
        $game = Game::where('id', $data['game_id'])->first();
        $category = Category::where('id', $data['category_id'])->first();
        $questions->each(function (Question $question) use ($category, $game) {
            $question->games()->attach($game);
            $question->categories()->attach($category);
        });
    }

}
