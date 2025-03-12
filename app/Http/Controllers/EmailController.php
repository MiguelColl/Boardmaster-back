<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emails = Email::orderBy('id')->get();
        return view('emails.list', [
            'emails' => $emails,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('emails.new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'from' => 'required|email',
            'to' => 'required|email',
            'subject' => 'required|max:255',
            'body' => 'required|max:255',
        ]);

        Email::create([
            'from' => $request->input('from'),
            'to' => $request->input('to'),
            'subject' => $request->input('subject'),
            'body' => $request->input('body'),
        ]);
        return redirect()->route('emails.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $email = Email::find($id);
        return view('emails.detail', [
            'email' => $email,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $email = Email::find($id);
        return view('emails.edit', [
            'email' => $email,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'from' => 'required|email',
            'to' => 'required|email',
            'subject' => 'required|max:255',
            'body' => 'required|max:255',
        ]);

        $email = Email::find($id);

        $email->from = $request->input('from');
        $email->to = $request->input('to');
        $email->subject = $request->input('subject');
        $email->body = $request->input('body');
        $email->save();

        return redirect()->route('emails.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Email::destroy($id);
        return redirect()->route('emails.index');
    }
}
