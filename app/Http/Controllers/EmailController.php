<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\EmailsActions;
use App\Http\Requests\StoreEmailRequest;

class EmailController extends Controller
{
    protected $emailsActions;

    public function __construct(EmailsActions $emailsActions)
    {
        $this->emailsActions = $emailsActions;
    }

    public function store(StoreEmailRequest $request)
    {
        $successfulEmail = $this->emailsActions->store($request);
        return response()->json($successfulEmail, 201);
    }

    public function show($id)
    {
        $successfulEmail = $this->emailsActions->show($id);

        if (!$successfulEmail) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json($successfulEmail);
    }

    public function update(Request $request, $id)
    {
        $successfulEmail = $this->emailsActions->update($request, $id);
        return response()->json($successfulEmail);
    }

    public function index()
    {
        $successfulEmails = $this->emailsActions->getAll();
        return response()->json($successfulEmails);
    }

    public function destroy($id)
    {
        $successfulEmail = $this->emailsActions->show($id);
    
        if (!$successfulEmail) {
            return response()->json(['message' => 'Not found'], 404);
        }
    
        $message = $this->emailsActions->delete($id);
        return response()->json($message);
    }
    
}
