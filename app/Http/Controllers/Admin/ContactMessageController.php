<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ContactMessagesDataTable;
use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index(ContactMessagesDataTable $dataTable)
    {
        return $dataTable->render('admin.contactMessages.index');
    }

    public function show(ContactMessage $contactMessage)
    {
        // e.g. return a detail view if you need it
        return view('admin.contact_messages.show', compact('contactMessage'));
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return response()->json(['message' => 'Message deleted successfully']);
    }

    // You can remove create/store/edit/update since messages come from users,
    // unless you want to allow manual creation/editing in the admin panel.
}
