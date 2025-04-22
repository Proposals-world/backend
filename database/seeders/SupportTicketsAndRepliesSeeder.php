<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SupportTicket;
use App\Models\SupportReply;
use Faker\Factory as Faker;

class SupportTicketsAndRepliesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Only these two users open tickets
        $userIds = [2, 3];

        foreach ($userIds as $userId) {
            // Give each user 10 tickets
            for ($i = 1; $i <= 10; $i++) {
                $ticket = SupportTicket::create([
                    'user_id'     => $userId,
                    'subject'     => $faker->sentence(6),
                    'description' => $faker->paragraph(3),
                    'status'      => 'open',
                ]);

                // Admin (user_id = 1) replies once to each ticket
                SupportReply::create([
                    'ticket_id' => $ticket->id,
                    'user_id'   => 1,
                    'message'   => $faker->sentence(12),
                ]);
            }
        }
    }
}