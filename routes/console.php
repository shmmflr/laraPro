<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
 */

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// ساخت چنتا دستور با php artisan

Artisan::command('sho:foo {name : person name} {family=alavi : person family} {age? : person age}',
    function ($name, $family) {
        echo 'this is ', $name, ' ', $family, 'age of', $age;
    })->describe('this is foo');

Artisan::command('sho:sum {numbers*}',
    function ($numbers) {
        $result = array_sum($numbers);
        echo 'sum :', $result;
    })->describe('this is foo');

Artisan::command('sho:days {days : number between 1 7}',
    function ($days) {
        switch ($days) {
            case 1:echo 'sanbe';break;
            case 2:echo '1 sanbe';break;
            case 3:echo '2 sanbe';break;
            case 4:echo '3 sanbe';break;
            case 5:echo '4 sanbe';break;
            case 6:echo ' 5sanbe';break;
            case 7:echo 'jomeh';break;
            default:echo 'data not valid';
        }

    })->describe('number of week');

// دادن option به تابع
Artisan::command('sho:print {name : person name} {--W|wrap=__0__ : this is option \'}
                    {--l|label : label test}',
    function ($name) {
        $wraper = '';
        if ($this->option('wrap') != '__0__') {
            $wraper = $this->option('wrap');
        }
        if ($this->option('wrap') == '') {
            $wraper = '_';
        }

        $label = 'name is: ';

        echo $label, $wraper, $name, $wraper;
    });

Artisan::command('sho:output', function () {
    /** @var \Illuminate\Foundation\Console\ClosureCommand $this */
    //برای نشان دادن متن در خروجی از دستورات زیر استفاده میشود
    $this->comment('comment colorized string');
    $this->info('info colorized string');
    $this->error('error colorized string');
    $this->line('line default colorized string');
    $this->question('question colorized string');

    //برای نمایش یک جدول از دستور زیر استفاده میشود
    $headers = ['name', 'age'];
    $body = [
        ['sayad', 29],
        ['mohammad', 28],
        ['meysam', 29],
    ];
    $tableStyle = 'box-double'; //default, borderless, compact,  symfony-style-guide, box, box-double
    $this->table($headers, $body, $tableStyle);
})->describe('test output');

Artisan::command('sho:test1', function () {
    /** @var \Illuminate\Foundation\Console\ClosureCommand $this */
    $output = $this->getOutput();

    $name = $output->ask('enter your name');
    $this->line('your name is: <question>' . $name . '</question>');
    $output->write('<error>salam man sayadam</error>: ');
    $output->write('familim aazamye');
});

Artisan::command('wba:input1', function () {
    /** @var \Illuminate\Foundation\Console\ClosureCommand $this */
    $name = $this->ask('Enater Your Name');

    $this->line("name is: <info>{$name}</info>");
});

Artisan::command('wba:input2', function () {
    /** @var \Illuminate\Foundation\Console\ClosureCommand $this */
    $isMale = $this->confirm('Are You Male?', true);
    $gender = $isMale ? 'male' : 'female';

    $this->line("your gender is: <info>{$gender}</info>");
});

Artisan::command('wba:input3', function () {
    //این دستور تو خط فرمان ویندوزی درست کار نمیکنه
    //به شما میاد autocomplete میده اما میتونید هر مقدار دیگه ای رو وارد کنید
    /** @var \Illuminate\Foundation\Console\ClosureCommand $this */
    $gender = $this->anticipate('what is your gender?', ['male', 'female']);

    $this->info("your gender is: <info>{$gender}</info>");
});

Artisan::command('wba:input4', function () {
    /** @var \Illuminate\Foundation\Console\ClosureCommand $this */
//    $gender = $this->choice('what is your gender?', ['male', 'female'], null, 2, true);
    $gender = $this->choice('what is your gender?', ['male', 'female']);
//    dd($gender);
    $this->info("your gender is: <info>{$gender}</info>");
});

Artisan::command('wba:input5', function () {
    /** @var \Illuminate\Foundation\Console\ClosureCommand $this */
    $pass = $this->secret('enter your password');

    $this->line("your password is: <info>{$pass}</info>");
});