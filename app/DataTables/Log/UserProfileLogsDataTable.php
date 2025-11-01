<?php

namespace App\DataTables\Log;

use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\CollectionDataTable;
use Illuminate\Support\Facades\DB;

class UserProfileLogsDataTable extends DataTable
{
    public function dataTable($query)
    {
        return (new CollectionDataTable($query))
            ->addColumn('user', function ($row) {
                $message = $row['message'];

                // Try to extract user_id from log JSON
                $jsonStart = strpos($message, '{');
                if ($jsonStart === false) return '<span class="text-muted">Unknown</span>';

                $json = substr($message, $jsonStart);
                $decoded = json_decode($json, true);
                $userId = $decoded['user_id'] ?? null;

                if (!$userId) {
                    return '<span class="text-muted">Unknown</span>';
                }

                // Fetch the user name or email
                $user = DB::table('users')->find($userId);
                if (!$user) {
                    return '<span class="text-danger">Deleted User</span>';
                }

                $name = $user->first_name ?? $user->email ?? "User #{$userId}";
                $url = route('userprofile', $userId); // 👈 make sure this route exists

                return "<a href='{$url}' target='_blank' class='fw-semibold text-primary text-decoration-underline'>{$name}</a>";
            })
            ->addColumn('summary', function ($row) {
                $msg = $row['message'];
                if (str_contains($msg, 'photo')) {
                    return '<span class="badge bg-info">User Photo Change</span>';
                }
                return '<span class="badge bg-primary">User Profile Updated</span>';
            })
            ->addColumn('details', function ($row) {
                $message = $row['message'];

                if (strpos($message, '{') === false) {
                    return '<span class="text-muted">No field changes</span>';
                }

                $jsonPart = substr($message, strpos($message, '{'));
                $decoded = json_decode($jsonPart, true);

                if (!isset($decoded['diff']) || empty($decoded['diff'])) {
                    return '<span class="text-muted">No field changes</span>';
                }

                $modalId = 'logModal_' . uniqid();
                $content = "<table class='table table-sm table-bordered text-center'>
                    <thead class='table-light'>
                        <tr><th>Field</th><th>Old</th><th>New</th></tr>
                    </thead><tbody>";

                foreach ($decoded['diff'] as $label => $change) {
                    if ($change === "No Change") {
                        $content .= "<tr>
                            <td><strong>{$label}</strong></td>
                            <td class='text-muted'>—</td>
                            <td class='text-muted'>—</td>
                        </tr>";
                        continue;
                    }

                    $old = $change['old'] ?? '—';
                    $new = $change['new'] ?? '—';
                    $content .= "<tr>
                        <td><strong>{$label}</strong></td>
                        <td class='text-danger'>{$old}</td>
                        <td class='text-success'>{$new}</td>
                    </tr>";
                }

                $content .= "</tbody></table>";
                $button = "<button class='btn btn-sm btn-outline-secondary' data-bs-toggle='modal' data-bs-target='#$modalId'>View</button>";
                $modal = "
                    <div class='modal fade' id='$modalId' tabindex='-1'>
                        <div class='modal-dialog modal-lg modal-dialog-centered'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title'>Profile Change Details</h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                                </div>
                                <div class='modal-body'>{$content}</div>
                            </div>
                        </div>
                    </div>";

                return $button . $modal;
            })
            ->rawColumns(['user', 'summary', 'details']);
    }

    public function query()
    {
        $path = storage_path('logs/user_profile.log');
        if (!file_exists($path)) {
            return collect([]);
        }

        $lines = array_reverse(file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));

        return collect($lines)->map(function ($line) {
            preg_match('/^\[(.*?)\]\s.*?:\s(.*)$/', $line, $match);
            $date = $match[1] ?? '';
            $raw = $match[2] ?? '';
            $decoded = html_entity_decode($raw, ENT_QUOTES, 'UTF-8');
            return [
                'date' => $date,
                'message' => $decoded,
            ];
        });
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('logs-table')
            ->columns($this->getColumns())
            ->ajax([
                'url' => route('admin.profile.logs.data'),
                'type' => 'GET',
            ])
            ->orderBy(0, 'desc');
    }

    protected function getColumns()
    {
        return [
            'date' => ['title' => 'Date'],
            'user' => ['title' => 'User'],
            'summary' => ['title' => 'Summary'],
            'details' => ['title' => 'Changes', 'orderable' => false, 'searchable' => false],
        ];
    }
}
