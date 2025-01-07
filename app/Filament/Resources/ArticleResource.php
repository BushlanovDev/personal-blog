<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\ArticleStatusEnum;
use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use App\Models\Tag;
use Carbon\Carbon;
use Closure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getEloquentQuery(): Builder
    {
        return Article::with(['category', 'tags']);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('status')
                    ->required()
                    ->options(ArticleStatusEnum::class)
                    ->default(ArticleStatusEnum::Draft),
                Forms\Components\Select::make('category_id')
                    ->required()
                    ->relationship('category', 'name'),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, string $state) {
                        $set('slug', Str::slug($state));
                    }),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
//                Forms\Components\TagsInput::make('tags.id')
//                    ->suggestions(static::getTags())
//                    ->afterStateHydrated(function (?Article $record, Forms\Components\TagsInput $component) {
//                        if ($record === null) {
//                            return;
//                        }
//                        $component->state($record->tags->pluck('name'));
//                    }),
//                CheckboxList::make('tags')
//                    ->relationship('tags', 'name')
//                    ->columns(3)
//                    ->gridDirection('row'),
                Forms\Components\Select::make('tags')
                    ->multiple()
                    ->searchable()
                    ->relationship('tags', 'name')
                    ->preload(),
                Forms\Components\DatePicker::make('published_at')
                    ->required()
                    ->default(Carbon::now()),
                Forms\Components\FileUpload::make('image_preview')
                    ->image()
                    ->directory('article-images')
                    ->preserveFilenames(false)
                    ->fetchFileInformation(false),
                Forms\Components\FileUpload::make('image_detail')
                    ->image()
                    ->directory('article-images')
                    ->preserveFilenames(false)
                    ->fetchFileInformation(false),
                Forms\Components\Textarea::make('text_preview')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('text_detail')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->date()
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
