<?php

use App\Models\Room;
use App\Models\User;
use App\Models\Comment;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Stmt\TryCatch;
use SebastianBergmann\Environment\Console;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //    $user1 = DB::select('select * from users where id = ?', [1]);
    //    $user2 = DB::connection('sqlite')->select('select * from users');
    //    dd($user);
    //    dump("mysql:", $user1);
    //    dump("mysql:", $user2);
    //    $pdo = DB::connection('sqlite')->getPdo();
    //    $users = $pdo->query('select * from users')->fetchAll();
    //    dump($users);
    //    $result = DB::select('select * from users where id = ? and name = ?', [1, 'Bridie Rosenbaum']);
    // dump($result);
    //    $result2 = DB::select('select * from users where id = :id', ['id' => 1]);
    // dump($result2);
    //    DB::insert('insert into users (name, email, password) values (?, ? ,?)', ['inserted Name', 'email@fdf.fdf', 'password']);
    //    $affected = DB::update('update users set email = "updatedemail@email.com" where email = ?', ['email@fdf.fdf']);
    //    dump($affected);
    //    $deleted = DB::delete('delete from users where id = ?', [4]);
    //    dump($deleted);
    //    $result3 = DB::table('users')->select()->get();
    //    $result4 = User::all();
    //    $result3 = DB::table('users')->select()->get();
    // dump($result3);
    //    DB::transaction(function () {
    //        try {
    //            DB::table('users')->delete();
    //            $result = DB::table('users')->where('id', 4)->update(['email' => 'none']);
    //            if (!$result) {
    //                throw new \Exception;
    //            }
    //        } catch (\Exception $e) {
    //            DB::rollBack();
    //        }
    //    }, 5);


    //    $comment = DB::table("comments")->get();
    //    dump($comment);

    //    dump(factory(\App\Models\Comment::class, 3)->create());
    //    dump(\App\Models\Comment::factory()->count(3)->make());
    //    dump(\App\Models\Comment::factory()->count(3)->create());

    $users = DB::table('users')->limit(3)->get();
    $users = DB::table('users')->limit(3)->pluck('email');

    $user = DB::table('users')->where('name', 'Ephraim Dickens I')->first();
    $user = DB::table('users')->where('name', 'Ephraim Dickens I')->value('email');
    $user = DB::table('users')->find(1);

    $comment = DB::table('comments')->select('content as comment_content')->limit(3)->get();

    $comments = DB::table('comments')->select('user_id')->limit(3)->distinct()->get();
    //    $result = DB::table('comments')->count();

    $result = DB::table('comments')->max('user_id');
    //    dump($result);
    //    dump($users);
    //    dump($user);
    //    dump($comment);
    //    dump($comments);

    $result2 = DB::table('rooms')->where('price', '<', 200)->get();
    //    dump($result2);

    $result3 = DB::table('rooms')->where([
        ['room_size', '2'],
        ['price', '<', '400']
    ])->get();
    //    dump($result3);

    $result4 = DB::table('rooms')->where('room_size', '2')->orWhere('price', '<', '400')->get();
    //    dump($result4);

    $result5 = DB::table('rooms')->where('price', '<', '400')->orWhere(function ($query) {
        $query->where('room_size', '>', '1')->where('room_size', '<', '4');
    })->get();
    //    dump($result5);

    $result6 = DB::table('rooms')->whereBetween('room_size', [1, 3])->get();
    //    dump($result6);
    $result7 = DB::table('rooms')->whereNotIn('id', [1, 2, 3])->get();

    $result8 = DB::table('users')->whereExists(function ($query) {
        $query->select('id')->from('reservations')
            ->whereRaw('reservations.user_id = users.id')
            ->where('check_in', '=', '2021-09-28')
            ->limit(1);
    })->get();


    $result9 = DB::table('users')
        //        ->whereJsonContains('meta->skills', 'laravel')
        ->where('meta->setting->site_language', 'en')
        ->limit(10)
        ->get();
    //    dump($result9);


    $result10 = DB::table('comments')->paginate(3);
    //    dump($result10->items());


    //    $result11 = DB::statement('ALTER TABLE comments ADD FULLTEXT fulltext_index(content)');

    //    $result11 = DB::table('comments')
    //        ->whereRaw("MATCH(content) AGAINST (? IN BOOLEAN MODE)", ['repellendus'])->get();
    //    dump($result11);

    // $result13 = DB::table('comments')
    //     ->whereRaw("MATCH(content) AGAINST (? IN BOOLEAN MODE)", ['+repellendus -pariatur'])->get();
    //    dump($result13);

    $result12 = DB::table('comments')
        ->where("content", 'like', '%repellendus%')
        ->get();

    //    dump($result12);/

    //    $result14 = DB::table('comments')
    //        ->selectRaw('count(user_id) as number_of_comments, users.name')
    //        ->join('users', 'users.id', '=', 'comments.user_id')
    //        ->groupBy('user_id')
    //        ->get();

    $result14 = DB::table('comments')
        ->select('users.name')
        ->addSelect(DB::raw('count(user_id) as number_of_comments'))
        ->join('users', 'users.id', '=', 'comments.user_id')
        ->groupBy('comments.user_id')
        ->groupBy('users.name')
        ->limit(10)
        ->get();

    //    dump($result14);

    $result15 = DB::table('users')
        ->selectRaw('LENGTH(name) as name_length, name')
        ->orderByRaw('LENGTH(name) DESC')
        ->limit(10)
        ->get();

    // dump($result15);


    $result16 = DB::table('users')->limit(30)->orderBy('name', 'desc')->get();
    // dump($result16);

    $result17 = DB::table('users')
        // ->latest()
        ->inRandomOrder()
        ->first();
    // dump($result17);

    $result18 = DB::table('comments')->selectRaw('count(id) as number_of_5stars_comments, rating')
        ->groupBy('rating')
        ->having('rating', '=', 5)
        ->get();

    // dump($result18);

    $result19 = DB::table('reservations')->limit(30)->get();

    // dump($result19);
    $room_id = 1;
    $result20 = DB::table('reservations')->when($room_id, function ($query, $room_id) {
        return $query->where('room_id', $room_id);
    })->get();
    // dump($result20);

    // $sortBy = 'room_number';
    $sortBy = null;
    $result21 = DB::table('rooms')->when($sortBy, function ($query, $sortBy) {
        return $query->orderBy($sortBy);
    }, function ($query) {
        return $query->orderBy('price');
    })->get();
    // dump($result21);


    $result22 = DB::table('comments')->orderBy('id')->limit(30)->chunk(2, function ($comments) {
        foreach ($comments as $comment) {
            if ($comment->id == 5) return false;
        }
    });

    // dump($result22);

    // $result23 = DB::table('comments')->orderBy('id')->limit(30)->chunkById(5, function($comments) {
    //     foreach ($comments as $comment) {
    //         DB::table('comments')->where('id', $comment->id)->update(['rating' => null]);
    //     }
    // });

    // dump($result23);

    $result23 = DB::table('reservations')
        ->join('rooms', 'reservations.room_id', '=', 'rooms.id')
        ->join('users', 'reservations.user_id', '=', 'users.id')
        ->where('rooms.id', '>', 3)
        ->where('users.id', '>', 1)
        ->limit(10)
        ->get();

    // dump($result23);


    $result24 = DB::table('reservations')
        ->join('rooms', function ($join) {
            $join->on('reservations.room_id', '=', 'rooms.id')
                ->where('rooms.id', '>', 3);
        })
        ->join('users', function ($join) {
            $join->on('reservations.user_id', '=', 'users.id')
                ->where('users.id', '>', 1);
        })
        ->limit(10)
        ->get();

    // dump($result24);

    $room = DB::table('rooms')->where('id', '>', 3);
    $user = DB::table('users')->where('id', '>', 1);

    $result25 = DB::table('reservations')
        ->joinSub($room, 'rooms', function ($join) {
            $join->on('reservations.room_id', '=', 'rooms.id');
        })
        ->joinSub($user, 'users', function ($join) {
            $join->on('reservations.user_id', '=', 'users.id');
        })->limit(10)->get();

    // dump($result25);


    $result26 = DB::table('rooms')
        ->leftJoin('reservations', 'rooms.id', '=', 'reservations.room_id')
        ->selectRaw('room_size, count(reservations.id) as reservations_count')
        ->groupBy('room_size', 'price')
        ->orderByRaw('count(reservations.id) DESC')
        ->get();

    // dump($result26);


    $result27 = DB::table('rooms')
        ->leftJoin('reservations', 'rooms.id', '=', 'reservations.room_id')
        ->leftJoin('cities', 'reservations.city_id', '=', 'cities.id')
        ->selectRaw('room_size, count(reservations.id) as reservations_count')
        ->groupBy('room_size', 'cities.name')
        ->orderByRaw('count(reservations.id) DESC')
        ->limit(10)
        ->get();

    // dump($result27);


    $result28 = DB::table('rooms')->crossJoin('cities')->limit(10)->get();

    // dump($result28);

    $result29 = DB::table('rooms')
        ->crossJoin('cities')
        ->leftJoin('reservations', function ($join) {
            $join->on('rooms.id', '=', 'reservations.room_id')
                ->on('cities.id', '=', 'reservations.city_id');
        })
        ->selectRaw('count(reservations.id) as reservations_count, cities.name')
        ->groupBy('cities.name')
        ->orderByRaw('count(reservations.id) DESC')
        ->get();

    // dump($result29);

    $result30 = DB::table('rooms')
        ->crossJoin('cities')
        ->leftJoin('reservations', function ($join) {
            $join->on('rooms.id', '=', 'reservations.room_id')
                ->on('cities.id', '=', 'reservations.city_id');
        })
        ->selectRaw('count(reservations.id) as reservations_count, room_size, cities.name')
        ->groupBy('room_size', 'cities.name')
        ->orderByRaw('rooms.room_size DESC')
        ->limit(10)
        ->get();

    // dump($result30);

    $users = DB::table('users')->select('name')->limit(300);
    $result30 = DB::table('cities')->select('name')->union($users)->get();
    // dump($result30);

    $comments = DB::table('comments')
        ->select('rating as rating_or_room_id', 'id', DB::raw('"comments" as type_of_activity'))
        ->where('user_id', 2);

    // dump($comments);

    $result31 = DB::table('reservations')
        ->select('room_id as rating_or_room_id', 'id', DB::raw('"reservation as type_of_activity"'))
        ->union($comments)
        ->where('user_id', 2)
        ->get();

    // dump($result31);

    // DB::table('rooms')->insert([
    //     ['room_number' => 1, 'room_size' => 1, 'price' => 1, 'description' => 'new description'],
    //     ['room_number' => 2, 'room_size' => 2, 'price' => 1, 'description' => 'new description'],
    // ]);

    $result32 = DB::table('rooms')->limit(10)->orderBy('id', "DESC")->get();

    // $id = DB::table('rooms')->insertGetId(
    //     ['room_number' => 3, 'room_size' => 3, 'price' => 3, 'description' => 'new descriptio3'],
    // );


    // $affected = DB::table('rooms')->where('id', 1)->update(['price' => 222]);
    // dump($affected);
    // $affected2 = DB::table('rooms')->increment('price', 20);
    // dump($affected2);
    // $affected3 = DB::table('rooms')->decrement('price', 10, ['description' => 'new description']);
    // dump($affected3);
    // $result33 = DB::table('rooms')->sharedLock()->find(1);
    // dump($result33);

    // $result34 = DB::table('rooms')->where('room_size', 3)->lockForUpdate()->get();
    // dump($result34);

    $result35 = Room::where('room_size', 3)->get();
    // dump($result35);

    $result36 = User::select(['name', 'email'])
        ->addSelect(['worst_rating' => Comment::select('rating')
        ->whereColumn('user_id', 'users.id')
        ->orderBy('rating', 'asc')
        ->limit(1)
    ])->limit(10)->get()->toArray();
    // dump($result36);

    $result37 = User::orderByDesc(
        Reservation::select('check_in')->whereColumn('user_id', 'users.id')
        ->orderBy('check_in', 'desc')
        ->limit(1)
    )->select('id', 'name')->limit(10)->get()->toArray();
    // dump($result37);

    $result38 = User::where('email', 'like', '%@email2.com')->firstOr(function() {
        User::where('id', 1)->update(['email' =>  'email@email2.com']);
    });
    // dump($result38);

    $result39 = Comment::all();
    // dump($result39);

    $result40 = Comment::withoutGlobalScope('rating')->get();
    // dump($result40);

    $result41 = Comment::rating(1)->get();
    // dump($result41);

    $result42 = Comment::select("*")->limit(10)->get();
    $result43 = $result42->reject(function($comment) {
        return $comment->rating < 3;
    });
    // dump($result43);

    $result44 = $result42->map(function($comment) {
        return $comment->content;
    });
    // dump($result44);

    // $result45 = Comment::where('rating', 2)->forceDelete();
    // $result45 = Comment::where('rating', 2)->delete();
    // dump($result45);


    $result46 = Comment::find(1);
    // dump($result46);
    // dump($result46->rating);
    // dump($result46->who_what);

    $result47 = Comment::find(1);
    $result47->rating = 4;
    $result47->save();


    $result48 = User::select([
        'users.*',
        'last_commented_at' => Comment::selectRaw('MAX(created_at)')->whereColumn('user_id', 'users.id')
    ])->withCasts(['last_commented_at' => 'datetime:Y-m-d'])->limit(10)->get()->toJson();
    dump($result48);


    return view('welcome');
});
