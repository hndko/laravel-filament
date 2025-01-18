<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     */
    public function created(Post $post): void
    {
        if (! is_null($post->image)) {
            Storage::disk('public')->put($post->image, file_get_contents($post->image));
        }
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Post $post): void
    {
        if ($post->isDirty('image')) {
            Storage::disk('public')->delete($post->getOriginal('image'));
        }
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Post $post): void
    {
        if (! is_null($post->image)) {
            Storage::disk('public')->delete($post->image);
        }
    }

    /**
     * Handle the Task "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Task "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
    }
}
