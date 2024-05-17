<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Magang;
use App\Models\Company;
use App\Models\Applicant;
use App\Models\Insurance;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\KeyValue;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\DeleteBulkAction;
use NunoMaduro\Collision\Adapters\Phpunit\State;
use App\Filament\Resources\InsuranceResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\InsuranceResource\RelationManagers;
use App\Filament\Resources\InsuranceResource\Pages\EditInsurance;
use App\Filament\Resources\InsuranceResource\Pages\ListInsurances;
use App\Filament\Resources\InsuranceResource\Pages\CreateInsurance;

class InsuranceResource extends Resource
{
    protected static ?string $model = Insurance::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                    Select::make('applicant_id')
                        ->relationship('applicant', 'name')
                        ->searchable()
                        ->preload()                        
                        ->required()
                        ->reactive()                        
                        ->afterStateUpdated(fn(callable $set) => $set('company_id',fn (Callable $get): Collection => Magang::query()
                        ->where('applicant_id', $get('applicant_id'))
                        ->pluck('company_id'))),                        
                    

                    TextInput::make('company_id')                                                         
                        ->required()
                        ->label('Company ID'),
                    

                    TextInput::make('tanggal_lahir')                          
                        ->default('ada')                  
                        ->disabled(),                                

                    TextInput::make('insurance_number')
                    ->required()
                    ->numeric(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('applicant.name')->searchable()->sortable()->label('Applicant Name'),
                TextColumn::make('company.company_name')->searchable()->sortable()->label('Applicant Name'),
                TextColumn::make('insurance_number')->searchable()->sortable()->label('Applicant Name'),

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
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInsurances::route('/'),
            'create' => Pages\CreateInsurance::route('/create'),
            'edit' => Pages\EditInsurance::route('/{record}/edit'),
        ];
    }    
}
