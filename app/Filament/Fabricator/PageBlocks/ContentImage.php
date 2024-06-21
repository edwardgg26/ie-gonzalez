<?php

namespace App\Filament\Fabricator\PageBlocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Z3d0X\FilamentFabricator\PageBlocks\PageBlock;

class ContentImage extends PageBlock
{
    public static function getBlockSchema(): Block
    {
        return Block::make('content-image')
            ->schema([

                TextInput::make('title')->required(),
                Textarea::make('content')
                    ->required(),

                FileUpload::make('image')
                    ->image()
                    ->maxFiles(1)
                    ->required()

                
            ]);
    }

    public static function mutateData(array $data): array
    {
        return $data;
    }
}