<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeEnum extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:enum {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new enum class';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $path = app_path("Enums/{$name}.php");

        if (File::exists($path)) {
            $this->error("Enum {$name} already exists!");
            return;
        }

        File::ensureDirectoryExists(app_path('Enums'));

        $stub = <<<EOT
<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

class {$name} extends Enum
{
    protected static function values(): array
    {
        return [
            // 'key' => value,
        ];
    }

    protected static function labels(): array
    {
        return [
            // 'key' => 'Label',
        ];
    }
}
EOT;

        File::put($path, $stub);

        $this->info("Enum {$name} created successfully!");
    }
}
