<?php

namespace App\Filament\Resources\Student;

use App\Filament\Resources\Shop\BrandResource\RelationManagers\ProductsRelationManager;
use App\Filament\Resources\Student\CourseResource\Widgets\CourseStats;
use App\Filament\Resources\Shop\ProductResource\Widgets\ProductStats;
use App\Filament\Resources\Student\CourseResource\Pages;
//use App\Filament\Resources\Student\CourseResource\RelationManagers;
use App\Filament\Resources\Student\StudentResource\RelationManagers\CoursesRelationManager;
use App\Filament\Resources\Student\StudentResource\RelationManagers\StudentsRelationManager;
use App\Models\Student\Category;
use App\Models\Student\Course;
use BezhanSalleh\FilamentShield\FilamentShield;
use BezhanSalleh\FilamentShield\Traits\HasFilamentShield;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Traits\HasPermissions;
use Closure;

class CourseResource extends Resource
{
    use HasFilamentShield;
    use HasPermissions;
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark-alt';
    protected static ?string $navigationGroup = 'Students management';

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->can('view_any_student::course');
    }

    protected static function getNavigationBadge(): ?string
    {
        return Course::count();
    }

    protected static function getNavigationBadgeColor(): ?string
    {
        return 'primary';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->columns(2)
                    ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Название')
                        ->columns(1)
                        ->required()
                        ->maxLength(255),

                    Forms\Components\Select::make('category_id')
                        ->columns(1)
                        ->label('Категория')
                        ->relationship('category', 'name')
                        ->required(),
                    Forms\Components\RichEditor::make('description')

                        ->label('Описание')
                        ->columnSpanFull()
                        ->required(),
                ]),


                Forms\Components\Card::make()
                    ->columns(1)
                    ->columnSpan('md')
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')

                            ->label('Created at')
                            ->content(fn (Course $record): ?string => $record->created_at?->diffForHumans()),
                    ])->hidden(fn (?Course $record) => $record === null),



                Forms\Components\Card::make()
                    ->columns(1)
                    ->columnSpan('md')
                    ->schema([
                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn (Course $record): ?string => $record->updated_at?->diffForHumans()),
                    ])->hidden(fn (?Course $record) => $record === null),




            ]);
    }

    protected function getTableRecordActionUsing(): ?Closure
    {
        return null;
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Название')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->url(fn (?Course $record): string => route('filament.resources.student/courses.view', ['record' => $record->id])),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Категория')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->url(fn (?Course $record): string => route('filament.resources.student/categories.view', ['record' => $record->category_id])),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Создано')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Изменено')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('students_count')
                    ->label('Число обучающихся')
                    ->alignCenter()
                    ->toggleable()
                    ->sortable()
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
            StudentsRelationManager::class
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return Course::withCount('students');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'view' => Pages\ViewCourse::route('/{record}'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            CourseStats::class,
        ];
    }


}
