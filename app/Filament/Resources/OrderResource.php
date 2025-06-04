<?php

namespace App\Filament\Resources;

use App\Enums\OrderStatus;
use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\Pages\ViewOrder;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'iconpark-bill-o';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        $viewPage = fn ($livewire) => $livewire instanceof ViewOrder;

        return $form
            ->schema([
                Forms\Components\TextInput::make('unique_id')
                    ->label('Unique ID')
                    ->required()
                    ->visible($viewPage),
                Forms\Components\Select::make('status')
                    ->required()
                    ->options(
                        collect(OrderStatus::cases())
                        ->mapWithKeys(fn ($case) => [$case->value => $case->name])
                        ->toArray()
                    ),
                Fieldset::make('User details')
                    ->schema([
                        Forms\Components\TextInput::make('user_id')
                            ->label('User ID')
                            ->required()
                            ->numeric()
                            ->suffixAction(
                                Action::make('userModal')
                                    ->icon('tni-user')
                                    ->tooltip('Show user')
                                    ->modalHeading('User info')
                                    ->modalSubmitAction(false)
                                    ->modalCancelAction(false)
                                    ->modalContent(fn ($record) => view('filament.user-modal', ['user' => $record->user])),
                            ),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                    ])
                    ->visible($viewPage),
                Fieldset::make('Delivery details')
                    ->schema([
                        Forms\Components\TextInput::make('delivery_name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('delivery_surname')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('delivery_address')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('delivery_zipcode')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('delivery_province')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('delivery_country')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('delivery_phone')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('delivery_comments')
                            ->autosize(),
                    ])
                    ->visible($viewPage),
                Fieldset::make('Billing details')
                    ->schema([
                        Forms\Components\TextInput::make('bill_name')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('bill_surname')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('bill_address')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('bill_zipcode')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('bill_province')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('bill_country')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('bill_identity_card')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('bill_fiscal_name')
                            ->maxLength(255),
                    ])
                    ->visible($viewPage),
                Fieldset::make('Payment details')
                    ->schema([
                        Forms\Components\TextInput::make('payment_method')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Toggle::make('paid')
                            ->inline(false)
                            ->required(),
                        Forms\Components\DateTimePicker::make('paid_at'),
                        Forms\Components\TextInput::make('total_price')
                            ->required()
                            ->numeric()
                            ->prefix('€'),
                        Forms\Components\TextInput::make('tax_price')
                            ->required()
                            ->numeric()
                            ->prefix('€'),
                        Forms\Components\TextInput::make('subtotal_price')
                            ->required()
                            ->numeric()
                            ->prefix('€'),
                        Forms\Components\TextInput::make('shipping_price')
                            ->required()
                            ->numeric()
                            ->prefix('€'),
                        Forms\Components\TextInput::make('shipping_tax')
                            ->required()
                            ->numeric()
                            ->prefix('€'),
                        Forms\Components\TextInput::make('discounted_price')
                            ->numeric()
                            ->prefix('€'),
                        Forms\Components\TextInput::make('coupon_id')
                            ->label('Coupon ID')
                            ->numeric()
                            ->suffixAction(
                                Action::make('couponModal')
                                    ->icon('iconsax-lin-discount-shape')
                                    ->tooltip('Show Coupon')
                                    ->modalHeading('Coupon info')
                                    ->modalSubmitAction(false)
                                    ->modalCancelAction(false)
                                    ->modalContent(fn ($record) => view('filament.coupon-modal', ['coupon' => $record->coupon]))
                                    ->visible(fn ($record) => !is_null($record->coupon_id)),
                            ),
                    ])
                    ->visible($viewPage),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->searchable(),
                Tables\Columns\IconColumn::make('paid')
                    ->boolean(),
                Tables\Columns\TextColumn::make('total_price')
                    ->money('EUR', locale: 'es')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->formatStateUsing(fn ($state) => OrderStatus::from($state)->name)
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->iconButton(),
                Tables\Actions\EditAction::make()->iconButton(),
                Tables\Actions\DeleteAction::make()->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultPaginationPageOption(25);
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
            'index' => Pages\ListOrders::route('/'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
            'view' => Pages\ViewOrder::route('/{record}'),
        ];
    }
}
