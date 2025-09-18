<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactLocation;
use App\Models\Service;
use App\Models\Setting;

class ContactController extends Controller
{
    public function index()
    {
        $contact_locations = ContactLocation::all();
        $services = Service::where('active', 1)->orderBy('order')->get();
        $settings = Setting::first();
        
        return view('pages.contact', compact(
            'contact_locations',
            'services',
            'settings'
        ));
    }
    
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'service' => 'nullable|exists:services,id',
            'message' => 'required|string',
        ]);
        
        $contact = new Contact();
        $contact->name = $validated['name'];
        $contact->email = $validated['email'];
        $contact->phone = $validated['phone'];
        $contact->service_id = $validated['service'] ?? null;
        $contact->message = $validated['message'];
        $contact->read = false;
        $contact->save();
        
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
    
    public function adminIndex()
    {
        $messages = Contact::with('service')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return view('admin.contacts.index', compact('messages'));
    }
    
    public function show($id)
    {
        $message = Contact::with('service')->findOrFail($id);
        
        // Mark as read if it was unread
        if (!$message->read) {
            $message->read = true;
            $message->save();
        }
        
        return view('admin.contacts.show', compact('message'));
    }
    
    public function markAsRead(Request $request, $id)
    {
        $message = Contact::findOrFail($id);
        $message->read = !$message->read;
        $message->save();
        
        return redirect()->back()->with('success', 'Message status updated successfully');
    }
    
    public function destroy($id)
    {
        $message = Contact::findOrFail($id);
        $message->delete();
        
        return redirect()->route('admin.contacts')->with('success', 'Message deleted successfully');
    }
}