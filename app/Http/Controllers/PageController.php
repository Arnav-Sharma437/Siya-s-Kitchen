<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display the About page with the heartfelt tribute to Siya,
     * family story, and culinary heritage.
     */
    public function about(): View
    {
        return view('pages.about');
    }

    /**
     * Display the Gallery page with categorized food and ambiance photography.
     */
    public function gallery(): View
    {
        $signatureDishes = MenuItem::where('is_featured', true)
            ->orWhere('is_popular', true)
            ->take(12)
            ->get();

        return view('pages.gallery', compact('signatureDishes'));
    }

    /**
     * Display the Contact & Location page with Harrow address, opening hours,
     * and inquiry/reservation form.
     */
    public function contact(): View
    {
        return view('pages.contact');
    }

    /**
     * Handle incoming contact / table inquiry form submission.
     */
    public function contactSubmit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:120',
            'phone' => 'nullable|string|max:25',
            'subject' => 'nullable|string|max:150',
            'inquiry_type' => 'nullable|string|in:general,reservation,catering,feedback',
            'message' => 'required|string|max:2000',
        ]);

        return redirect()->route('contact')->with('success', 'Thank you for reaching out! We have received your message and will get back to you promptly.');
    }
}
