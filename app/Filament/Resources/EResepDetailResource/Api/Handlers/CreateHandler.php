<?php
namespace App\Filament\Resources\EResepDetailResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\EResepDetailResource;
use App\Filament\Resources\EResepDetailResource\Api\Requests\CreateEResepDetailRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = EResepDetailResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create EResepDetail
     *
     * @param CreateEResepDetailRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateEResepDetailRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}