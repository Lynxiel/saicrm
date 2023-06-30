<?php

namespace App\Filament\Resources\Student;

use App\Filament\Resources\Student\CourseStudentResource\Pages;
use App\Models\Student\Student;
use Filament\Resources\RelationManagers\RelationManager;
use App\Models\Student\CourseStudent;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use App\Models\Student\Course;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;

class CourseStudentResource extends Resource
{
    protected static ?string $model = CourseStudent::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static bool $shouldRegisterNavigation = false;



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('course_id')
                    ->label('Course')
                    ->relationship('course', 'name')
                    ->required()
                    ->default(fn (?RelationManager $livewire) => $livewire->ownerRecord::class == 'App\Models\Student\Course'?$livewire->ownerRecord->id:'' )
                    ->disabled(fn (?RelationManager $livewire) => $livewire->ownerRecord::class == 'App\Models\Student\Course'),

                Forms\Components\Select::make('student_id')
                    ->label('Student')
                    ->searchable()
                    ->required()
                    ->options(Student::all()->pluck('name', 'id'))
                    ->default(fn (?RelationManager $livewire) => $livewire->ownerRecord::class == 'App\Models\Student\Student'?$livewire->ownerRecord->id:'' )
                    ->disabled(fn (?RelationManager $livewire) => $livewire->ownerRecord::class == 'App\Models\Student\Student'),

                Forms\Components\Select::make('status')
                    ->disablePlaceholderSelection()
                    ->options([
                        'assigned' => 'Assigned',
                        'excluded' => 'Excluded',
                        'graduated' => 'Graduated',
                    ])
                    ->hidden(fn (?CourseStudent $record) => !$record)
                    ->reactive()

                    ->required(),

                Forms\Components\TextInput::make('grade')
                    ->hidden(fn (callable $get , ?CourseStudent $record ) =>  is_null($record) ||  ( $get('status')=="assigned" ||  $get('status')=="excluded")    )
                    ->required(fn (?CourseStudent $record) => $record && $record->status=='graduated'),

                Forms\Components\Card::make()->schema(
                    [
                        Forms\Components\Textarea::make('comment')
                    ]
                )->hidden(fn (?CourseStudent $record) => !$record)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('course.name')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->hidden(fn (?RelationManager $livewire) =>get_class($livewire->ownerRecord)==Course::class)
                    ->url(fn (?CourseStudent $record): string => auth()->user()->can('view_student::course')&&route('filament.resources.student/courses.view', ['record' => $record->course_id])),

                Tables\Columns\TextColumn::make('student.name')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->hidden(fn (?RelationManager $livewire) =>get_class($livewire->ownerRecord)==Student::class)
                    ->url(fn (?CourseStudent $record): string => auth()->user()->can('view_student::student')&&route('filament.resources.student/students.view', ['record' => $record->student_id])),
                Tables\Columns\TextColumn::make('grade')->searchable()->toggleable()->sortable(),
                Tables\Columns\TextColumn::make('comment')->searchable()->toggleable()->sortable(),
                Tables\Columns\BadgeColumn::make('status')->searchable()->toggleable()->sortable()
                    ->colors([
                        'danger' => 'excluded',
                        'warning' => 'assigned',
                        'success' => 'graduated',
                    ]),
                Tables\Columns\TextColumn::make('created_at')->toggleable()->sortable()->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->toggleable()->sortable()->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->multiple()
                    ->options([
                        'assigned' => 'Assigned',
                        'excluded' => 'Excluded',
                        'graduated' => 'Graduated',
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCourseStudents::route('/'),
        ];
    }
}
