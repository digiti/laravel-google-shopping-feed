<?php

namespace Digiti\GoogleShoppingFeed;

use Digiti\GoogleShoppingFeed\Concerns\SafeEncoding;
use Digiti\GoogleShoppingFeed\Exceptions\MissingRequiredValueException;
use Spatie\ArrayToXml\ArrayToXml;

/**
 * @see \Digiti\GoogleShoppingFeed
 */
class Feed
{
    use SafeEncoding;

    /**
     * Define Google Namespace url
     * @var string
     */
    protected $namespace = 'http://base.google.com/ns/1.0';

    /**
     * @var string
     */
    protected $version = '2.0';

    /**
     * The base for the feed
     * @var array
     */
    private $feed = null;

    /**
     * @var string
     */
    private $title = '';

    /**
     * @var string
     */
    private $description = '';

    /**
     * @var string
     */
    private $link = '';

    /**
     * Stores the list of items for the feed
     * @var Item[]
     */
    private $items = array();

    /**
     * Feed constructor
     */
    public function __construct()
    {
        $this->feed = [
            'rss' => [
                '_attributes' => [
                    'xmlns:g' => 'http://base.google.com/ns/1.0',
                    'version' => '2.0',
                ]
            ]
        ];
    }

    /**
     * @param string $title
     */
    public function title($title): self
    {
        $this->title = (string) $this->safeCharEncodeText($title);
        return $this;
    }

    /**
     * @param string $description
     */
    public function description($description): self
    {
        $this->description = (string) $this->safeCharEncodeText($description);
        return $this;
    }

    /**
     * @param string $link
     */
    public function link($link): self
    {
        $this->link = (string) $this->safeCharEncodeURL($link);
        return $this;
    }

    public function addItem(Item $item): self
    {
        if(!$item->isValid())
        {
            throw new MissingRequiredValueException($item->missingValue());
        }

        $this->items[] = $item;
        return $this;
    }

    public function generate()
    {
        $this->feed['rss']['channel'] = [
            'title' => $this->title,
            'description' => $this->description,
            'link' => $this->link,
        ];

        foreach ($this->items as $key => $product) {
            $this->feed['rss']['channel']['item_'.$key] = $product->toArray();
        }

        $xml = ArrayToXml::convert($this->feed, '');
        $xml = str_replace(['    ', '<root>', '</root>', "\n", "\r", '<remove>remove</remove>'], '', $xml);
        $xml = preg_replace([
            "/item_[0-9][0-9][0-9][0-9]/",
            "/item_[0-9][0-9][0-9]/",
            "/item_[0-9][0-9]/",
            "/item_[0-9]/",
        ], "item", $xml);

        return response($xml)->header('Content-Type', 'text/xml');
    }
}
