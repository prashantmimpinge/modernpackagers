<?php

namespace Modules\Product\Entities;

use Modules\Support\Money;
use Modules\Tag\Entities\Tag;
use Modules\Media\Entities\File;
use Modules\Brand\Entities\Brand;
use Modules\Tax\Entities\TaxClass;
use Modules\Option\Entities\Option;
use Modules\Review\Entities\Review;
use Modules\Support\Eloquent\Model;
use Modules\Media\Eloquent\HasMedia;
use Modules\Meta\Eloquent\HasMetaData;
use Modules\Support\Search\Searchable;
use Modules\Category\Entities\Category;
use Modules\Product\Admin\ProductTable;
use Modules\Support\Eloquent\Sluggable;
use Modules\FlashSale\Entities\FlashSale;
use Modules\Support\Eloquent\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Attribute\Entities\ProductAttribute;

class Product extends Model
{
    use Translatable,
        Searchable,
        Sluggable,
        HasMedia,
        HasMetaData,
        SoftDeletes;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand_id',
        'tax_class_id',
        'slug',
        'sku',
        'weight',
        'price',
        'special_price',
        'special_price_type',
        'special_price_start',
        'special_price_end',
        'selling_price',
        'manage_stock',
        'qty',
        'in_stock',
        'is_active',
        'new_from',
        'new_to',
        'b_2_b',
        'discount',
        'users',
        'pMinQty'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'manage_stock' => 'boolean',
        'in_stock' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'special_price_start',
        'special_price_end',
        'new_from',
        'new_to',
        'start_date',
        'end_date',
        'deleted_at',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'base_image', 'formatted_price', 'rating_percent', 'is_in_stock', 'is_out_of_stock',
        'is_new', 'has_percentage_special_price', 'special_price_percent',
    ];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    protected $translatedAttributes = ['name', 'description', 'short_description'];

    /**
     * The attribute that will be slugged.
     *
     * @var string
     */
    protected $slugAttribute = 'name';

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    protected static function booted()
    {
        static::saved(function ($product) {
            if (! empty(request()->all())) {
                $product->saveRelations(request()->all());
                // dd(request()->all());
            }

            $product->withoutEvents(function () use ($product) {
                $product->update(['selling_price' => $product->getSellingPrice()->amount()]);
            });
        });

        static::addActiveGlobalScope();
    }

    public static function newArrivals($limit)
    {
        return static::forCard()
            ->latest()
            ->take($limit)
            ->get();
    }

    public static function list($ids = [])
    {
        return static::select('id')
            ->withName()
            ->whereIn('id', $ids)
            ->when(! empty($ids), function ($query) use ($ids) {
                $idsString = collect($ids)->filter()->implode(',');

                $query->orderByRaw("FIELD(id, {$idsString})");
            })
            ->get()
            ->mapWithKeys(function ($product) {
                return [$product->id => $product->name];
            });
    }

    public function scopeForCard($query)
    {
        $query->withName()
            ->withBaseImage()
            ->withPrice()
            ->withCount('options')
            ->with('reviews')
            ->addSelect([
                'products.id',
                'products.slug',
                'products.in_stock',
                'products.manage_stock',
                'products.qty',
                'products.new_from',
                'products.new_to',
            ]);
    }

    public function scopeWithPrice($query)
    {
        $query->addSelect([
            'products.price',
            'products.special_price',
            'products.special_price_type',
            'products.selling_price',
            'products.special_price_start',
            'products.special_price_end',
        ]);
    }

    public function scopeWithName($query)
    {
        $query->with('translations:id,product_id,locale,name');
    }

    public function scopeWithBaseImage($query)
    {
        $query->with(['files' => function ($q) {
            $q->wherePivot('zone', 'base_image');
        }]);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class)->withDefault();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function taxClass()
    {
        return $this->belongsTo(TaxClass::class)->withDefault();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function options()
    {
        return $this->belongsToMany(Option::class, 'product_options')
            ->orderBy('position')
            ->withTrashed();
    }

    public function relatedProducts()
    {
        return $this->belongsToMany(static::class, 'related_products', 'product_id', 'related_product_id');
    }

    public function upSellProducts()
    {
        return $this->belongsToMany(static::class, 'up_sell_products', 'product_id', 'up_sell_product_id');
    }

    public function crossSellProducts()
    {
        return $this->belongsToMany(static::class, 'cross_sell_products', 'product_id', 'cross_sell_product_id');
    }

    public function filter($filter)
    {
        return $filter->apply($this);
    }

    public function getPriceAttribute($price)
    {
        return Money::inDefaultCurrency($price);
    }

    public function getSpecialPriceAttribute($specialPrice)
    {
        if (! is_null($specialPrice)) {
            return Money::inDefaultCurrency($specialPrice);
        }
    }

    public function getSellingPriceAttribute($sellingPrice)
    {
        if (FlashSale::contains($this)) {
            $sellingPrice = FlashSale::pivot($this)->price->amount();
        }

        return Money::inDefaultCurrency($sellingPrice);
    }

    public function getTotalAttribute($total)
    {
        return Money::inDefaultCurrency($total);
    }

    /**
     * Get the product's base image.
     *
     * @return \Modules\Media\Entities\File
     */
    public function getBaseImageAttribute()
    {
        return $this->files->where('pivot.zone', 'base_image')->first() ?: new File;
    }

    /**
     * Get product's additional images.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAdditionalImagesAttribute()
    {
        return $this->files
            ->where('pivot.zone', 'additional_images')
            ->sortBy('pivot.id');
    }

    public function getFormattedPriceAttribute()
    {
        return product_price_formatted($this);
    }

    public function getRatingPercentAttribute()
    {
        if ($this->relationLoaded('reviews')) {
            return $this->ratingPercent();
        }
    }

    public function getIsInStockAttribute()
    {
        return $this->isInStock();
    }

    public function getIsOutOfStockAttribute()
    {
        return $this->isOutOfStock();
    }

    public function getIsNewAttribute()
    {
        return $this->isNew();
    }

    public function getHasPercentageSpecialPriceAttribute()
    {
        return $this->hasPercentageSpecialPrice();
    }

    public function getSpecialPricePercentAttribute()
    {
        return $this->getSpecialPricePercent();
    }

    public function getAttributeSetsAttribute()
    {
        return $this->getAttribute('attributes')->groupBy('attributeSet');
    }

    public function url()
    {
        return route('products.show', ['slug' => $this->slug]);
    }

    public function isInStock()
    {
        if (FlashSale::contains($this)) {
            return FlashSale::remainingQty($this) > 0;
        }

        if ($this->manage_stock && $this->qty === 0) {
            return false;
        }

        return $this->in_stock;
    }

    public function isOutOfStock()
    {
        return ! $this->isInStock();
    }

    public function outOfStock()
    {
        $this->update(['in_stock' => false]);
    }

    public function hasAnyAttribute()
    {
        return $this->getAttribute('attributes')->isNotEmpty();
    }

    public function hasAnyOption()
    {
        return $this->options->isNotEmpty();
    }

    public function getSellingPrice()
    {
        if ($this->hasSpecialPrice()) {
            return $this->getSpecialPrice();
        }

        return $this->price;
    }
     public function productWeight()
    {
         return $this->weight;
    }
    public function getSpecialPrice()
    {
        $specialPrice = $this->attributes['special_price'];

        if ($this->special_price_type === 'percent') {
            $discountedPrice = ($specialPrice / 100) * $this->attributes['price'];

            $specialPrice = $this->attributes['price'] - $discountedPrice;
        }

        if ($specialPrice < 0) {
            $specialPrice = 0;
        }

        return Money::inDefaultCurrency($specialPrice);
    }

    public function hasPercentageSpecialPrice()
    {
        return $this->hasSpecialPrice() && $this->special_price_type === 'percent';
    }

    public function getSpecialPricePercent()
    {
        if ($this->hasPercentageSpecialPrice()) {
            return round($this->special_price->amount(), 2);
        }
    }

    public function hasSpecialPrice()
    {
        if (is_null($this->special_price)) {
            return false;
        }

        if ($this->hasSpecialPriceStartDate() && $this->hasSpecialPriceEndDate()) {
            return $this->specialPriceStartDateIsValid() && $this->specialPriceEndDateIsValid();
        }

        if ($this->hasSpecialPriceStartDate()) {
            return $this->specialPriceStartDateIsValid();
        }

        if ($this->hasSpecialPriceEndDate()) {
            return $this->specialPriceEndDateIsValid();
        }

        return true;
    }

    private function hasSpecialPriceStartDate()
    {
        return ! is_null($this->special_price_start);
    }

    private function hasSpecialPriceEndDate()
    {
        return ! is_null($this->special_price_end);
    }

    private function specialPriceStartDateIsValid()
    {
        return today() >= $this->special_price_start;
    }

    private function specialPriceEndDateIsValid()
    {
        return today() <= $this->special_price_end;
    }

    public function ratingPercent()
    {
        return ($this->reviews->avg->rating / 5) * 100;
    }

    public function isNew()
    {
        if ($this->hasNewFromDate() && $this->hasNewToDate()) {
            return $this->newFromDateIsValid() && $this->newToDateIsValid();
        }

        if ($this->hasNewFromDate()) {
            return $this->newFromDateIsValid();
        }

        if ($this->hasNewToDate()) {
            return $this->newToDateIsValid();
        }

        return false;
    }

    private function hasNewFromDate()
    {
        return ! is_null($this->new_from);
    }

    private function hasNewToDate()
    {
        return ! is_null($this->new_to);
    }

    private function newFromDateIsValid()
    {
        return today() >= $this->new_from;
    }

    private function newToDateIsValid()
    {
        return today() <= $this->new_to;
    }

    public function relatedProductList()
    {
        return $this->relatedProducts()
            ->withoutGlobalScope('active')
            ->pluck('related_product_id');
    }

    public function upSellProductList()
    {
        return $this->upSellProducts()
            ->withoutGlobalScope('active')
            ->pluck('up_sell_product_id');
    }

    public function crossSellProductList()
    {
        return $this->crossSellProducts()
            ->withoutGlobalScope('active')
            ->pluck('cross_sell_product_id');
    }

    public static function findBySlug($slug)
    {
        return self::with([
            'categories', 'tags', 'attributes.attribute.attributeSet',
            'options', 'files', 'relatedProducts', 'upSellProducts',
        ])
        ->where('slug', $slug)
        ->firstOrFail();
    }

    public function clean()
    {
        return array_except($this->toArray(), [
            'description',
            'weight',
            'short_description',
            'translations',
            'categories',
            'files',
            'is_active',
            'in_stock',
            'brand_id',
            'tax_class',
            'tax_class_id',
            'viewed',
            'created_at',
            'updated_at',
            'deleted_at',
        ]);
    }

    /**
     * Get table data for the resource
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function table($request)
    {
        $query = $this->newQuery()
            ->withoutGlobalScope('active')
            ->withName()
            ->withBaseImage()
            ->withPrice()
            ->addSelect(['id', 'is_active', 'created_at'])
            ->when($request->has('except'), function ($query) use ($request) {
                $query->whereNotIn('id', explode(',', $request->except));
            });

        return new ProductTable($query);
    }

    /**
     * Save associated relations for the product.
     *
     * @param array $attributes
     * @return void
     */
    public function saveRelations($attributes = [])
    {
        $this->categories()->sync(array_get($attributes, 'categories', []));
        $this->tags()->sync(array_get($attributes, 'tags', []));
        $this->upSellProducts()->sync(array_get($attributes, 'up_sells', []));
        $this->crossSellProducts()->sync(array_get($attributes, 'cross_sells', []));
        $this->relatedProducts()->sync(array_get($attributes, 'related_products', []));
    }

    /**
     * Get the indexable data array for the product.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        // MySQL Full-Text search handles indexing automatically.
        if (config('scout.driver') === 'mysql') {
            return [];
        }

        $translations = $this->translations()
            ->withoutGlobalScope('locale')
            ->get(['name', 'description', 'short_description']);

        return ['id' => $this->id, 'translations' => $translations];
    }

    public function searchTable()
    {
        return 'product_translations';
    }

    public function searchKey()
    {
        return 'product_id';
    }

    public function searchColumns()
    {
        return ['name'];
    }
}
