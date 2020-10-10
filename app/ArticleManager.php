<?php
declare(strict_types=1);

namespace App;

use Thinktomorrow\Chief\Managers\Manager;
use Thinktomorrow\Chief\Managers\Assistants\ManagerDefaults;
use Thinktomorrow\Chief\Managers\Assistants\CrudAssistant;
use Thinktomorrow\Chief\Managers\Assistants\ModulesAssistant;
use Thinktomorrow\Chief\Managers\Assistants\FileUploadAssistant;
use Thinktomorrow\Chief\Managers\Assistants\SlimImageUploadAssistant;

class ArticleManager implements Manager
{
    use ManagerDefaults;
    use CrudAssistant;
    use FileUploadAssistant;
    use SlimImageUploadAssistant;
    use ModulesAssistant;

    public static function managedModelClass(): string
    {
        return Article::class;
    }
}
