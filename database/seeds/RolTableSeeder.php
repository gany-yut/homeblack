<?php

use Illuminate\Database\Seeder;

class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('catalogo_roles')->insert(array(
			'clave_rol' 	=> 1
			,'clave_desc'	=> 'Funcional'
			,
			));
    }
}
