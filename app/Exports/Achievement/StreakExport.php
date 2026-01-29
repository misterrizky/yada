<?php

namespace App\Exports\Achievement;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StreakExport implements FromCollection, WithHeadings, WithMapping
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
            'Activity',
            'Count',
            'Activity At',
            'Frozen Until',
            'Histories',
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->id,
            $row->user?->name,
            $row->activity?->name,
            $row->count,
            $row->activity_at?->toDateTimeString(),
            $row->frozen_until?->toDateTimeString(),
            $row->histories_count ?? 0,
        ];
    }
}
