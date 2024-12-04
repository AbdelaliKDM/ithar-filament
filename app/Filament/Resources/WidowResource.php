<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Widow;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\WidowResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\WidowResource\RelationManagers;

class WidowResource extends Resource
{
    protected static ?string $model = Widow::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('fullname')->label(__('fullname'))->required(),
                DatePicker::make('birthdate')->label(__('birthdate'))->required(),
                TextInput::make('phone')->label(__('phone'))->tel()->required(),
                //TextInput::make('salary')->label(__('salary'))->numeric()->required(),
                Select::make('education_level')->label(__('education_level'))->options([
                    'prim' => __('prim'),
                    'bem' => __('bem'),
                    'bac' => __('bac'),
                    'univ' => __('univ')
                ])->native(false)->required(),
                TextInput::make('address')->label(__('address')),
                TextInput::make('occupation')->label(__('occupation')),
                TextInput::make('ccp_number')->label(__('ccp_number')),
                Textarea::make('health_status')->label(__('health_status')),

                Fieldset::make()->schema([
                    Toggle::make('insurance')->label(__('insurance'))->default(false),
                ])->columns(1)->columnSpan(1),

                Fieldset::make('spouse')->label(__('Spouse'))->relationship('spouse')
                    ->schema([
                        TextInput::make('name')->label(__('fullname')),
                        DatePicker::make('birthdate')->label(__('birthdate')),
                        DatePicker::make('deathdate')->label(__('deathdate')),
                    ])->columns(3),

                Fieldset::make(label: 'household')->label(__('Household'))->relationship('household')
                    ->schema([
                        Select::make('housing_type')->label(__('housing_type'))->options([
                            'family' => __('family'),
                            'standalone' => __('standalone'),
                            'rent' => __('rent'),
                        ])->native(false)->required(),

                        Select::make('building_type')->label(__('building_type'))->options([
                            'gypsum' => __('gypsum'),
                            'cement' => __('cement'),
                        ])->native(false)->required(),

                        Select::make('building_condition')->label(__('building_condition'))->options([
                            'good' => __('good'),
                            'medium' => __('medium'),
                            'bad' => __('bad'),
                        ])->native(false)->required(),


                        Select::make('furniture_condition')->label(__('furniture_condition'))->options([
                            'good' => __('good'),
                            'medium' => __('medium'),
                            'bad' => __('bad'),
                        ])->native(false)->required(),


                        Select::make('clothing_condition')->label(__('clothing_condition'))->options([
                            'good' => __('good'),
                            'medium' => __('medium'),
                            'bad' => __('bad'),
                        ])->native(false)->required(),


                        TextInput::make('rent_cost')->label(__('rent_cost'))->numeric()->default(0),
                        TextInput::make('members_num')->label(__('members_num'))->numeric()->default(0),
                        TextInput::make('students_num')->label(__('students_num'))->numeric()->default(0),

                        Fieldset::make()->schema([
                            Toggle::make('has_fridge')->label(__('has_fridge'))->default(false),
                            Toggle::make('has_cooker')->label(__('has_cooker'))->default(false),
                        ])->columns(1)->columnSpan(1),

                        Fieldset::make()->schema([
                            Toggle::make('has_tv')->label(__('has_tv'))->default(false),
                            Toggle::make('has_ac')->label(__('has_ac'))->default(false),
                        ])->columns(1)->columnSpan(1),

                        ]),

                Repeater::make('incomes')->label(label: __('Incomes'))
                    ->relationship('incomes')
                    ->schema([
                        TextInput::make('name')->label(label: __('source'))
                            ->required(),

                        TextInput::make('amount')->label(label: __('amount'))
                            ->numeric()
                            ->required(),

                        Select::make('type')->label(label: __('type'))
                            ->options([
                                'salary' => 'Salary',
                                'bonus' => 'Bonus'
                            ])->native(false)->required()
                    ])->columns(3)->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('#'),
                TextColumn::make('fullname')->label(__('name')),
                TextColumn::make('spouse.name')->label(__('Spouse')),
                TextColumn::make('orphans_count')->counts('orphans')->label(__('Orphans')),
                TextColumn::make('salaries_sum_amount')->sum('salaries', 'amount')->label(__('salaries')),
                TextColumn::make('bonuses_sum_amount')->sum('bonuses', 'amount')->label(__('bonuses')),
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
            'index' => Pages\ListWidows::route('/'),
            'create' => Pages\CreateWidow::route('/create'),
            'edit' => Pages\EditWidow::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('widow');
    }

    public static function getTitleCaseModelLabel(): string
    {
        return __('Widow');
    }

    public static function getTitleCasePluralModelLabel(): string
    {
        return __('Widows');
    }

    public static function getNavigationLabel(): string
    {
        return __('Widows');
    }
}
