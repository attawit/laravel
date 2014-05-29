<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAuthors extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::table('authors') -> insert( array(
            'name' => "Алексей Калашников",
            'bio' => "Родился 11 декабря 1984 года в шахтерском городе Луганске, что на Украине",
            'created_at' => date('Y-m-d H:m'),
            'updated_at' => date('Y-m-d H:m'),
        ));

        DB::table('authors') -> insert( array(
            'name' => "Александр Калашников",
            'bio' => "Родился 17 декабря 1977 года в шахтерском городе Луганске, что на Украине бат Алексея",
            'created_at' => date('Y-m-d H:m'),
            'updated_at' => date('Y-m-d H:m'),
        ));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::table('authors')->where('name', '=', 'Алексей Калашников')->delete();
        DB::table('authors')->where('name', '=', 'Александр Калашников')->delete();
	}

}
