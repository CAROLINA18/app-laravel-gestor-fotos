<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use GestorImagen\Album;
use GestorImagen\Foto;
use GestorImagen\Usuario;
class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0');

		Foto::truncate();
		Album::truncate();
		Usuario::truncate();

		 $this->call('UsersTableSeeder');
		 $this->call('AlbumTableSeeder');
		 $this->call('FotoTableSeeder');
	}

}
