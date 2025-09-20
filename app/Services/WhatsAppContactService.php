<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class WhatsAppContactService
{
    protected string $connection = 'whatsapp';

    /**
     * Insert a new contact into whatsapp_db.contact table if not exists.
     *
     * @param array $data
     * [
     *    'sessionId' => string,
     *    'id'        => string,
     *    'name'      => string|null,
     *    'notify'    => string|null,
     *    'verifiedName' => string|null,
     *    'imgUrl'    => string|null,
     *    'status'    => string|null
     * ]
     *
     * @return int Existing or inserted record ID
     */
    public function insert(array $data): int
    {
        // Check if contact already exists
        $existing = DB::connection($this->connection)
            ->table('contact')
            ->where('sessionId', $data['sessionId'])
            ->where('id', $data['id'])
            ->first();

        if ($existing) {
            // dd('Contact already exists', $existing);
            return $existing->pkId; // Return existing ID
        }

        // Insert new contact
        return DB::connection($this->connection)
            ->table('contact')
            ->insertGetId([
                'sessionId'    => $data['sessionId'],
                'id' => ltrim(trim($data['id']), '+'),
                'name'         => $data['name'] ?? null,
                'notify'       => $data['notify'] ?? null,
                'verifiedName' => $data['verifiedName'] ?? null,
                'imgUrl'       => $data['imgUrl'] ?? null,
                'status'       => $data['status'] ?? null,
            ]);
    }
    public function sessionExists(string $sessionId): bool
    {
        // Check in 'session' table
        $sessionExists = DB::connection($this->connection)
            ->table('session')
            ->where('sessionId', $sessionId)
            ->exists();

        // Check in 'contact' table
        $contactExists = DB::connection($this->connection)
            ->table('contact')
            ->where('sessionId', $sessionId)
            ->exists();

        // Return true only if it exists in both tables
        return $sessionExists && $contactExists;
    }
    public function getSessionId(): ?string
    {
        return DB::connection($this->connection)
            ->table('session')
            // ->where('sessionId', 'Admin') // explicitly
            ->value('sessionId'); // returns the sessionId or null if not found
    }
    /**
     * Remove contact by phone number (id) if exists.
     *
     * @param string $number
     * @return bool True if deleted, false if not found
     */
    public function removeByNumber(string $number): bool
    {
        // Check if contact exists
        $contact = DB::connection($this->connection)
            ->table('contact')
            ->where('id', $number . "@s.whatsapp.net")
            ->first();

        if ($contact) {
            // Delete the contact
            DB::connection($this->connection)
                ->table('contact')
                ->where('id', $number . "@s.whatsapp.net")
                ->delete();

            return true; // Deleted successfully
        }

        return false; // Not found
    }
}
