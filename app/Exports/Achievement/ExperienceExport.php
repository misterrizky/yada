<?php

namespace App\Exports\Achievement;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExperienceExport implements FromCollection, WithHeadings, WithMapping
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
            'User',
            'Email',
            'Level',
            'Experience Points',
            'Audit Count',
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->id,
            $row->user?->name,
            $row->user?->email,
            $row->status?->level,
            $row->experience_points,
            $row->audits_count ?? 0,
        ];
    }
}
