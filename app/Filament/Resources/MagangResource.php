<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Magang;
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
use App\Filament\Resources\MagangResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MagangResource\RelationManagers;

class MagangResource extends Resource
{
    protected static ?string $model = Magang::class;

    protected static ?string $navigationIcon = 'heroicon-o-server';
    protected static ?string $navigationGroup = 'Internship Data';
    protected static ?string $slug = 'interenship-list';
    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'Internship';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                    Select::make('applicant_id')
                        ->relationship('applicant', 'name')
                        ->required()->searchable(['name'])->preload()->unique(ignoreRecord:True),
                    Select::make('company_id')
                        ->relationship('company', 'company_name')
                        ->required(),
                    DatePicker::make('join_date')->required(),
                    DatePicker::make('expired_date')->required(),
                    TextInput::make('status')->required()->columnSpan('full'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('applicant.name')->searchable()->sortable()->label('Applicant Name'),
                TextColumn::make('company.company_name')->searchable()->sortable()->label('Company Name'),
                TextColumn::make('join_date')->searchable()->sortable()->label('Join Date')->date(),
                TextColumn::make('expired_date')->searchable()->sortable()->label('Expired Date')->date(),
            ])
            ->filters([
                SelectFilter::make('company_id')
                ->options([
                    1 => 'PT. IMC',
                    2 => 'PT CPM',
                    3 => 'PT. SSI',
                    4 => 'PT. Nippisun',
                    5 => 'PT. Liwayway',
                    6 => 'PT. WPI',
                    7 => 'PT. TGP',
                ])
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
            'index' => Pages\ListMagangs::route('/'),
            'create' => Pages\CreateMagang::route('/create'),
            'edit' => Pages\EditMagang::route('/{record}/edit'),
        ];
    }    
}
