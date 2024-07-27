<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GatePassResource\Pages;
use App\Filament\Resources\GatePassResource\RelationManagers;
use App\Filament\Resources\GatePassResource\RelationManagers\GatePassRelationManager as RelationManagersGatePassRelationManager;
use App\Filament\Resources\GatePassResource\RelationManagers\ProductRelationManager;
use App\Filament\Resources\PassResource\RelationManagers\GatePassRelationManager;
use App\Models\GatePass;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GatePassResource extends Resource
{
    protected static ?string $model = GatePass::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('slip_no')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('box')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('date')
                    ->required(),
                Forms\Components\Toggle::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('slip_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('box')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
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

            ProductRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGatePasses::route('/'),
            'create' => Pages\CreateGatePass::route('/create'),
            'edit' => Pages\EditGatePass::route('/{record}/edit'),
        ];
    }
}
