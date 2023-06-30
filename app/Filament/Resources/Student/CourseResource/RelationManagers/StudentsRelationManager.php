<?php

namespace App\Filament\Resources\Student\StudentResource\RelationManagers;

use App\Filament\Resources\Student\CourseStudentResource;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Pages\Actions\CreateAction;

class StudentsRelationManager extends RelationManager
{
    protected static string $relationship = 'students';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return CourseStudentResource::form($form);
    }

    public static function table(Table $table): Table
    {
        return CourseStudentResource::table($table)
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label(''),
                Tables\Actions\DeleteAction::make()->label(''),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }



}
