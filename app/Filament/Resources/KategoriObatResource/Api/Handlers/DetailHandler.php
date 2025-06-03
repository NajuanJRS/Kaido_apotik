<?php

namespace App\Filament\Resources\KategoriObatResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\KategoriObatResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\KategoriObatResource\Api\Transformers\KategoriObatTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = KategoriObatResource::class;


    /**
     * Show KategoriObat
     *
     * @param Request $request
     * @return KategoriObatTransformer
     */
    public function handler(Request $request)
    {
        $id = $request->route('id');
        
        $query = static::getEloquentQuery();

        $query = QueryBuilder::for(
            $query->where(static::getKeyName(), $id)
        )
            ->first();

        if (!$query) return static::sendNotFoundResponse();

        return new KategoriObatTransformer($query);
    }
}
