<?php

namespace App\Commands;

class AppCommand extends Command
{
    /**
     *
     */
    public function migrate()
    {
        $this->app->db()->createTable('games', [
            'move' => 'varchar(5)',
            'win' => 'tinyint(1)',
            'time' => 'timestamp',
        ]);

        dump('Migration complete.');
    }

    /**
     *
     */
    public function seed()
    {
        # Instantiate a new instance of the Faker\Factory class
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $moves = ['heads', 'tails'];
            $randomMove = array_rand($moves);

            $data = [
                'move' => $moves[$randomMove],
                'win' => rand(0, 1),
                'time' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s')
            ];

            $this->app->db()->insert('games', $data);
        }

        dump('Seeding complete.');
    }

    /**
     *
     */
    public function fresh()
    {
        $this->migrate();
        $this->seed();
    }
}
