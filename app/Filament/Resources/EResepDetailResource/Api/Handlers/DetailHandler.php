<?php

namespace App\Filament\Resources\EResepDetailResource\Api\Handlers;

use App\Filament\Resources\SettingResource;
use App\Filament\Resources\EResepDetailResource;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Filament\Resources\EResepDetailResource\Api\Transformers\EResepDetailTransformer;

class DetailHandler extends Handlers
{
    public static string | null $uri = '/{id}';
    public static string | null $resource = EResepDetailResource::class;


    /**
     * Show EResepDetail
     *
     * @param Request $request
     * @return EResepDetailTransformer
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

        return new EResepDetailTransformer($query);
    }
}
