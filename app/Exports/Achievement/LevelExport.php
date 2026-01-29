<?php

namespace App\Exports\Achievement;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LevelExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(public Collection $rows) {}

    public function collection(): Collection
    {
        return $this->rows;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Level',
            'Next Level XP',
            'Users',
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->id,
            $row->level,
            $row->next_level_experience,
            $row->users_count ?? 0,
        ];
    }
}
