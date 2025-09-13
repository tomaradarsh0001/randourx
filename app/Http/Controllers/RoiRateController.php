<?php

namespace App\Http\Controllers;

use App\Models\RoiRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan; // ← add this

class RoiRateController extends Controller
{
    public function index()
    {
        $roiRates = RoiRate::all();
        return view('admin.roi.index', compact('roiRates'));
    }

    public function update(Request $request, RoiRate $roiRate)
{
    $request->validate([
        'rate' => 'required|numeric|min:0.01|max:10',
    ]);

    $roiRate->update([
        'rate' => $request->rate,
    ]);

    return redirect()->route('admin.roi.index')->with('success', 'ROI Rate updated successfully!');
}
 public function manualProcess(Request $request)
    {
        Artisan::call('roi:process'); // call your command
        return redirect()->back()->with('success', 'ROI processed manually.');
    }

}
