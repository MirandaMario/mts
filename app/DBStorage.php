<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Darryldecode\Cart\CartCollection;


class DatabaseStorageModel extends Model
{
    protected $table = 'cart_storage';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'cart_data',
    ];

    public function setCartDataAttribute($value)
    {
        $this->attributes['cart_data'] = serialize($value);
    }

    public function getCartDataAttribute($value)
    {
        return unserialize($value);
    }
}


/* class CacheStorage
{
    private $data = [];
    private $cart_id;

    public function __construct()
    {
        $this->cart_id = \Cookie::get('cart');
        if ($this->cart_id) {
            $this->data = \Cache::get('cart_' . $this->cart_id, []);
        } else {
            $this->cart_id = uniqid();
        }
    }

    public function has($key)
    {
        return isset($this->data[$key]);
    }

    public function get($key)
    {
        return new CartCollection($this->data[$key] ?? []);
    }

    public function put($key, $value)
    {
        $this->data[$key] = $value;
        \Cache::put('cart_' . $this->cart_id, $this->data, Carbon::now()->addDays(30));

        if (!Cookie::hasQueued('cart')) {
            Cookie::queue(
                Cookie::make('cart', $this->cart_id, 60 * 24 * 30)
            );
        }
    }
} */

class DBStorage {

public function has($key)
{
    return DatabaseStorageModel::find($key);
}

public function get($key)
{
    if($this->has($key))
    {
        return new CartCollection(DatabaseStorageModel::find($key)->cart_data);
    }
    else
    {
        return [];
    }
}

public function put($key, $value)
{
    if($row = DatabaseStorageModel::find($key))
    {
        // update
        $row->cart_data = $value;
        $row->save();
    }
    else
    {
        DatabaseStorageModel::create([
            'id' => $key,
            'cart_data' => $value
        ]);
    }
}
}