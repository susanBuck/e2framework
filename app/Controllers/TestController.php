<?php
namespace App\Controllers;

use App\Commands\AppCommand;

class TestController extends Controller
{
    private $appUrl;

    /**
     * This method is triggered by the route "/tests"
     */
    public function index()
    {
        $appCommand = new AppCommand($this->app);
        $appCommand->fresh();

        $this->appUrl = 'http://e2framework-test.loc/';
        
        $tests = [
            "view" => $this->testView(),
            "404" => $this->test404(),
            "env" => $this->testEnv(),
            "config" => $this->testConfig(),
            "db()->all" => $this->testDbAll(),
            "db()->findById" => $this->testDbFindById(),
            "db()->findByColumn" => $this->testDbFindByColumn(),
            "db()->insert" => $this->testDbInsert(),
            "db()->createTable" => $this->testDbCreateTable(),
        ];

        return $this->app->view('tests', ['tests' => $tests]);
    }

    public function testView()
    {
        $contents = file_get_contents($this->appUrl . 'foobar');
        return str_contains($contents, 'foobar-heading');
    }

    public function test404()
    {
        $contents = file_get_contents($this->appUrl . 'xyz');
        return str_contains($contents, '404 Page Not Found');
    }

    public function testEnv()
    {
        # Environment exists
        $test1 = $this->app->env('DB_NAME') == 'e2framework-test';

        # Environment does not exist
        $test2 = is_null($this->app->env('FOOBAR'));
        
        return $test1 && $test2;
    }

    public function testConfig()
    {
        $test1 = $this->app->config('app.email') == 'my@email.com';

        return $test1;
    }

    public function testDbAll()
    {
        return sizeof($this->app->db()->all('games')) == 10;
    }

    public function testDbFindById()
    {
        # No results yields null
        $test1 = is_null($this->app->db()->findById('games', 999));

        # One result
        $test2 = $this->app->db()->findById('games', 1)['id'] == 1;

        return $test1 && $test2;
    }

    public function testDbFindByColumn()
    {
        # No results
        $test1 = empty($this->app->db()->findByColumn('games', 'id', '=', 999));

        # 1 result
        $test2 = $this->app->db()->findByColumn('games', 'id', '=', 1)[0]['id'] == 1;

        # Multiple results
        $test3 = count($this->app->db()->findByColumn('games', 'id', '>', 1)) == 9;
        
        return $test1 && $test2 && $test3;
    }

    public function testDbInsert()
    {
        $data = [
            'move' => ['heads', 'tails'][rand(0, 1)],
            'win' => rand(0, 1),
            'time' => date('Y-m-d H:i:s')
        ];

        $id = $this->app->db()->insert('games', $data);
        
        $test1 = is_int($id) && $id > 0;

        $results = $this->app->db()->run('SELECT * FROM games ORDER BY id DESC')->fetch();

        $test2 = $results['move'] == $data['move'] && $results['time'] == $data['time'];
        
        return $test1 && $test2;
    }

    public function testDbCreateTable()
    {
        $columns = [
            'username' => 'varchar(255)',
            'bio' => 'text',
            'admin' => 'tinyint(1)'
        ];

        # Create table
        $this->app->db()->createTable('users', $columns);

        # Affirm table was created by querying all rows (should return an empty array)
        $results = $this->app->db()->all('users');
        $test1 = empty($results);

        return $test1;
    }
}