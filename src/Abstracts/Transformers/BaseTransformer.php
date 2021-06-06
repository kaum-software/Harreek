<?php

use Illuminate\Contracts\Auth\Authenticatable;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract as SpatieTransformer;
use League\Fractal\Resource\Collection;

class BaseTransformer extends SpatieTransformer
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