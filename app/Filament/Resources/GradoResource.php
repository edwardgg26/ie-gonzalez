<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Tables;
use App\Models\Grado;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\GradoMateria;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Resources\Resource;
use Filament\Forms\Components\Tabs;
use Illuminate\Support\Facades\Mail;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\Unique;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use App\Filament\Resources\GradoResource\Pages;
use Filament\Notifications\Notification;

class GradoResource extends Resource
{
    protected static ?string $model = Grado::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Academico';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Select::make('tipogrado_id')->label('Grado')
                    ->relationship(name: 'tipogrado', titleAttribute:'name')
                    ->unique(modifyRuleUsing: function (Unique $rule,callable $get) { // $get callable is used 
                        return $rule
                            ->where('tipogrado_id', $get('tipogrado_id')) // get the current value in the 'school_id' field
                            ->where('year', $get('year'))
                            ->where('group', $get('group'));
                        }, 
                    ignoreRecord: true) // ignore current record when editing
                    ->required()
                    ->native(false),
                TextInput::make('group')->label('Grupo')->required(),
                Select::make('jornada_id')->label('Jornada')
                    ->relationship(name: 'jornada', titleAttribute:'name')->native(false),
                TextInput::make('year')->label('Año')
                    ->numeric()
                    ->default(date('Y'))
                    ->minValue(2010)
                    ->maxValue(date('Y')+1)
                    ->required(),

                Tabs::make('Tabs')
                ->tabs([
                    Tabs\Tab::make('Alumnos')
                    ->schema([
                        // Tab de los estudiantes
                        Repeater::make('grado_alumnos')
                        ->hiddenLabel()
                        ->relationship()
                        ->schema([
                            Select::make('alumno_id')
                                ->label('Alumno')
                                ->searchable()
                                ->relationship('alumno','name')
                                ->required()
                                ->native(false)
                                ->unique(modifyRuleUsing: function (Unique $rule,callable $get) { // $get callable is used 
                                    return $rule
                                        ->where('grado_id', $get('../../id')) // get the current value in the 'school_id' field
                                        ->where('alumno_id', $get('alumno_id'));
                                    }, 
                                ignoreRecord: true),
                            Placeholder::make('email')
                                ->content(fn($record)=> $record ? $record->alumno->email : 'Correo del estudiante'),
                        ])
                        ->reorderable()
                        ->collapsible()
                        ->addActionLabel('Añadir alumno')
                        ->columns(2)
                        ->columnSpan(2)
                    ]),

                    Tabs\Tab::make('Materias')
                    ->schema([
                        //Tab de las materias
                        Repeater::make('grado_materias')
                        ->hiddenLabel()
                        ->relationship()
                        ->schema([
                            // FileUpload::make('imagen')->image(),
                            Select::make('materia_id')->label('Materia')
                                ->searchable()
                                ->preload()
                                ->relationship('materia','name')
                                ->required()
                                ->unique(modifyRuleUsing: function (Unique $rule,callable $get) { // $get callable is used 
                                    return $rule
                                        ->where('grado_id', $get('../../id')) // get the current value in the 'school_id' field
                                        ->where('dia_id', $get('dia_id'))
                                        ->where('materia_id', $get('materia_id'))
                                        ->where('docente_id', $get('docente_id'))
                                        ->where('hora_id', $get('hora_id'));
                                    }, 
                                ignoreRecord: true)
                                ->validationMessages([
                                    'unique'=>'No se puede duplicar el mismo registro'
                                ])
                                ->native(false),

                            Select::make('dia_id')->label('Dia')
                                ->relationship('dia','name')
                                ->unique(modifyRuleUsing: function (Unique $rule,callable $get) { // $get callable is used 
                                    return $rule
                                        ->where('grado_id', $get('../../id')) // get the current value in the 'school_id' field
                                        ->where('dia_id', $get('dia_id'))
                                        ->where('hora_id', $get('hora_id'));
                                    }, 
                                ignoreRecord: true)
                                ->validationMessages([
                                    'unique'=>'Ya hay una materia el mismo dia y a la misma hora en el grado'
                                ])
                                ->required()
                                ->native(false),
                            Select::make('hora_id')->label('Hora') 
                                ->searchable()
                                ->getOptionLabelFromRecordUsing(fn (Model $record) => Carbon::parse($record->hora)->format('g:i A'))
                                ->preload()
                                ->relationship('hora','hora')
                                ->required()->native(false),
                            Select::make('docente_id')
                                ->label('Docente')
                                ->searchable()
                                ->relationship('docente','name')
                                ->required()
                                ->native(false)
                                ->rules([
                                    fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {
                                        $exists = GradoMateria::join('grados','grados.id','=','grado_materias.grado_id')
                                            ->where('docente_id', $value)
                                            ->where('dia_id', $get('dia_id'))
                                            ->where('hora_id', $get('hora_id'))
                                            ->where('year',$get('../../year'))
                                            ->where('grados.id','!=', $get('../../id'))->limit(1)->exists();

                                        if ($exists) {
                                            $fail("El docente ya se encuentra asignado a una materia ese dia, a esa hora y ese año");
                                        }
                                    },
                                ]),
                            Select::make('aula_id')->label('Aula')
                                ->searchable()
                                ->preload()
                                ->relationship('aula','aula')
                                ->native(false),
                        ])
                        ->reorderable()
                        ->collapsible()
                        ->cloneable()
                        ->columns(3)
                        ->addActionLabel('Añadir materia')
                        ->columnSpan(2)
                    ]),
                ])
                ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tipogrado.name')->label('Grado'),
                TextColumn::make('group')->label('Grupo'),
                TextColumn::make('year')->label('Año'),
                TextColumn::make('jornada.name')->label('Jornada'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\Action::make('viewPdf')
                //     ->color('#666666')
                //     ->label('Ver PDF')
                //     ->url(fn ($record) =>  route('admin.grado.pdf', ['grado'=>$record->id]),true),
                // Tables\Actions\Action::make('sendPdf')
                //     ->label('Enviar PDF')
                //     ->modal()
                //     ->form(function(Form $form, $record){
                //         return $form
                //             ->schema([
                //                 TextInput::make('asunto')->default($record->group)->required(),
                //                 TextInput::make('destino')->email()->required(),
                //                 Textarea::make('mensaje')->required(),
                //             ]);
                //     })
                //     ->action(function($record, array $data){

                //         try {
                //             $pdf = Pdf::loadView('pdf.test', [
                //                 'grado'=> $record
                //             ]);
    
                //             Mail::send('emails.index', ['data' => $data] , function ($message) use ($data,$pdf) {
                //                 $message->to($data['destino'])
                //                         ->from('supadmin@iegonzalez.com')
                //                         ->subject($data['asunto'])
                //                         ->attachData($pdf->output(), $data['asunto'].'.pdf');
                //             });
                //             Notification::make()->title('Correo enviado correctamente.')
                //                 ->success()->send();
                //         } catch (\Throwable $th) {
                //             Notification::make()->title('Hubo un error al enviar el correo.')
                //             ->danger()->send();
                //         }
                //     }),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGrados::route('/'),
            'create' => Pages\CreateGrado::route('/create'),
            'edit' => Pages\EditGrado::route('/{record}/edit')
        ];
    }
}
