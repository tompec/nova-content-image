<?php

namespace Tompec\ContentImages;

use Illuminate\Support\Str;
use Laravel\Nova\Fields\Field;

class ContentImages extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'content-images';

    public function __construct($model = null)
    {
        parent::__construct(null, null, null);

        $this->exceptOnForms();

        $media = $model->getMedia('content-image');

        $media = collect($media)->map(function ($media) use ($model) {
            return [
                'id' => $media->id,
                'url' => $media->hasGeneratedConversion('medium') ? $media->getFullUrl('medium') : $media->getFullUrl(),
                'snippet' => '![' . Str::of($media->name)->slug() . '](' . ($media->hasGeneratedConversion('medium') ? $media->getFullUrl('medium') : $media->getFullUrl()) . ')',
                'used' => Str::of($model->content)->contains(
                    $media->hasGeneratedConversion('medium') ? $media->getFullUrl('medium') : $media->getFullUrl()
                ),
            ];
        });

        $this->withMeta([
            'media' => $media,
        ]);
    }
}
