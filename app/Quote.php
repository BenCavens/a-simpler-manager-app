<?php
declare(strict_types=1);

namespace App;

use Thinktomorrow\Chief\Fields\Fields;
use Illuminate\Database\Eloquent\Model;
use Thinktomorrow\AssetLibrary\HasAsset;
use Thinktomorrow\AssetLibrary\AssetTrait;
use Thinktomorrow\Chief\Fields\Types\TextField;
use Thinktomorrow\Chief\Fields\Types\FileField;
use Thinktomorrow\Chief\Fields\Types\InputField;
use Thinktomorrow\Chief\ManagedModels\ManagedModel;
use Thinktomorrow\Chief\Concerns\Morphable\Morphable;
use Thinktomorrow\Chief\FlatReferences\FlatReference;
use Thinktomorrow\Chief\ModelReferences\ModelReference;
use Thinktomorrow\DynamicAttributes\HasDynamicAttributes;
use Thinktomorrow\Chief\PageBuilder\Relations\ActsAsChild;
use Thinktomorrow\Chief\PageBuilder\Relations\ActingAsChild;
use Thinktomorrow\Chief\Concerns\Morphable\MorphableContract;
use Thinktomorrow\Chief\ManagedModels\Assistants\ManagedModelDefaults;

class Quote extends Model implements ManagedModel, HasAsset, MorphableContract, ActsAsChild
{
    use ManagedModelDefaults;
    use HasDynamicAttributes;
    use AssetTrait;
    use Morphable;
    use ActingAsChild;

    public $dynamicKeys = ['title','content'];

    public $table = 'modules';
    public $guarded = [];

    public function fields(): Fields
    {
        return new Fields([
            InputField::make('title')->locales()->tag('create'),
            TextField::make('content')->locales(),
            FileField::make('doc')->locales()->multiple(),
        ]);
    }

    /**
     * This is an optional method for the DynamicAttributes behavior and allows for
     * proper localized values to be returned. Here we provide the default in
     * advance in case the model decides to make use of DynamicAttributes.
     *
     * @return array
     */
    public function dynamicLocales(): array
    {
        return config('thinktomorrow.chief.locales');
    }

    public function modelReference(): ModelReference
    {
        return new ModelReference(get_class($this), $this->id);
    }

    public function modelReferenceLabel(): string
    {
        return $this->title;
    }

    public function modelReferenceGroup(): string
    {
        return 'quotes';
    }
}
