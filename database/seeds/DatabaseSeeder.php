<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
    	$this->call('RolTableSeeder');
    	$this->call('UserTableSeeder');		
    	$this->call('UserProfileTableSeeder');
    	$this->call('AppTableSeeder');
    	$this->call('AppXUserTableSeeder');
    	$this->call('ModuleTableSeeder');
    	$this->call('OptionTableSeeder');
    	$this->call('PermitTableSeeder');
        $this->call('DepartmentTableSeeder');
        $this->call('CityTableSeeder');
        $this->call('CategoryTableSeeder');	
        $this->call('StageTableSeeder');
        $this->call('ConectorsTableSeeder');
    }
}
