<?php

use Faker\Generator;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

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

Artisan::command('sho:input1', function () {
    /** @var \Illuminate\Foundation\Console\ClosureCommand $this */
    $name = $this->ask('Enater Your Name');

    $this->line("name is: <info>{$name}</info>");
});

Artisan::command('sho:input2', function () {
    /** @var \Illuminate\Foundation\Console\ClosureCommand $this */
    $isMale = $this->confirm('Are You Male?', true);
    $gender = $isMale ? 'male' : 'female';

    $this->line("your gender is: <info>{$gender}</info>");
});

Artisan::command('sho:input3', function () {
    //این دستور تو خط فرمان ویندوزی درست کار نمیکنه
    //به شما میاد autocomplete میده اما میتونید هر مقدار دیگه ای رو وارد کنید
    /** @var \Illuminate\Foundation\Console\ClosureCommand $this */
    $gender = $this->anticipate('what is your gender?', ['male', 'female']);

    $this->info("your gender is: <info>{$gender}</info>");
});

Artisan::command('sho:input4', function () {
    /** @var \Illuminate\Foundation\Console\ClosureCommand $this */
//    $gender = $this->choice('what is your gender?', ['male', 'female'], null, 2, true);
    $gender = $this->choice('what is your gender?', ['male', 'female']);
//    dd($gender);
    $this->info("your gender is: <info>{$gender}</info>");
});

Artisan::command('sho:input5', function () {
    /** @var \Illuminate\Foundation\Console\ClosureCommand $this */
    $pass = $this->secret('enter your password');

    $this->line("your password is: <info>{$pass}</info>");
});

// create student project!!!!

### Fake Data

const STUDENTS_CACHE_KEY = 'STUDENTS_CACHE_KEY';

Artisan::command('student:clear', function () {
    Cache::forget(STUDENTS_CACHE_KEY);
    $this->info('cache data is clear');
})->describe('clear students');

Artisan::command('student:seed {--c|count=10 : student count to seed into the cache}', function () {
    $students = [];
    $count = $this->option('count');
    if (!is_numeric($count) || $count < 0) {
        $count = 10;
    }

    $faker = app(Generator::class);
    foreach (range(1, $count) as $index) {
        $students[] = [
            'id' => $index,
            'name' => $faker->firstName,
            'family' => $faker->lastName,
            'age' => $faker->numberBetween(10, 30),
            'term' => $faker->numberBetween(1, 4),
        ];
    }

    Cache::forever(STUDENTS_CACHE_KEY, $students);
    $this->info('create data is success');
})->describe('seed students data');

## Show list
Artisan::command('student:list {--t|type=table : can either be table or array} {--l|limit=10 : limit output count}', function () {
    $students = Cache::get(STUDENTS_CACHE_KEY);

    if (empty($students)) {
        /** @var \Illuminate\Foundation\Console\ClosureCommand $this */
        return $this->info('students list is empty');
    }

    $limit = $this->option('limit');
    if (!is_numeric($limit) || $limit < 0) {
        $limit = 10;
    }
    $students = array_slice($students, 0, $limit);

    if ($this->option('type') === 'table') {
        return $this->table(['id', 'name', 'family', 'age', 'grade'], $students);
    }

    dd($students);
})->describe('show students list');

## add student
Artisan::command('student:add', function () {
    /** @var \Illuminate\Foundation\Console\ClosureCommand $this */
    $students = Cache::get(STUDENTS_CACHE_KEY, []);
    $id = empty($students) ? 1 : end($students)['id'] + 1;

    do {
        if (isset($name)) {
            $this->error('name is invalid enter a valid name with 2 more characters');
        }
        $name = $this->ask('Enter name', 'name is required');
    } while ($name === 'name is required' || strlen($name) <= 1);

    do {
        if (isset($family)) {
            $this->error('family is invalid enter a valid family with 2 more characters');
        }
        $family = $this->ask('Enter family', 'family is required');
    } while ($family === 'family is required' || strlen($family) <= 1);

    do {
        if (isset($age)) {
            $this->error('age is invalid enter a valid age between 10, 100');
        }
        $age = $this->ask('Enter age', 'age is required, between 10, 100');
    } while ($age === 'age is required, between 10, 100' || !is_numeric($age) || $age < 10 || $age > 100);

    do {
        if (isset($term)) {
            $this->error('term is invalid enter a valid term between 1, 4');
        }
        $term = $this->ask('Enter term', 'term is required, between 1, 4');
    } while ($term === 'term is required, between 1, 4' || !is_numeric($term) || $term < 1 || $term > 4);

    $students[] = compact('id', 'name', 'family', 'age', 'term');
    Cache::forever(STUDENTS_CACHE_KEY, $students);
    $this->info('add new data');
})->describe('add new student');

Artisan::command('student:remove {ids* : student ids to remove}', function ($ids) {
    /** @var \Illuminate\Foundation\Console\ClosureCommand $this */
    $students = Cache::get(STUDENTS_CACHE_KEY);
    $filtered = array_filter($students, function ($item) use ($ids) {
        return !in_array($item['id'], $ids);
    });

    if (count($students) === count($filtered)) {
        return $this->getOutput()->error('no student found with given id!');
    }

    Cache::forever(STUDENTS_CACHE_KEY, $filtered);

    $this->getOutput()->success('student removed successfully');
})->describe('remove a student');

## remove student

Artisan::command('student:update {id : student id to update}', function ($id) {
    /** @var \Illuminate\Foundation\Console\ClosureCommand $this */

    $students = Cache::get(STUDENTS_CACHE_KEY);
    $filtered = array_filter($students, function ($item) use ($id) {
        return $item['id'] == $id;
    });

    if (empty($filtered)) {
        return $this->getOutput()->error('student not found');
    }

    $key = array_first(array_keys($filtered));
    $student = array_first($filtered);

    do {
        if (isset($name)) {
            $this->error('name is invalid enter a valid name with 2 more characters');
        }
        $name = $this->ask('Enter name', $student['name']);
    } while (strlen($name) <= 1);
    $student['name'] = $name;

    do {
        if (isset($family)) {
            $this->error('family is invalid enter a valid family with 2 more characters');
        }
        $family = $this->ask('Enter family', $student['family']);
    } while (strlen($family) <= 1);
    $student['family'] = $family;

    do {
        if (isset($age)) {
            $this->error('age is invalid enter a valid age between 10, 100');
        }
        $age = $this->ask('Enter age', $student['age']);
    } while (!is_numeric($age) || $age < 10 || $age > 100);
    $student['age'] = $age;

    do {
        if (isset($term)) {
            $this->error('term is invalid enter a valid term between 1, 4');
        }
        $term = $this->ask('Enter term', $student['term']);
    } while (!is_numeric($term) || $term < 1 || $term > 4);
    $student['term'] = $term;

    $students[$key] = $student;
    Cache::forever(STUDENTS_CACHE_KEY, $students);

    $this->getOutput()->success("student {$id} has updated");
})->describe('update student');

## find student

Artisan::command('student:find', function () {
    /** @var \Illuminate\Foundation\Console\ClosureCommand $this */

    $students = Cache::get(STUDENTS_CACHE_KEY);

    $search = [];
    //اگر نام رو خاست جستجو بکنه این تو اضافه ش میکنم
    $search['name'] = $this->ask('Enter name to search', null);
    //اگر نام خانوادگی رو خاست جستجو بکنه این تو اضافه ش میکنم
    $search['family'] = $this->ask('Enter family to search', null);
    //اگر سن رو خاست جستجو بکنه این تو اضافه ش میکنم
    $search['age'] = $this->ask('Enter age to search', null);
    //اگر ترم رو خاست جستجو بکنه این تو اضافه ش میکنم
    $search['term'] = $this->ask('Enter term to search', null);

    //حذف خونه هایی که خالی هستند
    $search = array_filter($search);

    $filtered = array_filter($students, function ($item) use ($search) {
        $match = 0;
        foreach ($search as $key => $value) {
            $itemValue = $item[$key];
            if (strpos($itemValue, $value) !== false) {
                $match++;
            }
        }

        return $match === count($search);
    });

    if (empty($filtered)) {
        return $this->getOutput()->error('no match found');
    }

    return $this->table(['id', 'name', 'family', 'age', 'term'], $filtered);
})->describe('search in student list');