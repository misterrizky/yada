<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait Searchable
{
    public function scopeSearch(Builder $query, ?string $keyword, array $fields): Builder
    {
        if (!filled($keyword) || empty($fields)) {
            return $query;
        }

        // 1. normalize keyword
        $keywords = collect(
            preg_split('/\s+/', trim($keyword))
        )->filter();

        return $query->where(function ($query) use ($keywords, $fields) {
            foreach ($keywords as $word) {
                $query->where(function ($q) use ($word, $fields) {
                    foreach ($fields as $field) {
                        $q->orWhereRaw(
                            'LOWER(' . $field . ') LIKE ?',
                            ['%' . mb_strtolower($word) . '%']
                        );
                    }
                });
            }
        });
    }
}
