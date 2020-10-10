<?php
declare(strict_types=1);

namespace App;

use Thinktomorrow\Chief\Fields\Fields;
use Illuminate\Database\Eloquent\Model;
use Thinktomorrow\AssetLibrary\HasAsset;
use Thinktomorrow\AssetLibrary\AssetTrait;
use Thinktomorrow\Chief\Fields\Types\TextField;
use Thinktomorrow\Chief\Fields\Types\FileField;
use Thinktomorrow\Chief\ModelReferences\ModelReference;
use Thinktomorrow\Chief\PageBuilder\Relations\ActsAsChild;
use Thinktomorrow\Chief\PageBuilder\Relations\ActsAsParent;
use Thinktomorrow\Chief\Fields\Types\InputField;
use Thinktomorrow\Chief\PageBuilder\PageBuilder;
use Thinktomorrow\Chief\PageBuilder\Relations\ActingAsChild;
use Thinktomorrow\Chief\PageBuilder\Relations\ActingAsParent;
use Thinktomorrow\Chief\ManagedModels\ManagedModel;
use Thinktomorrow\DynamicAttributes\HasDynamicAttributes;
use Thinktomorrow\Chief\ManagedModels\Assistants\ManagedModelDefaults;

class Article extends Model implements ManagedModel, HasAsset, ActsAsParent, ActsAsChild
{
    use ManagedModelDefaults;
    use HasDynamicAttributes;
    use AssetTrait;
    use ActingAsParent;
    use ActingAsChild;

    public $dynamicKeys = ['title','content','published_at'];

    public $table = 'articles';
    public $guarded = [];

    public function availableChildrenClasses(): array
    {
        return [
            Article::class,
            Quote::class,
        ];
    }

    public function fields(): Fields
    {
        return new Fields([
            (new PageBuilder())->field($this),
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
        return 'articles';
    }
}
