<?php

namespace App\Filament\Resources\Student\CategoryResource\RelationManagers;

use App\Models\Student\Course;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use App\Filament\Resources\Student\CourseResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class CoursesRelationManager extends RelationManager
{

    protected static string $relationship = 'courses';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return CourseResource::form($form);
    }

    public function getTableQuery(): Builder|Relation
    {
        return Course::withCount('students');
    }

    public static function table(Table $table): Table
    {
        return CourseResource::table($table)
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
