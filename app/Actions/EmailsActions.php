<?php

namespace App\Actions;

use App\Models\SuccessfulEmail;
use Illuminate\Http\Request;

class EmailsActions
{

    public function store(Request $request)
    {
        return SuccessfulEmail::create($request->all());
    }

    public function show($id)
    {
        return SuccessfulEmail::find($id);
    }


    public function update(Request $request, $id)
    {
        $successfulEmail = SuccessfulEmail::findOrFail($id);
        $successfulEmail->update($request->all());
        return $successfulEmail;
    }

    public function getAll()
    {
        return SuccessfulEmail::all();
    }

    public function delete($id)
    {
        $successfulEmail = SuccessfulEmail::findOrFail($id);
        $successfulEmail->delete();
        return ['message' => 'Email soft deleted successfully'];
    }
}
