<?php

namespace App\Filament\Resources\Student;

use App\Filament\Resources\Student\StudentResource\Pages;
use App\Filament\Resources\Student\StudentResource\RelationManagers;
use App\Models\Student\Student;
use Filament\Forms;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use const _PHPStan_67a5964bf\__;

class StudentResource extends Resource
{
    use Translatable;
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Students management';

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->can('view_any_student::student');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('university')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('date_entered'),
                Forms\Components\DatePicker::make('date_finished'),
                Forms\Components\Textarea::make('comment'),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        //dd(__('Name'));
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->toggleable()
                    ->sortable()
                    ->searchable()
                    ->url(fn (?Student $record): string => route('filament.resources.student/students.view', ['record' => $record->id])),
                //Tables\Columns\TextColumn::make('university'),
                Tables\Columns\TextColumn::make('date_entered')
                    ->toggleable()
                    ->sortable()
                    ->searchable()
                    ->date(),
                Tables\Columns\TextColumn::make('date_finished')
                    ->toggleable()
                    ->sortable()
                    ->searchable()
                    ->date(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'danger' => 'excluded',
                        'warning' => 'in_edu',
                        'success' => 'graduated',
                        ])
                    ->toggleable()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('courses_count')
                    ->alignCenter()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->toggleable()
                    ->sortable()
                    ->searchable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->toggleable()
                    ->sortable()
                    ->searchable()
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\CoursesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'view' => Pages\ViewStudent::route('/{record}'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return Student::withCount('courses');
    }
}
