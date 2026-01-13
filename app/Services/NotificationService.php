<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Collection;

class NotificationService
{
    public function list(User $user, array $filters = []): Collection
    {
        $q = $user->appNotifications()->latest();

        if (isset($filters['is_read'])) {
            $q->where('is_read', (bool) $filters['is_read']);
        }

        if (isset($filters['type'])) {
            $q->where('notification_type', $filters['type']);
        }

        return $q->get();
    }

    public function create(User $user, array $data): Notification
    {
        return $user->appNotifications()->create([
            'notification_type' => $data['notification_type'],
            'target_role'       => $data['target_role'] ?? $user->role, // admin/user
            'content_en'        => $data['content_en'] ?? null,
            'content_ar'        => $data['content_ar'] ?? null,
            'is_read'           => false,
        ]);
    }

    public function find(int $id, User $user): ?Notification
    {
        return $user->notifications()->find($id);
    }

    public function update(int $id, User $user, array $data): ?Notification
    {
        $notification = $this->find($id, $user);
        if (!$notification) return null;

        $notification->update(
            collect($data)->only([
                'notification_type',
                'target_role',
                'content_en',
                'content_ar',
                'is_read',
            ])->toArray()
        );

        return $notification;
    }

    public function delete(int $id, User $user): bool
    {
        $notification = $this->find($id, $user);
        return $notification ? (bool) $notification->delete() : false;
    }

    public function markRead(int $id, User $user, bool $read = true): bool
    {
        return (bool) $user->appNotifications()
            ->where('id', $id)
            ->update(['is_read' => $read]);
    }

    public function markAllRead(User $user): int
    {
        return $user->appNotifications()
            ->where('is_read', false)
            ->update(['is_read' => true]);
    }
}
