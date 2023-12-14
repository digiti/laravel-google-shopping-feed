<?php

namespace Digiti\GoogleShoppingFeed;

use Carbon\Carbon;
use Digiti\GoogleShoppingFeed\Concerns\FormatValues;
use Digiti\GoogleShoppingFeed\Concerns\SafeEncoding;
use Digiti\GoogleShoppingFeed\Enums\Adult;
use Digiti\GoogleShoppingFeed\Enums\Stock;
use Illuminate\Support\Collection;

/**
 * @see \Digiti\GoogleShoppingFeed
 */
class Item
{
    use SafeEncoding, FormatValues;

    /**
     * @var string
     */
    public string $id;

    /**
     * @var string
     */
    public string $title;

    /**
     * @var string
     */
    public string $short_title;

    /**
     * @var string
     */
    public string $description;

    /**
     * @var string
     */
    public string $link;

    /**
     * @var string
     */
    public string $image_link;

    /**
     * @var string
     */
    public string $additional_image_link;

    /**
     * @var Stock
     */
    public Stock $availability = Stock::IN_STOCK;

    /**
     * @var string
     */
    public string $availability_date;

    /**
     * @var string
     */
    public string $expiration_date;

    /**
     * @var string
     */
    public float $price;

    /**
     * @var Adult
     */
    public Adult $adult = Adult::FALSE;

    /**
     * @var array
     */
    protected array $required = [
        'id',
        'title',
        'description',
        'link',
        'image_link',
        'availability',
        'availability_date',
        'price',
        'adult',
    ];

    /**
     * @var array
     */
    protected array $excluded = [
        'required',
        'excluded'
    ];

    public function __construct()
    {
        //Set some default values
        $this->availability_date = Carbon::now()->toIso8601String();
    }

    /**
     * @param $id
     */
    public function id(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param $title
     */
    public function title(string $title): self
    {
        $this->title = $this->safeCharEncodeText($title);
        return $this;
    }

    /**
     * @param $short_title
     */
    public function short_title(string $short_title): self
    {
        $this->short_title = $this->safeCharEncodeText($short_title);
        return $this;
    }

    /**
     * @param $description
     */
    public function description(string $description): self
    {
        $this->description = $this->safeCharEncodeText($description);
        return $this;
    }

    /**
     * @param $link
     */
    public function link(string $link): self
    {
        $this->link = $this->safeCharEncodeURL($link);
        return $this;
    }

    /**
     * @param $image_link
     */
    public function image_link(string $image_link): self
    {
        $this->image_link = $this->safeCharEncodeURL($image_link);
        return $this;
    }

    /**
     * @param $additional_image_link
     */
    public function additional_image_link(string $additional_image_link): self
    {
        $this->additional_image_link = $this->safeCharEncodeURL($additional_image_link);
        return $this;
    }

    /**
     * @param $availability
     */
    public function availability(Stock $availability): Stock
    {
        $this->availability = $availability;
        return $this;
    }

    /**
     * @param $availability_date
     */
    public function availability_date(string|Carbon $availability_date): self
    {
        $this->availability_date = $this->formatDate($availability_date);
        return $this;
    }

    /**
     * @param $expiration_date
     */
    public function expiration_date(string|Carbon $expiration_date): self
    {
        $this->expiration_date = $this->formatDate($expiration_date);
        return $this;
    }

    /**
     * @param $price
     */
    public function price(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @param $adult
     */
    public function adult(Adult $adult): self
    {
        $this->adult = $adult;
        return $this;
    }

    /**
     * @param $data
     */
    public function raw(array|Collection $data): self
    {
        foreach($data as $key => $value)
        {
            if(method_exists($this,$key)){
                $this->{$key}($value);
             }
        }

        return $this;
    }

    public function isValid(): bool
    {
        foreach($this->required as $key)
        {
            if(!isset($this->{$key}))
            {
                return false;
            }
        }

        return true;
    }

    public function missingValue(): string
    {
        foreach($this->required as $key)
        {
            if(!isset($this->{$key}))
            {
                return $key;
            }
        }

        return '';
    }

    public function toArray(): array
    {
        foreach ($this as $key => $value) {
            if(isset($this->{$key}) && !in_array($key, $this->excluded))
            {
                $result[$key] = $value->value ?? $value;
            }
        }
        return $result;
    }
}
