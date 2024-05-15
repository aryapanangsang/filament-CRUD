<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Applicant;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ApplicantResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ApplicantResource\RelationManagers;

class ApplicantResource extends Resource
{
    protected static ?string $model = Applicant::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([                        
                        TextInput::make('name'),
                        TextInput::make('tempat_lahir'),
                        DatePicker::make('tanggal_lahir'),  
                        Select::make('gender')
                            ->options([
                                'Laki-laki' => 'Laki-laki',
                                'Perempuan' => 'Perempuan'
                            ]),
                        TextInput::make('alamat'),
                        TextInput::make('domisili'),
                        TextInput::make('no_hp')->numeric(),
                        TextInput::make('no_hp_darurat')->numeric(),
                        TextInput::make('tinggi_badan')->numeric(),
                        TextInput::make('berat_badan')->numeric(),
                        Select::make('kantor_tujuan')->options([
                                'Cikarang' => 'Cikarang',
                                'Purwakarta' => 'Purwakarta'
                            ]),
                        TextInput::make('email')
                            ->email()->required()->unique(ignoreRecord: True),
                        TextInput::make('password')
                            ->password(),                        
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('tempat_lahir')->sortable()->searchable(),
                TextColumn::make('tanggal_lahir')
                    ->date()->sortable()->searchable(),
                TextColumn::make('gender')->sortable()->searchable(),
                TextColumn::make('alamat')->sortable()->searchable(),
                TextColumn::make('domisili')->sortable()->searchable(),
                TextColumn::make('no_hp')->sortable()->searchable(),
                TextColumn::make('no_hp_darurat')->sortable()->searchable(),
                TextColumn::make('tinggi_badan')->sortable()->searchable(),
                TextColumn::make('berat_badan')->sortable()->searchable(),
                TextColumn::make('kantor_tujuan')->sortable()->searchable(),
                TextColumn::make('email')->sortable()->searchable(),

                
            ])
            ->filters([
                SelectFilter::make('kantor_tujuan')
                    ->options([
                        'Cikarang' => 'Kantor Cikarang',
                        'Purwakarta' => 'Purwakarta'
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListApplicants::route('/'),
            'create' => Pages\CreateApplicant::route('/create'),
            'edit' => Pages\EditApplicant::route('/{record}/edit'),
        ];
    }    
}
