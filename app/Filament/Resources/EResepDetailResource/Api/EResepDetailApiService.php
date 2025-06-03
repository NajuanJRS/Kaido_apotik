<?php
namespace App\Filament\Resources\EResepDetailResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\EResepDetailResource;
use Illuminate\Routing\Router;


class EResepDetailApiService extends ApiService
{
    protected static string | null $resource = EResepDetailResource::class;

    public static function handlers() : array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class
        ];

    }
}
