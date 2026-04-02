<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Contracts\AiGeneratorInterface;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function __construct(protected AiGeneratorInterface $aiService)
    {
    }

    public function history()
    {
        $contents = auth()->user()->contents()->latest()->paginate(10);
        return view('dashboard.history', compact('contents'));
    }

    public function generate(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'audience' => 'nullable|string|max:255',
            'tone' => 'required|string|in:professional,casual,persuasive',
            'content_type' => 'required|string|in:Ads,Product Description,Social Media Caption',
        ]);

        $generatedText = $this->aiService->generate($validated);

        $content = Content::create([
            'user_id' => auth()->id(),
            'input_data' => $validated,
            'generated_text' => $generatedText,
        ]);

        return redirect()->route('dashboard')->with('success', 'Content generated successfully!')->with('generated_content', $content);
    }

    public function destroy(Content $content)
    {
        if ($content->user_id !== auth()->id()) {
            abort(403);
        }
        $content->delete();
        return redirect()->route('history')->with('success', 'Content deleted successfully!');
    }
}
