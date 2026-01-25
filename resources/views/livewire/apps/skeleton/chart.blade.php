<flux:card class="dark:bg-zinc-800">
    <div class="flex flex-col gap-6">
        <div class="flex gap-12">
            <div>
                <flux:text>Today</flux:text>

                <flux:heading size="xl" class="mt-2 tabular-nums">$---</flux:heading>

                <flux:text class="mt-2 tabular-nums">-:-- PM</flux:text>
            </div>

            <div>
                <flux:text>Yesterday</flux:text>

                <flux:heading size="lg" class="mt-2 tabular-nums">$---</flux:heading>
            </div>
        </div>

        <flux:skeleton animate="shimmer" class="aspect-[4/1] size-full rounded-lg" />
    </div>
</flux:card>