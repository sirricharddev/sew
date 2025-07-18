<?php

namespace App\Models;

use App\Enums\Status;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $table = "products";
    protected $fillable = [
        'name',
        'slug',
        'sku',
        'product_category_id',
        'product_brand_id',
        'barcode_id',
        'unit_id',
        'buying_price',
        'selling_price',
        'variation_price',
        'status',
        'order',
        'can_purchasable',
        'show_stock_out',
        'maximum_purchase_quantity',
        'low_stock_quantity_warning',
        'weight',
        'warranty',
        'refundable',
        'description',
        'shipping_and_return',
        'add_to_flash_sale',
        'discount',
        'offer_start_date',
        'offer_end_date',
        'shipping_type',
        'shipping_cost',
        'is_product_quantity_multiply',

    ];
    protected array $dates = ['deleted_at'];
    protected $casts = [
        'id'                           => 'integer',
        'name'                         => 'string',
        'slug'                         => 'string',
        'sku'                          => 'string',
        'product_category_id'          => 'integer',
        'product_brand_id'             => 'integer',
        'barcode_id'                   => 'integer',
        'unit_id'                      => 'integer',
        'buying_price'                 => 'decimal:6',
        'selling_price'                => 'decimal:6',
        'variation_price'              => 'decimal:6',
        'status'                       => 'integer',
        'order'                        => 'integer',
        'can_purchasable'              => 'integer',
        'show_stock_out'               => 'integer',
        'maximum_purchase_quantity'    => 'integer',
        'low_stock_quantity_warning'   => 'integer',
        'weight'                       => 'string',
        'warranty'                     => 'string',
        'refundable'                   => 'integer',
        'description'                  => 'string',
        'shipping_and_return'          => 'string',
        'add_to_flash_sale'            => 'integer',
        'discount'                     => 'decimal:6',
        'offer_start_date'             => 'string',
        'offer_end_date'               => 'string',
        'shipping_type'                => 'integer',
        'shipping_cost'                => 'string',
        'is_product_quantity_multiply' => 'integer',

    ];

    public function scopeActive($query, $col = 'status')
    {
        return $query->where($col, Status::ACTIVE);
    }

    public function scopeRandAndLimitOrOrderBy($query, $rand = 0, $orderColumn = 'id', $orderType = 'asc')
    {
        if ($rand > 0) {
            return $query->inRandomOrder()->limit($rand);
        }
        return $query->orderBy($orderColumn, $orderType);
    }

    public function getImageAttribute(): string
    {
        if (!empty($this->getFirstMediaUrl('product'))) {
            return asset($this->getFirstMediaUrl('product'));
        }
        return asset('images/default/product/thumb.png');
    }

    public function getImagesAttribute(): array
    {
        $response = [];
        if (!empty($this->getFirstMediaUrl('product'))) {
            $images = $this->getMedia('product');
            foreach ($images as $image) {
                $response[] = $image['original_url'];
            }
        }
        return $response;
    }

    public function getThumbAttribute(): string
    {
        if (!empty($this->getFirstMediaUrl('product'))) {
            $product = $this->getMedia('product')->first();
            return $product->getUrl('thumb');
        }
        return asset('images/default/product/thumb.png');
    }

    public function getCoverAttribute(): string
    {
        if (!empty($this->getFirstMediaUrl('product'))) {
            $product = $this->getMedia('product')->first();
            return $product->getUrl('cover');
        }
        return asset('images/default/product/cover.png');
    }

    public function getPreviewAttribute(): string
    {
        if (!empty($this->getFirstMediaUrl('product'))) {
            $product = $this->getMedia('product')->first();
            return $product->getUrl('preview');
        }
        return asset('images/default/product/preview.png');
    }

    public function getPreviewsAttribute(): array
    {
        $response = [];
        if (!empty($this->getFirstMediaUrl('product'))) {
            $images = $this->getMedia('product');
            foreach ($images as $image) {
                $response[] = $image->getUrl('preview');
            }
        }
        return $response;
    }

    public function getBarcodeImageAttribute(): string
    {
        if (!empty($this->getFirstMediaUrl('product-barcode'))) {
            return asset($this->getFirstMediaUrl('product-barcode'));
        }
        return '';
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->crop('crop-center', 168, 180)->keepOriginalImageFormat()->sharpen(10);
        $this->addMediaConversion('cover')->crop('crop-center', 372, 405)->keepOriginalImageFormat()->sharpen(10);
        $this->addMediaConversion('preview')->crop('crop-center', 1536, 1536)->keepOriginalImageFormat()->sharpen(10);
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }

    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductBrand::class, 'product_brand_id', 'id');
    }

    public function barcode(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Barcode::class, 'barcode_id', 'id');
    }

    public function unit(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function variations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductVariation::class)->with('productAttribute');
    }

    public function orders(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Stock::class, 'model');
    }

    public function orderCountable(): HasMany
    {
        return $this->hasMany(Stock::class, 'product_id', 'id');
    }

    public function tags(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductTag::class, 'product_id', 'id');
    }

    public function reviews(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductReview::class, 'product_id', 'id');
    }

    public function videos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductVideo::class, 'product_id', 'id');
    }

    public function seo(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProductSeo::class, 'product_id', 'id');
    }

    public function scopeWithReviewRating($query)
    {
        $reviewsStar      = ProductReview::selectRaw('sum(star)')->whereColumn('product_id', 'products.id')->getQuery();
        $reviewsStarCount = ProductReview::selectRaw('count(product_id)')->whereColumn('product_id', 'products.id')->getQuery();
        $base             = $query->getQuery();
        if (is_null($base->columns)) {
            $query->select([$base->from . '.*']);
        }
        return $query->selectSub($reviewsStar, 'rating_star')->selectSub($reviewsStarCount, 'rating_star_count');
    }

    public function wishlist()
    {
        return $this->hasOne(Wishlist::class);
    }

    public function averageRating()
    {
        return $this->reviews()->avg('star');
    }

    public function reviewCount(): int
    {
        return $this->reviews()->count();
    }

    public function stocks(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Stock::class, 'item');
    }

    public function stockItems(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->stocks()->where('status', Status::ACTIVE);
    }

    public function taxes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductTax::class, 'product_id', 'id');
    }

    public function productTaxes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductTax::class);
    }

    public function productOrders(): HasMany
    {
        return $this->hasMany(Stock::class, 'product_id', 'id')->where('model_type', Order::class);
    }

    public function userReview(): \Illuminate\Database\Eloquent\Relations\hasOne
    {
        return $this->hasOne(ProductReview::class, 'product_id', 'id')->where('user_id', Auth::user()->id);
    }
}
