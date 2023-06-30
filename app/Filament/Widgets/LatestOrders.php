<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Shop\OrderResource;
use App\Filament\Resources\Student\CourseResource;
use App\Models\Student\Course;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Squire\Models\Currency;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class LatestOrders extends BaseWidget
{
    use HasWidgetShield;

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;
    protected static ?string $heading = 'Latest courses';

    public function getDefaultTableRecordsPerPageSelectOption(): int
    {
        return 5;
    }

    protected function getDefaultTableSortColumn(): ?string
    {
        return 'created_at';
    }

    protected function getDefaultTableSortDirection(): ?string
    {
        return 'desc';
    }

    protected function getTableQuery(): Builder
    {
       return CourseResource::getEloquentQuery()->withCount('students');
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->label('Название')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('category.name')
                ->label('Категория')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Создано')
                ->searchable()
                ->sortable()
                ->dateTime(),
            Tables\Columns\TextColumn::make('updated_at')
                ->label('Изменено')
                ->searchable()
                ->sortable()
                ->dateTime(),

            Tables\Columns\TextColumn::make('students_count')
                ->label('Число обучающихся')
                ->sortable()
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\Action::make('Edit')
                ->url(fn (Course $record): string => CourseResource::getUrl('edit', ['record' => $record])),
        ];
    }
}
