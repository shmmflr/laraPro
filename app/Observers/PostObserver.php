<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Log;

class PostObserver
{

    /**
     * 1.retrieved=>  زمانس که داده ای از دیتا بیس واکشی بشه
     * 2.creating => داده می خواهد در دیتا بیس ثبت شود ولی هنوز ثبت نشده
     * 3.created=> داده جدی در دیتا بیس ثبت شده
     * 4.updateing =>داده ای میخواهد بروزرسانی شود هنوز نشده
     * 5.updated=> داده بروزرسانی شده است
     * 6.saving=> قبل از 2 یا 4 اجرا می شود
     * 7.saved=> بعد از 3 یا 5 اجرا می شود
     * 8.deleteing=>قبل از حذف کردن اجرا می شود
     * 9.deleted=>حذف شد
     * 10.restoring=> قبل از بازگرداندن یک آیتم اجرا می شود
     * 11.restored=> بعد از بازگردادن یک آیتم اجرا می شود
     *
     *
     *
     */

    /**
     * Handle the Post "created" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function created(Post $post)
    {
        Log::info('پست' . ' ' . $post->title . ' ' .
            'توسط' . '  ' . $post->userName() . 'ایجاد شد');
    }

    /**
     * Handle the Post "updated" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function updated(Post $post)
    {
        //
    }

    /**
     * Handle the Post "deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function deleted(Post $post)
    {
        //
    }

    /**
     * Handle the Post "restored" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function restored(Post $post)
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        //
    }
}