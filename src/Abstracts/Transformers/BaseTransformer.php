<?php

namespace Kaum\Harreek\Abstracts\Transformers;

use Illuminate\Contracts\Auth\Authenticatable;
use League\Fractal\TransformerAbstract as SpatieTransformer;

abstract class BaseTransformer extends SpatieTransformer
{
    /**
     * The Authenticated User
     *
     * @return Authenticatable|null
     */
    public function user(): ?Authenticatable {
        return Auth::user();
    }

    public function admin($adminResponse, $clientResponse): array {
        $user = $this->user();

        // TODO: Check for user to be admin & merge client adn admin response together.

        return $clientResponse;
    }
}