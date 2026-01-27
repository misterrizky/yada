@props([
    // jumlah kolom (wajib)
    'columns',

    // jumlah baris (opsional, default 10)
    'rows' => 10,
])

<div class="overflow-hidden rounded-xl border border-border bg-background">
    <flux:table>
        <flux:table.rows>
            @for ($r = 0; $r < $rows; $r++)
                <flux:table.row>
                    @for ($c = 0; $c < $columns; $c++)
                        <flux:table.cell>
                            <div class="h-4 w-full animate-pulse rounded-md bg-muted"></div>
                        </flux:table.cell>
                    @endfor
                </flux:table.row>
            @endfor
        </flux:table.rows>
    </flux:table>
</div>
