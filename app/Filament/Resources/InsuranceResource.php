<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Company;
use App\Models\Applicant;
use App\Models\Insurance;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use NunoMaduro\Collision\Adapters\Phpunit\State;
use App\Filament\Resources\InsuranceResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\InsuranceResource\RelationManagers;
use App\Models\Magang;

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
                    Select::make('company_id')
                        ->relationship('company', 'company_name')
                        ->searchable()
                        ->preload()                        
                        ->required(),
                    Select::make('applicant_id')
                        ->options(function (callable $get){
                            $company = Magang::find($get('company_id'));
                            if(!$company)
                            {
                                return Applicant::all()->pluck('name' , 'id');
                            }

                            return $company->applicant->pluck('name', 'id');
                        }),
                    // Select::make('applicant_id')
                    //     ->options(fn (Get $get): Collection => Applicant::query()
                    //         ->where('company_id', $get('company_id'))
                    //         ->pluck('name', 'id'))
                    //     ->preload()                        
                    //     ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
