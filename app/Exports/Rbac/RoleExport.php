<?php

namespace App\Exports\Rbac;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RoleExport implements FromCollection, WithHeadings, WithMapping
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
            'Name',
            'Guard',
            'Permissions',
        ];
    }

    public function map(mixed $row): array
    {
        $permissions = $row->permissions?->pluck('name')->implode(', ') ?? '';

        return [
            $row->id,
            $row->name,
            $row->guard_name,
            $permissions,
        ];
    }
}
