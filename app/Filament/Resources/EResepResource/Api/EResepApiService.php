<?php
namespace App\Filament\Resources\EResepResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\EResepResource;
use Illuminate\Routing\Router;


class EResepApiService extends ApiService
{
    protected static string | null $resource = EResepResource::class;

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
