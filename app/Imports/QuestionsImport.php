<?php

namespace App\Imports;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Model|Question|null
     */
    public function model(array $row): Model|Question|null
    {
        return new Question([
            'question' => $row['question'],
            'points' => $row['points'],
            'min_value' => $row['min_value'],
            'max_value' => $row['max_value'],
            'category_id' => $row['category_id'],
        ]);
    }
}
