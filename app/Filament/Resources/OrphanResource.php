<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Widow;
use App\Models\Orphan;
use App\Models\Commune;
use App\Models\Province;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\OrphanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OrphanResource\RelationManagers;

class OrphanResource extends Resource
{
    protected static ?string $model = Orphan::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('widow_id')->label(__('Widow'))
                    ->relationship('widow','fullname')
                    ->native(false)->searchable()->preload()->required(),
                TextInput::make('fullname')->label(__('fullname'))->required(),
                DatePicker::make('birthdate')->label(__('birthdate'))->required(),
                Select::make('commune_id')->label(__('birthplace'))
                    ->native(false)->searchable()->preload()->required()
                    ->relationship('commune','name')
                    ->createOptionForm([
                        TextInput::make('name')->label(__('name'))->required(),
                        Select::make('province_id')->label(__('Province'))->options(Province::get()->pluck('name', 'id'))->required()]),
                TextInput::make('occupation')->label(__('occupation')),
                TextInput::make('workplace')->label(__('workplace')),
                Textarea::make('health_status')->label(__('health_status')),


                Fieldset::make()
                    ->schema([
                        Toggle::make('married')->label(__('married'))->default(false),
                        Toggle::make('at_home')->label(__('at_home'))->default(false),
                    ])
                    ->columns(1)->columnSpan(1)


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('#'),
                TextColumn::make('fullname')->label(__('name')),
                TextColumn::make('widow.fullname')->label(__('Widow')),
                TextColumn::make('created_at')->dateTime()->label(__('created_at'))
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
            'index' => Pages\ListOrphans::route('/'),
            'create' => Pages\CreateOrphan::route('/create'),
            'edit' => Pages\EditOrphan::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('orphan');
    }

    public static function getTitleCaseModelLabel(): string
    {
        return __('Orphan');
    }

    public static function getTitleCasePluralModelLabel(): string
    {
        return __('Orphans');
    }

    public static function getNavigationLabel(): string
    {
        return __('Orphans');
    }
}
