<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Console\Command;

class CreateFakePosts extends Command
{
    const DEFAULT_COUNT = 2;
    const DEFAULT_COMMENTS_COUNT = 3;

    /** @var integer */
    private $count;

    /** @var integer */
    private $countComments;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:create-fake {count? : Quantity of fake Posts (Default: 10) } {countComments? : Quantity of fake comments to Posts (Default: 10) }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create fake Posts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->count = (int)($this->argument('count')) ? $this->argument('count') : self::DEFAULT_COUNT;
        $this->countComments = (int)($this->argument('countComments')) ? $this->argument('countComments') : self::DEFAULT_COMMENTS_COUNT;

        $this->newLine();
        $this->alert($this->description);

        ini_set('memory_limit', '4096M');

        $time_start = time();

        try {
            $this->fakePostsCreatingProcess();
        } catch (\Exception | \Throwable $exception) {
            dd([
                $exception->getMessage(),
                $exception->getCode(),
//                $exception->getTrace(),
                $exception->getTraceAsString(),
                $exception->getLine()
            ]);
        }


        $elapsedTime = time() - $time_start;

        $this->newLine(2);

        $minutesCommentStr = null;

        if ($elapsedTime > 60) {
            $minutesCount = floor($elapsedTime / 60);
            $minutesCommentStr = " ({$minutesCount} minutes)";
        }

        $this->line("Elapsed time : {$elapsedTime} sec" . $minutesCommentStr);
        $this->newLine();
        $this->info('All done.');

        return 0;
    }

    private function fakePostsCreatingProcess(): void
    {
        Post::factory()->count((int)$this->count)->create()->each(function ($post) {
            PostComment::factory()->count((int)$this->countComments)->create([
                'post_id' => $post->id
            ]);
        });

    }
}
