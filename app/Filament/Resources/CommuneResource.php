<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Commune;
use App\Models\Province;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Resources\CommuneResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CommuneResource\RelationManagers;

class CommuneResource extends Resource
{
    protected static ?string $model = Commune::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label(__('name'))->required(),
                Select::make('province_id')->label(__('Province'))
                    ->native(false)->searchable()->preload()->required()
                    ->relationship(name: 'province', titleAttribute: 'name')
                    ->createOptionForm([TextInput::make('name')->label(__('name'))->required()])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('#'),
                TextColumn::make('name')->label(__('name')),
                TextColumn::make('province.name')->label(__('Province')),
                TextColumn::make('orphans_count')->counts('orphans')->label(__('Orphans')),
                TextColumn::make('created_at')->dateTime()->label(__('created_at')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCommunes::route('/'),
            'create' => Pages\CreateCommune::route('/create'),
            'edit' => Pages\EditCommune::route('/{record}/edit'),
        ];
    }


    public static function getModelLabel(): string
    {
        return __('commune');
    }

    public static function getTitleCaseModelLabel(): string
    {
        return __('Commune');
    }

    public static function getTitleCasePluralModelLabel(): string
    {
        return __('Communes');
    }

    public static function getNavigationLabel(): string
    {
        return __('Communes');
    }
}
