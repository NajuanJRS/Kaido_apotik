<?php

namespace App\Filament\Resources\EResepResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\EResepResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\EResepResource\Api\Transformers\EResepTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = EResepResource::class;


    /**
     * Show EResep
     *
     * @param Request $request
     * @return EResepTransformer
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

        return new EResepTransformer($query);
    }
}
