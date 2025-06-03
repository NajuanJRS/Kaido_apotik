<?php
namespace App\Filament\Resources\KategoriObatResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\KategoriObatResource;
use Illuminate\Routing\Router;


class KategoriObatApiService extends ApiService
{
    protected static string | null $resource = KategoriObatResource::class;

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
