<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TermsConditionsController extends Controller
{
    public function edit()
    {
        $page = CmsPage::terms();

        return view('administrator.terms_conditions.edit', compact('page'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:500',
            'body_html' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        CmsPage::updateOrCreate(
            ['page_key' => CmsPage::PAGE_KEY_TERMS],
            [
                'title' => $request->title,
                'body_html' => $request->body_html,
            ]
        );

        return redirect()->route('admin_terms_conditions_edit')->with('success_message', 'Terms & Conditions updated successfully.');
    }
}
